<?php

namespace App\Services\LuhnValidation;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class isValidId
{
    protected $id_number;
    protected $length = false;
    protected $dob;
    protected $age;
    protected $gender;
    protected $citizen;
    protected $valid_id;
    protected $errors = [];

    public function __construct($id_number)
    {
        if (!is_numeric($id_number)) {
            return false;
        } else {
            $this->id_number = $id_number;
            $this->validate_id();
        }
    }

    public function all()
    {
        $tmp = $this;
        unset($tmp->middleware);

        $all_props = [];
        foreach ($tmp as $key => $prop) {
            $all_props[$key] = $prop;
        }

        return (object)$all_props;
    }

    public function getID()
    {
        return $this->id_number;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getDOB()
    {
        return $this->dob;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getCitizen()
    {
        return $this->citizen;
    }

    public function valid()
    {
        return $this->valid_id;
    }

    public function hasErros()
    {
        return count($this->errors) > 0 ? true : false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function validate_id()
    {
        //Check that the id number is the correct length of 13.
        strlen($this->id_number) != 13 ? $this->addError(2) : $this->length = true;
        //Makes sure all the characters are numbers
        !ctype_digit($this->id_number) ? $this->addError(0) : true;

        //Check if the date of birth is valid.
        $this->validate_dob();

        $this->set_gender();
        $this->set_citizen();
        $this->set_valid();
        return;
    }

    private function validate_dob()
    {
        $year_s = substr($this->id_number, 0, 2);
        $month = substr($this->id_number, 2, 2);
        $day = substr($this->id_number, 4, 2);

        $century = Carbon::now('Africa/Johannesburg');
        if ($year_s > 0 && $year_s <= date('y')) {
            $year = substr($century->format('Y'), 0, 2) . $year_s;
        } else {
            $year = substr($century->subCentury()->format('Y'), 0, 2) . $year_s;
        }

        $dob = ['dob' => $year . '-' . $month . '-' . $day];
        $valid = Validator::make($dob, [
            'dob' => 'date',
        ]);
        if (count($valid->errors()->getMessages()) > 0) {
            $this->addError(1);
        } else {
            $this->dob = Carbon::create($year, $month, $day, null, null, null, 'Africa/Johannesburg');
            $today = Carbon::now('Africa/Johannesburg');
            $this->age = $today->diffInYears($this->dob);
            $this->dob = $this->dob->toDateString();
        }

        return;
    }

    private function set_gender()
    {
        $gender_str = substr($this->id_number, 6, 4);
        return $gender_str < 5000 ? $this->gender = 'f' : $this->gender = 'm';
    }

    private function set_citizen()
    {
        $citizen_str = substr($this->id_number, 10, 1);
        return $citizen_str == 0 ? $this->citizen = true : $this->citizen = false;
    }

    private function set_valid()
    {
        if (strlen($this->id_number) != 13) {
            $this->valid_id = false;
            return;
        }
        $split = str_split($this->id_number);
        $checker = (int)end($split);
        array_pop($split);
        $odds = [];
        $evens = '';

        foreach ($split as $i => $n) {
            if ($i % 2 == 0) {
                array_push($odds, $n);
            } else {
                $evens .= $n;
            }
        }

        $odds_total = 0;
        foreach ($odds as $item) {
            $odds_total += $item;
        }

        $evens = $evens * 2;
        $evens_total = 0;
        foreach (str_split($evens) as $e) {
            $evens_total += $e;
        }

        $total = 10 - substr(($odds_total + $evens_total), -1, 1);

        if ($total > 9) {
            $total = $total - 10;
        }

        if ($total === $checker) {
            if (count($this->errors) == 0) {
                $this->valid_id = true;
            } else {
                $this->valid_id = false;
            }
        } else {
            $this->valid_id = false;
        }
        return;
    }

    private function addError($code)
    {
        switch ($code) {
            case 0:
                array_push($this->errors, 'Contains Non-Numeric Characters');
                break;
            case 1:
                array_push($this->errors, 'Invalid Date Format');
                break;
            case 2:
                array_push($this->errors, 'ID not 13 Characters');
                break;
        }
    }
}

<?php


namespace App\Services;


use Illuminate\Support\Str;

class SanitizeMobileNumbers
{
    private $mobile;

    public function __construct(string $mobile)
    {
        $this->mobile = $mobile;
        $this->removeTwoSeven();
        $this->removeFrontZero();
    }

    private function removeTwoSeven()
    {
        $this->mobile = str_replace('+27', '', $this->mobile);
        if (Str::startsWith($this->mobile, '27')){
            $this->mobile = substr($this->mobile, 2, 11);
        }
    }

    private function removeFrontZero()
    {
        if (strlen($this->mobile) > 9 && Str::startsWith($this->mobile, '0')){
            $this->mobile = substr($this->mobile, 1, 11);
        }
    }

    public function getNumber()
    {
        return '+27'.$this->mobile;
    }

}

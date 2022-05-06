<?php


namespace App\Services\People;


use App\Models\People\Interest;

class InterestsParse
{
    private $interestIds;

    public function __construct(string $interests)
    {
        $interests = explode(',', $interests);
        if (is_array($interests)){
            $this->parse($interests);
        }
    }

    private function parse(array $interests)
    {
        foreach ($interests as $key => $interest){
            $this->interestIds[] = Interest::updateOrCreate([
                'description' => ucwords($interest, ' ')
            ])->id;
        }
    }

    public function getInterestIds()
    {
        return $this->interestIds;
    }
}

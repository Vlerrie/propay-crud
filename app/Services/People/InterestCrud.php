<?php


namespace App\Services\People;


use App\Models\People\Interest;
use App\Models\People\PersonInterest;

class InterestCrud
{
    private $interest;

    public function __construct(Interest $interest = null)
    {
        $this->interest = $interest;
    }

    public function linkInterests(int$personId, array $interestIds)
    {
        PersonInterest::where('person_id', $personId)->whereNotIn('interest_id', $interestIds)->delete();
        foreach ($interestIds as $id){
            PersonInterest::updateOrCreate(
                [
                    'person_id' => $personId,
                    'interest_id' => $id
                ]
            );
        }
    }
}

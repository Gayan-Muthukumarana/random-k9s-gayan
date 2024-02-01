<?php

namespace App\Services;

use App\Enums\RandomFactUserTypesEnum;
use App\Enums\StatusEnum;
use App\Models\Fact;

class GetUserRelatedFactService
{
    /**
     * Get a random fact based on the user's type preference.
     *
     * @param $userType
     * @return mixed
     */
    public function getRandomFactByUserType($userType)
    {
        $conditions = [];

        if ($userType === RandomFactUserTypesEnum::NUMBERPHILE->value) {
            $conditions[] = ['is_contain_numbers', StatusEnum::TRUE->value];
        } elseif ($userType === RandomFactUserTypesEnum::NON_NUMBERPHILE->value) {
            $conditions[] = ['is_contain_numbers', StatusEnum::FALSE->value];
        }

        $randomFact = Fact::where($conditions)
            ->inRandomOrder()
            ->first();

        return $randomFact;
    }
}

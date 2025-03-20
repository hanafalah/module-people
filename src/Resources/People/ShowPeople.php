<?php

namespace Hanafalah\ModulePeople\Resources\People;

use Hanafalah\ModulePatient\Resources\FamilyRelationship\ViewFamilyRelationship;
use Hanafalah\ModuleRegional\Resources\Address\ShowAddress;
use Hanafalah\LaravelSupport\Resources\Phone\ShowPhone;

class ShowPeople extends ViewPeople
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'profile'          => $this->profile,
            'blood_type'       => $this->blood_type,
            'last_education'   => $this->last_education,
            'email'            => $this->email,
            'phone_1'          => $this->phone_1,
            'phone_2'          => $this->phone_2,
            'father_name'      => $this->father_name,
            'mother_name'      => $this->mother_name,
            'nationality'      => $this->nationality,
            'country'          => $this->relationValidation('country', function () {
                $country = $this->country;
                return [
                    'id'   => $country->getKey(),
                    'name' => $country->name ?? null
                ];
            }),
            'tribe'            => $this->relationValidation('tribe', function () {
                $tribe = $this->tribe;
                return [
                    'id'   => $tribe->getKey(),
                    'name' => $tribe->name
                ];
            }),
            'family_relationship' => $this->relationValidation("familyRelationship", function () {
                return $this->familyRelationShip->toShowApi();
            }),
            'phones' => $this->relationValidation('hasPhones', function () {
                return $this->hasPhones->transform(function ($phone) {
                    return $phone->toShowApi();
                });
            }),
            'addresses' => $this->relationValidation('addresses', function () {
                return (object) $this->addresses->mapWithKeys(function ($address) {
                    return [\strtoupper($address->flag) => new ShowAddress($address)];
                });
            })
        ];

        $arr = array_merge(parent::toArray($request), $arr);

        return $arr;
    }
}

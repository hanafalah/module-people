<?php

namespace Hanafalah\ModulePeople\Resources\People;

use Hanafalah\ModuleRegional\Resources\Address\ShowAddress;
use Illuminate\Support\Str;

class ShowPeople extends ViewPeople
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'profile'          => $this->profile,
            'blood_type'       => $this->blood_type,
            'last_education'   => $this->last_education,
            'marital_status'   => $this->marital_status,
            'total_children'   => $this->total_children,
            'email'            => $this->email,
            'father_name'      => $this->father_name,
            'mother_name'      => $this->mother_name,
            'is_nationality'   => $this->boolValidate('is_nationality'),
            'country'          => $this->relationValidation('country', function () {
                $country = $this->country;
                return [
                    'id'   => $country->getKey(),
                    'name' => $country->name ?? null
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
            'address' => $this->relationValidation('addresses', function () {
                return (object) $this->addresses->mapWithKeys(function ($address) {
                    return [Str::lower($address->flag) => new ShowAddress($address)];
                });
            })
        ];

        $arr = array_merge(parent::toArray($request), $arr);

        return $arr;
    }
}

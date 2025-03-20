<?php

namespace Hanafalah\ModulePeople\Resources\People;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewPeople extends ApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'         => $this->id,
            'name'       => (isset($this->first_name) ? '' : 'FNU ') . $this->name,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            "dob"        => $this->dob ?? null,
            "pob"        => $this->pob ?? null,
            'phone_1'    => $this->phone_1,
            'phone_2'    => $this->phone_2,
            "sex"        => isset($this->sex) ? intval($this->sex) : null,
            'card_identities' => $this->relationValidation('cardIdentities', function () {
                return $this->cardIdentities->mapWithKeys(function ($cardIdentity) {
                    return [\strtoupper($cardIdentity->flag) => $cardIdentity->value];
                });
            })
        ];

        return $arr;
    }
}

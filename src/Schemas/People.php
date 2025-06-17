<?php

namespace Hanafalah\ModulePeople\Schemas;

use Hanafalah\ModulePeople\Contracts\Schemas\People as ContractsPeople;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleRegional\Enums\Address\Flag;
use Hanafalah\ModuleRegional\Contracts\Data\AddressData;
use Hanafalah\ModulePeople\Enums\People\CardIdentity;
use Hanafalah\ModulePeople\Contracts\Data\CardIdentityData;
use Hanafalah\ModulePeople\Contracts\Data\PeopleData;
use Hanafalah\ModulePeople\Supports\BaseModulePeople;
use Illuminate\Support\Str;

class People extends BaseModulePeople implements ContractsPeople
{
    protected string $__entity = 'People';
    public static $people_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'people',
            'tags'     => ['people', 'people-index'],
            'forever'  => true
        ]
    ];

    public function prepareStorePeople(PeopleData $people_dto): Model{
        if (!isset($people_dto->name) && isset($people_dto->last_name)) {
            $people_dto->name = trim(implode(' ', [$people_dto->first_name ?? '', $people_dto->last_name]));
        }

        $people = $this->people()->updateOrCreate([
            'id' => $people_dto->id ?? null
        ], [
            'name'            => $people_dto->name,
            'dob'             => $people_dto->dob,
            'pob'             => $people_dto->pob,
            'last_name'       => $people_dto->last_name,
            'first_name'      => $people_dto->first_name,
            'sex'             => $people_dto->sex ?? null,
            'blood_type'      => $people_dto->blood_type ?? null,
            'country_id'      => $people_dto->country_id ?? null,
            'father_name'     => $people_dto->father_name ?? null,
            'mother_name'     => $people_dto->mother_name ?? null,
            'last_education'  => $people_dto->last_education ?? null, 
            'total_children'  => $people_dto->total_children ?? null, 
            'marital_status'  => $people_dto->marital_status ?? null
        ]);

        $people->nationality = $people_dto->is_nationality ?? request()->nationality ?? true;
        $this->fillingProps($people,$people_dto->props);
        
        $people->save();
        if (isset($people_dto->phones) && count($people_dto->phones) > 0) {
            $phones = $people_dto->phones;
            $people->setPhone($phones);
        }

        if (isset($people_dto->address)){
            $address = $people_dto->address;
            if (isset($address->ktp,$address->ktp->name)) {
                $address->ktp = $this->requestDTO(AddressData::class,$address->ktp->toArray());
                $people->setAddress(Flag::KTP->value, $address->ktp->toArray());
            }
    
            $same_as_ktp = isset($address->residence_same_as_ktp) && $address->residence_same_as_ktp;
            if ($same_as_ktp) $address->residence = $address->ktp;            
    
            if (isset($address->residence,$address->residence->name)) {
                if (!$same_as_ktp) $address->residence = $this->requestDTO(AddressData::class,$address->residence->toArray());
                $people->setAddress(Flag::RESIDENCE->value, $address->residence->toArray());
            }
        }

        // FAMILY RELATIONSHIP
        if (isset($people_dto->family_relationship) && isset($people_dto->family_relationship->name, $people_dto->family_relationship->role)) {
            $family = $people_dto->family_relationship;
            $people->familyRelationship()->updateOrCreate([
                'people_id' => $people->getKey()
            ], [
                'role'      => $family->role,
                'name'      => $family->name,
                'phone'     => $family->phone ?? null
            ]);
        } 
        if (isset($people_dto->card_identity)){
            $card_identity = $people_dto->card_identity;
            $this->peopleIdentity($people, $card_identity,array_column(CardIdentity::cases(),'value'));
        }
        $people->save();
        $people->refresh();

        return static::$people_model = $people;
    }

    protected function peopleIdentity(Model &$people, CardIdentityData $card_identity_dto, array $types){
        $card_identity = [];
        foreach ($types as $type) {
            $lower_type = Str::lower($type);
            $value = $card_identity_dto->{$lower_type} ?? null;
            if (isset($value)) $people->setCardIdentity($type, $card_identity_dto->{$lower_type});
            $card_identity[$lower_type] = $value;
        }
        $people->setAttribute('prop_card_identity',$card_identity);
    }

}

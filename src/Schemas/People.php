<?php

namespace Hanafalah\ModulePeople\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModulePeople\Contracts\Schemas\People as ContractsPeople;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleRegional\Enums\Address\Flag;
use Hanafalah\ModulePeople\Enums\People\CardIdentity;
use Hanafalah\ModuleRegional\Contracts\Data\AddressData;
use Hanafalah\ModulePeople\Contracts\Data\CardIdentityData;
use Hanafalah\ModulePeople\Contracts\Data\PeopleData;
use Illuminate\Support\Str;

class People extends PackageManagement implements ContractsPeople
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

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function prepareShowPeople(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getPeople();
        if (!isset($model)) {
            $id = $attributes['id'] ?? null;
            if (!isset($id)) throw new \Exception('No id provided', 422);

            $model = $this->people()->with($this->showUsingRelation())->find($id);
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$people_model = $model;
    }

    public function showPeople(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowPeople($model);
        });
    }

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
            'sex'             => $people_dto->sex,
            'blood_type'      => $people_dto->blood_type,
            'country_id'      => $people_dto->country_id,
            'father_name'     => $people_dto->father_name,
            'mother_name'     => $people_dto->mother_name,
            'last_education'  => $people_dto->last_education, 
            'total_children'  => $people_dto->last_education, 
            'marital_status'  => $people_dto->marital_status
        ]);

        $people->nationality = $people_dto->is_nationality ?? request()->nationality ?? true;
        foreach ($people_dto->props as $key => $prop) $people->{$key} = $prop;
        
        $people->save();
        if (isset($people_dto->phones) && count($people_dto->phones) > 0) {
            $phones = $people_dto->phones;
            $people->setPhone($phones);
        }

        if (isset($people_dto->address)){
            $address = $people_dto->address;
            if (isset($address->ktp)) {
                $address->ktp = $this->requestDTO(AddressData::class,$address->ktp->toArray());
                $people->setAddress(Flag::KTP->value, $address->ktp->toArray());
            }
    
            $same_as_ktp = isset($address->residence_same_as_ktp) && $address->residence_same_as_ktp;
            if ($same_as_ktp) $address->residence = $address->ktp;            
    
            if (isset($address->residence)) {            
                if (!$same_as_ktp) $address->residence = $this->requestDTO(AddressData::class,$address->residence->toArray());
                $people->setAddress(Flag::RESIDENCE->value, $address->residence->toArray());
            }
        }

        // FAMILY RELATIONSHIP
        if (isset($people_dto->family_relationship)) {
            $family = $people_dto->family_relationship;
            $people->familyRelationship()->updateOrCreate([
                'people_id' => $people->getKey()
            ], [
                'role'      => $family->role,
                'name'      => $family->name,
                'phone'     => $family->phone
            ]);
        } 
        if (isset($people_dto->card_identity)){
            $card_identity = $people_dto->card_identity;
            $this->peopleIdentity($people, $card_identity,array_column(CardIdentity::cases(),'value'));
        }
        $people->save();
        $people->refresh();
        // $this->forgetTags('people');

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

    public function storePeople(?PeopleData $people_dto = null): array{
        return $this->transaction(function () use ($people_dto){
            return $this->showPeople($this->prepareStorePeople($people_dto ?? $this->requestDTO(PeopleData::class)));
        });
    }

    public function getPeople(): mixed{
        return static::$people_model;
    }

    public function people(mixed $conditionals = []): Builder{
        return $this->PeopleModel()->withParameters()->conditionals($this->mergeCondition($conditionals));
    }
}

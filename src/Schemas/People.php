<?php

namespace Hanafalah\ModulePeople\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModulePeople\Contracts\People as ContractsPeople;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleRegional\Enums\Address\Flag;
use Hanafalah\ModulePeople\Enums\People\CardIdentity;
use Hanafalah\ModuleRegional\Data\AddressData;
use Hanafalah\ModuleWorkspace\Data\CardIdentityData;
use Hanafalah\ModuleWorkspace\Data\PeopleData;
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
            'id' => $attributes['id'] ?? null
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

        $people->nationality = $attributes['nationality'] ?? request()->nationality ?? 1;
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
            $this->peopleIdentity($people, $card_identity,[
                CardIdentity::NIK->value,
                CardIdentity::KK->value,
                CardIdentity::PASSPORT->value,
                CardIdentity::NPWP->value,
                CardIdentity::VISA->value,
                CardIdentity::SIM->value
            ]);
        }
        $people->save();

        $this->forgetTags('people');

        return static::$people_model = $people;
    }

    protected function peopleIdentity(Model &$people, CardIdentityData $card_identity_dto, array $types){
        foreach ($types as $type) {
            $lower_type = Str::lower($type);
            $value = $card_identity_dto->{$lower_type} ?? null;
            if (isset($value)) $people->setCardIdentity($type, $card_identity_dto->{$lower_type});
            $people->{$lower_type} = $value;
        }
    }

    public function storePeople(): array{
        return $this->transaction(function () {
            return $this->showPeople($this->prepareStorePeople());
        });
    }

    public function addOrChange(?array $attributes = []): self
    {
        if (!isset($attributes['name']) && isset($attributes['first_name'])) {
            $attributes['name'] = implode(' ', [$attributes['first_name'], $attributes['last_name'] ?? '']);
        }
        $people = $this->updateOrCreate($attributes);
        static::$people_model = $people;
        return $this;
    }

    public function getPeople(): ?Model
    {
        return static::$people_model;
    }

    public function people(mixed $conditionals = []): Builder
    {
        return $this->PeopleModel()->conditionals($conditionals);
    }
}

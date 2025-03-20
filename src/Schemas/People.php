<?php

namespace Hanafalah\ModulePeople\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModulePeople\Contracts\People as ContractsPeople;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleRegional\Enums\Address\Flag;
use Hanafalah\ModulePeople\Enums\People\CardIdentity;

class People extends PackageManagement implements ContractsPeople
{
    protected array $__guard   = ['id'];
    protected array $__add     = [
        'name',
        'first_name',
        'last_name',
        'pob',
        'dob',
        'sex',
        'last_education',
        'tribe_id',
        'country_id',
        'blood_type',
        'father_name',
        'mother_name'
    ];
    protected string $__entity = 'People';
    public static $people_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'people',
            'tags'     => ['people', 'people-index'],
            'forever'  => true
        ]
    ];

    protected function showUsingRelation()
    {
        return [];
    }

    public function prepareShowPeople(?Model $model = null, ?array $attributes = null): Model
    {
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

    public function showPeople(?Model $model = null): array
    {
        return $this->transforming($this->__resources['show'], function () use ($model) {
            return $this->prepareShowPeople($model);
        });
    }

    public function prepareStorePeople(?array $attributes = null): Model
    {
        $attributes ??= $this->getAttributes();

        if (!isset($attributes['name']) && isset($attributes['last_name'])) {
            $attributes['name'] = trim(implode(' ', [$attributes['first_name'] ?? '', $attributes['last_name']]));
        }
        $sex = $attributes['sex'] ?? null;
        if (isset($sex)) {
            $sex = \strval($sex);
        }

        $people = $this->people()->updateOrCreate([
            'id' => $attributes['id'] ?? null
        ], [
            'name'        => $attributes['name'],
            'dob'         => $attributes['dob'] ?? null,
            'pob'         => $attributes['pob'] ?? null,
            'last_name'   => $attributes['last_name'],
            'first_name'  => $attributes['first_name'] ?? null,
            'sex'         => $sex,
            'blood_type'  => $attributes['blood_type'] ?? null,
            'tribe_id'    => $attributes['tribe_id'] ?? null,
            'country_id'  => $attributes['country_id'] ?? null,
            'father_name' => $attributes['father_name'] ?? null,
            'mother_name' => $attributes['mother_name'] ?? null
        ]);

        $people->nationality = $attributes['nationality'] ?? request()->nationality ?? 1;
        $people->save();

        $exceptions = [
            'id',
            'addresses',
            'residence_address',
            'phones',
            'name',
            'dob',
            'pob',
            'last_name',
            'first_name',
            'sex',
            'father_name',
            'mother_name',
            'blood_type',
            'tribe_id',
            'country_id'
        ];
        foreach ($attributes as $key => $attribute) {
            if ($this->inArray($key, $exceptions)) continue;
            $people->{$key} = $attribute ?? null;
        }
        $people->save();
        if (isset($attributes['phones']) && count($attributes['phones']) > 0) {
            $phones = $attributes['phones'];
            $people->setPhone($phones);
        }

        if (isset($attributes['addresses'])) {
            $addresses = $attributes['addresses'];
            if (isset($addresses[Flag::ID_CARD->value]) && isset($addresses[Flag::ID_CARD->value]['name'])) {
                $ktpAddress           = $people->setAddress(Flag::ID_CARD->value, $addresses[Flag::ID_CARD->value] ?? []);
                $ktpAddress->rt       = $addresses['rt'] ?? null;
                $ktpAddress->rw       = $addresses['rw'] ?? null;
                $ktpAddress->zip_code = $addresses['zip_code'] ?? null;
                $ktpAddress->save();
            }

            $reqResidenceAddress = ($attributes['residence_same_ktp'] ?? null) ? $addresses[Flag::ID_CARD->value] : ($addresses[Flag::RESIDENCE->value] ?? null);
            if (isset($reqResidenceAddress) && isset($reqResidenceAddress['name'])) {
                $residenceAddress           = $people->setAddress(Flag::RESIDENCE->value, $reqResidenceAddress ?? []);
                $residenceAddress->rt       = $reqResidenceAddress["rt"] ?? null;
                $residenceAddress->rw       = $reqResidenceAddress["rw"] ?? null;
                $residenceAddress->zip_code = $reqResidenceAddress["zip_code"] ?? null;
                $residenceAddress->save();
            }
        }

        // FAMILY RELATIONSHIP
        if (isset($attributes['family_relationship'])) {
            $family = $attributes['family_relationship'];
            $people->familyRelationship()->updateOrCreate([
                'people_id' => $people->getKey()
            ], [
                'role'      => $family['role'] ?? null,
                'name'      => $family['name'] ?? null,
                'phone'     => $family['phone'] ?? null,
            ]);
        }

        $people->save();

        if (isset($attributes['nik']))      $people->setCardIdentity(CardIdentity::NIK, $attributes['nik'] ?? "");
        if (isset($attributes['passport'])) $people->setCardIdentity(CardIdentity::PASSPORT, $attributes['passport'] ?? "");
        $this->forgetTags('people');

        return static::$people_model = $people;
    }

    public function storePeople(): array
    {
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

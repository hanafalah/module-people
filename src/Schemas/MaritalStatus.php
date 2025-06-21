<?php

namespace Hanafalah\ModulePeople\Schemas;

use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModulePeople\Contracts\Schemas\MaritalStatus as ContractsMaritalStatus;
use Hanafalah\ModulePeople\Contracts\Data\MaritalStatusData;
use Illuminate\Database\Eloquent\Builder;

class MaritalStatus extends PeopleStuff implements ContractsMaritalStatus
{
    protected string $__entity = 'MaritalStatus';
    public static $marital_status_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'marital_status',
            'tags'     => ['marital_status', 'marital_status-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreMaritalStatus(MaritalStatusData $marital_status_dto): Model{
        $marital_status = $this->prepareStoreUnicode($marital_status_dto);
        return static::$marital_status_model = $marital_status;
    }

    public function maritalStatus(mixed $conditionals = null): Builder{
        return $this->unicode($conditionals);
    }
}
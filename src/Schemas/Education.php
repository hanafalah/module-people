<?php

namespace Hanafalah\ModulePeople\Schemas;

use Hanafalah\ModulePeople\Contracts\Data\EducationData;
use Hanafalah\ModulePeople\Contracts\Schemas\Education as ContractsEducation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Education extends PeopleStuff implements ContractsEducation
{
    protected string $__entity = 'Education';
    public static $education_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'education',
            'tags'     => ['education', 'education-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreEducation(EducationData $education_dto): Model{
        $model = parent::prepareStorePeopleStuff($education_dto);
        return static::$education_model = $model;
    }

    public function education(mixed $conditionals = null): Builder{
        return $this->generalSchemaModel($conditionals);
    }
}

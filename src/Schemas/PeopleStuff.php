<?php

namespace Hanafalah\ModulePeople\Schemas;

use Hanafalah\LaravelSupport\Schemas\Unicode;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModulePeople\Contracts\Schemas\PeopleStuff as ContractsPeopleStuff;
use Hanafalah\ModulePeople\Contracts\Data\PeopleStuffData;
use Illuminate\Database\Eloquent\Builder;

class PeopleStuff extends Unicode implements ContractsPeopleStuff
{
    protected string $__entity = 'PeopleStuff';
    protected $__config_name = 'module-people';
    public static $people_stuff_model;
    protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'people_stuff',
            'tags'     => ['people_stuff', 'people_stuff-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStorePeopleStuff(PeopleStuffData $people_stuff_dto): Model{
        $people_stuff = $this->prepareStoreUnicode($people_stuff_dto);
        return static::$people_stuff_model = $people_stuff;
    }

    public function peopleStuff(mixed $conditionals = null): Builder{
        return $this->unicode($conditionals);
    }
}
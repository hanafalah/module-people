<?php

namespace Hanafalah\ModulePeople\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModulePeople\{
    Supports\BaseModulePeople
};
use Hanafalah\ModulePeople\Contracts\Schemas\PeopleStuff as ContractsPeopleStuff;
use Hanafalah\ModulePeople\Contracts\Data\PeopleStuffData;

class PeopleStuff extends BaseModulePeople implements ContractsPeopleStuff
{
    protected string $__entity = 'PeopleStuff';
    public static $people_stuff_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'people_stuff',
            'tags'     => ['people_stuff', 'people_stuff-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStorePeopleStuff(PeopleStuffData $people_stuff_dto): Model{
        $add = [
            'name' => $people_stuff_dto->name,
            'flag' => $people_stuff_dto->flag,
            'label' => $people_stuff_dto->label
        ];
        if (isset($people_stuff_dto->id)){
            $guard  = ['id' => $people_stuff_dto->id];
            $create = [$guard, $add];
        }else{
            $create = [$add];
        }
        $people_stuff = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($people_stuff,$people_stuff_dto->props);
        $people_stuff->save();
        return static::$people_stuff_model = $people_stuff;
    }
}
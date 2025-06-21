<?php

namespace Hanafalah\ModulePeople\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Schemas\Unicode;
use Hanafalah\ModulePeople\Contracts\Data\PeopleStuffData;
//use Hanafalah\ModulePeople\Contracts\Data\PeopleStuffUpdateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModulePeople\Schemas\PeopleStuff
 * @method mixed export(string $type)
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method array updatePeopleStuff(?PeopleStuffData $people_stuff_dto = null)
 * @method Model prepareUpdatePeopleStuff(PeopleStuffData $people_stuff_dto)
 * @method bool deletePeopleStuff()
 * @method bool prepareDeletePeopleStuff(? array $attributes = null)
 * @method mixed getPeopleStuff()
 * @method ?Model prepareShowPeopleStuff(?Model $model = null, ?array $attributes = null)
 * @method array showPeopleStuff(?Model $model = null)
 * @method Collection prepareViewPeopleStuffList()
 * @method array viewPeopleStuffList()
 * @method LengthAwarePaginator prepareViewPeopleStuffPaginate(PaginateData $paginate_dto)
 * @method array viewPeopleStuffPaginate(?PaginateData $paginate_dto = null)
 * @method array storePeopleStuff(?PeopleStuffData $people_stuff_dto = null);
 */

interface PeopleStuff extends Unicode
{
    public function prepareStorePeopleStuff(PeopleStuffData $people_stuff_dto): Model;
    public function peopleStuff(mixed $conditionals = null): Builder;
}
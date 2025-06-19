<?php

namespace Hanafalah\ModulePeople\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModulePeople\Contracts\Data\PeopleData;

/**
 * @see \Hanafalah\ModulePeople\Schemas\People
 * @method self setParamLogic(string $logic, bool $search_value = false, ?array $optionals = [])
 * @method self conditionals(mixed $conditionals)
 * @method bool deletePeople()
 * @method mixed getPeople()
 * @method array showPeople(?Model $model = null)
 * @method Collection prepareViewPeopleList()
 * @method array viewPeopleList()
 * @method LengthAwarePaginator prepareViewPeoplePaginate(PaginateData $paginate_dto)
 * @method array viewPeoplePaginate(?PaginateData $paginate_dto = null)
 * @method array storePeople(?PeopleData $people_dto = null)
 */
interface People extends DataManagement
{
    public function prepareStorePeople(PeopleData $people_dto): Model;
}

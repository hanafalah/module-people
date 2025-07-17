<?php

namespace Hanafalah\ModulePeople\Contracts\Schemas;

use Hanafalah\ModulePeople\Contracts\Data\MaritalStatusData;
//use Hanafalah\ModulePeople\Contracts\Data\MaritalStatusUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModulePeople\Schemas\MaritalStatus
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateMaritalStatus(?MaritalStatusData $marital_status_dto = null)
 * @method Model prepareUpdateMaritalStatus(MaritalStatusData $marital_status_dto)
 * @method bool deleteMaritalStatus()
 * @method bool prepareDeleteMaritalStatus(? array $attributes = null)
 * @method mixed getMaritalStatus()
 * @method ?Model prepareShowMaritalStatus(?Model $model = null, ?array $attributes = null)
 * @method array showMaritalStatus(?Model $model = null)
 * @method Collection prepareViewMaritalStatusList()
 * @method array viewMaritalStatusList()
 * @method LengthAwarePaginator prepareViewMaritalStatusPaginate(PaginateData $paginate_dto)
 * @method array viewMaritalStatusPaginate(?PaginateData $paginate_dto = null)
 * @method array storeMaritalStatus(?MaritalStatusData $marital_status_dto = null)
 * @method Collection prepareStoreMultipleMaritalStatus(array $datas)
 * @method array storeMultipleMaritalStatus(array $datas)
 */

interface MaritalStatus extends PeopleStuff
{
    public function prepareStoreMaritalStatus(MaritalStatusData $marital_status_dto): Model;
}
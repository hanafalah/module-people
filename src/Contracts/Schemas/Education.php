<?php

namespace Hanafalah\ModulePeople\Contracts\Schemas;

use Hanafalah\ModulePeople\Contracts\Data\EducationData;
//use Hanafalah\ModulePeople\Contracts\Data\EducationUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModulePeople\Schemas\Education
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateEducation(?EducationData $education_dto = null)
 * @method Model prepareUpdateEducation(EducationData $education_dto)
 * @method bool deleteEducation()
 * @method bool prepareDeleteEducation(? array $attributes = null)
 * @method mixed getEducation()
 * @method ?Model prepareShowEducation(?Model $model = null, ?array $attributes = null)
 * @method array showEducation(?Model $model = null)
 * @method Collection prepareViewEducationList()
 * @method array viewEducationList()
 * @method LengthAwarePaginator prepareViewEducationPaginate(PaginateData $paginate_dto)
 * @method array viewEducationPaginate(?PaginateData $paginate_dto = null)
 * @method array storeEducation(?EducationData $education_dto = null)
 * @method Collection prepareStoreMultipleEducation(array $datas)
 * @method array storeMultipleEducation(array $datas)
 */

interface Education extends PeopleStuff
{
    public function prepareStoreEducation(EducationData $education_dto): Model;
}
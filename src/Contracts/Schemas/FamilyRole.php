<?php

namespace Hanafalah\ModulePeople\Contracts\Schemas;

use Hanafalah\ModulePeople\Contracts\Data\FamilyRoleData;
//use Hanafalah\ModulePeople\Contracts\Data\FamilyRoleUpdateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModulePeople\Schemas\FamilyRole
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateFamilyRole(?FamilyRoleData $family_role_dto = null)
 * @method Model prepareUpdateFamilyRole(FamilyRoleData $family_role_dto)
 * @method bool deleteFamilyRole()
 * @method bool prepareDeleteFamilyRole(? array $attributes = null)
 * @method mixed getFamilyRole()
 * @method ?Model prepareShowFamilyRole(?Model $model = null, ?array $attributes = null)
 * @method array showFamilyRole(?Model $model = null)
 * @method Collection prepareViewFamilyRoleList()
 * @method array viewFamilyRoleList()
 * @method LengthAwarePaginator prepareViewFamilyRolePaginate(PaginateData $paginate_dto)
 * @method array viewFamilyRolePaginate(?PaginateData $paginate_dto = null)
 * @method array storeFamilyRole(?FamilyRoleData $family_role_dto = null)
 * @method Collection prepareStoreMultipleFamilyRole(array $datas)
 * @method array storeMultipleFamilyRole(array $datas)
 */

interface FamilyRole extends PeopleStuff
{
    public function prepareStoreFamilyRole(FamilyRoleData $family_role_dto): Model;
}
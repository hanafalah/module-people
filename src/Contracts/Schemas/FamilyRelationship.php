<?php

namespace Hanafalah\ModulePeople\Contracts\Schemas;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModulePeople\Contracts\Data\FamilyRelationshipData;
//use Hanafalah\ModulePeople\Contracts\Data\FamilyRelationshipUpdateData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModulePeople\Schemas\FamilyRelationship
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateFamilyRelationship(?FamilyRelationship $family_relationship_dto = null)
 * @method Model prepareUpdateFamilyRelationship(FamilyRelationship $family_relationship_dto)
 * @method bool deleteFamilyRelationship()
 * @method bool prepareDeleteFamilyRelationship(? array $attributes = null)
 * @method mixed getFamilyRelationship()
 * @method ?Model prepareShowFamilyRelationship(?Model $model = null, ?array $attributes = null)
 * @method array showFamilyRelationship(?Model $model = null)
 * @method Collection prepareViewFamilyRelationshipList()
 * @method array viewFamilyRelationshipList()
 * @method LengthAwarePaginator prepareViewFamilyRelationshipPaginate(PaginateData $paginate_dto)
 * @method array viewFamilyRelationshipPaginate(?PaginateData $paginate_dto = null)
 * @method array storeFamilyRelationship(?FamilyRelationship $family_relationship_dto = null)
 * @method Collection prepareStoreMultipleFamilyRelationship(array $datas)
 * @method array storeMultipleFamilyRelationship(array $datas)
 */

interface FamilyRelationship extends DataManagement
{
    public function prepareStoreFamilyRelationship(FamilyRelationshipData $family_relationship_dto): Model;
}
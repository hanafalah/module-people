<?php

namespace Hanafalah\ModulePeople\Schemas;

use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModulePeople\Contracts\Schemas\FamilyRelationship as ContractsFamilyRelationship;
use Hanafalah\ModulePeople\Contracts\Data\FamilyRelationshipData;
use Hanafalah\ModulePeople\Supports\BaseModulePeople;

class FamilyRelationship extends BaseModulePeople implements ContractsFamilyRelationship
{
    protected string $__entity = 'FamilyRelationship';
    public $family_relationship_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'family_relationship',
            'tags'     => ['family_relationship', 'family_relationship-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreFamilyRelationship(FamilyRelationshipData $family_relationship_dto): Model{
        $add = [
            'people_id'      => $family_relationship_dto->people_id,
            'family_role_id' => $family_relationship_dto->family_role_id,
            'name'           => $family_relationship_dto->name,
            'phone'          => $family_relationship_dto->phone
        ];
        if (isset($family_relationship_dto->id)){
            $guard = ['id' => $family_relationship_dto->id];
            $create = [$guard,$add];
        }else{
            $create = [$add];
        }
        $family_relationship = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($family_relationship,$family_relationship_dto->props);
        $family_relationship->save();
        return $this->family_relationship_model = $family_relationship;
    }
}
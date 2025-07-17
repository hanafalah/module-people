<?php

namespace Hanafalah\ModulePeople\Schemas;

use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModulePeople\Contracts\Schemas\FamilyRole as ContractsFamilyRole;
use Hanafalah\ModulePeople\Contracts\Data\FamilyRoleData;
use Illuminate\Database\Eloquent\Builder;

class FamilyRole extends PeopleStuff implements ContractsFamilyRole
{
    protected string $__entity = 'FamilyRole';
    public static $family_role_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'family_role',
            'tags'     => ['family_role', 'family_role-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreFamilyRole(FamilyRoleData $family_role_dto): Model{
        $family_role = $this->prepareStorePeopleStuff($family_role_dto);
        return static::$family_role_model = $family_role;
    }

    public function familyRole(mixed $conditionals = null): Builder{
        return $this->unicode($conditionals);
    }
}
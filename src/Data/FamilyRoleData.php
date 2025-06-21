<?php

namespace Hanafalah\ModulePeople\Data;

use Hanafalah\ModulePeople\Contracts\Data\FamilyRoleData as DataFamilyRoleData;

class FamilyRoleData extends PeopleStuffData implements DataFamilyRoleData
{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'FamilyRole';
        parent::before($attributes);
    }
}
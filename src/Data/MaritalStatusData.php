<?php

namespace Hanafalah\ModulePeople\Data;

use Hanafalah\ModulePeople\Contracts\Data\MaritalStatusData as DataMaritalStatusData;

class MaritalStatusData extends PeopleStuffData implements DataMaritalStatusData
{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'MaritalStatus';
        parent::before($attributes);
    }
}
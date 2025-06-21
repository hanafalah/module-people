<?php

namespace Hanafalah\ModulePeople\Data;

use Hanafalah\ModulePeople\Contracts\Data\EducationData as DataEducationData;

class EducationData extends PeopleStuffData implements DataEducationData
{
    public static function before(array &$attributes)
    {
        $attributes['flag'] = 'Education';
        parent::before($attributes);
    }
}
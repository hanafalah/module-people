<?php

namespace Hanafalah\ModulePeople\Data;

use Hanafalah\LaravelSupport\Data\UnicodeData;
use Hanafalah\ModulePeople\Contracts\Data\PeopleStuffData as DataPeopleStuffData;

class PeopleStuffData extends UnicodeData implements DataPeopleStuffData
{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'PeopleStuff';
        parent::before($attributes);
    }
}
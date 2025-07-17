<?php

namespace Hanafalah\ModulePeople\Models;

use Hanafalah\LaravelSupport\Models\Unicode\Unicode;
use Hanafalah\ModulePeople\Resources\PeopleStuff\{
    ViewPeopleStuff,
    ShowPeopleStuff
};

class PeopleStuff extends Unicode
{
    protected $table = 'unicodes';
    
    public function getViewResource(){
        return ViewPeopleStuff::class;
    }

    public function getShowResource(){
        return ShowPeopleStuff::class;
    }
}

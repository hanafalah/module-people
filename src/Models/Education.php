<?php

namespace Hanafalah\ModulePeople\Models;

use Hanafalah\ModulePeople\Resources\Education\{
    ViewEducation,
    ShowEducation
};

class Education extends PeopleStuff
{
    protected $table = 'unicodes';
    
    public function getViewResource(){
        return ViewEducation::class;
    }

    public function getShowResource(){
        return ShowEducation::class;
    }
}

<?php

namespace Hanafalah\ModulePeople\Models;

use Hanafalah\ModulePeople\Resources\MaritalStatus\{
    ViewMaritalStatus,
    ShowMaritalStatus
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class MaritalStatus extends PeopleStuff
{
    protected $table = 'unicodes';

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function getViewResource(){
        return ViewMaritalStatus::class;
    }

    public function getShowResource(){
        return ShowMaritalStatus::class;
    }
}

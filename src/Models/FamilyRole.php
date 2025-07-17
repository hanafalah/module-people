<?php

namespace Hanafalah\ModulePeople\Models;

use Hanafalah\ModulePeople\Resources\FamilyRole\{
    ViewFamilyRole,
    ShowFamilyRole
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class FamilyRole extends PeopleStuff
{
    protected $table = 'unicodes';

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function getViewResource(){
        return ViewFamilyRole::class;
    }

    public function getShowResource(){
        return ShowFamilyRole::class;
    }
}

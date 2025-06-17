<?php

namespace Hanafalah\ModulePeople\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModulePeople\Resources\PeopleStuff\{
    ViewPeopleStuff,
    ShowPeopleStuff
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class PeopleStuff extends BaseModel
{
    use HasUlids, HasProps, SoftDeletes;
    
    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    public $list = [
        'id',
        'name',
        'flag',
        'label',
        'props',
    ];

    protected $casts = [
        'name' => 'string',
        'flag' => 'string',
    ];

    

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function getViewResource(){
        return ViewPeopleStuff::class;
    }

    public function getShowResource(){
        return ShowPeopleStuff::class;
    }

    

    
}

<?php

namespace Hanafalah\ModulePeople\Models\FamilyRelationship;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModulePeople\Resources\FamilyRelationship\{
    ViewFamilyRelationship, ShowFamilyRelationship
};

class FamilyRelationship extends BaseModel
{
    use HasProps, SoftDeletes;

    protected $list = [
        'id', 'people_id', 'name', 
        'phone', 'role', 
        'reference_id', 'reference_type', 
        'props'
    ];

    public function people(){
        return $this->belongsToModel('People');
    }

    public function reference(){
        return $this->morphTo();
    }

    public function getViewResource(){
        return ViewFamilyRelationship::class;
    }

    public function getShowResource(){
        return ShowFamilyRelationship::class;
    }
}

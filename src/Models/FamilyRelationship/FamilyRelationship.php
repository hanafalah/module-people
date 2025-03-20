<?php

namespace Zahzah\ModulePeople\Models\FamilyRelationship;

use Zahzah\LaravelHasProps\Concerns\HasProps;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zahzah\LaravelSupport\Models\BaseModel;
use Zahzah\ModulePatient\Resources\FamilyRelationship\{
    ViewFamilyRelationship
};

class FamilyRelationship extends BaseModel{
    use HasProps, SoftDeletes;

    protected $list = ['id','patient_id','people_id','name','phone','role','reference_id','reference_type','props'];

    public function people(){return $this->belongsToModel('People');}

    public function toViewApi(){
        return new ViewFamilyRelationship($this);
    }

    public function toShowApi(){
        return new ViewFamilyRelationship($this);
    }
}
<?php

namespace Zahzah\ModulePeople\Models\People;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Zahzah\LaravelHasProps\Concerns\HasProps;
use Zahzah\LaravelSupport\Models\BaseModel;
use Zahzah\LaravelSupport\Concerns\Support\HasPhone;
use Zahzah\ModuleCardIdentity\Concerns\HasCardIdentity;
use Zahzah\ModuleUser\Concerns\UserReference\HasUserReference;
use Zahzah\ModulePeople\Enums;
use Zahzah\ModulePeople\Enums\People\BloodType;
use Zahzah\ModulePeople\Resources\People\ShowPeople;
use Zahzah\ModulePeople\Resources\People\ViewPeople;
use Zahzah\ModuleRegional\Concerns\HasLocation;

class People extends BaseModel{
    use HasUlids, HasCardIdentity, HasUserReference, HasProps, HasLocation, HasPhone;

    protected $table          = "peoples";
    protected $keyType        = "string";
    protected $primaryKey     = "id";   
    protected $identity_flags = [];
    protected $list           = ['id', 'name', 'sex', 'dob', 'pob']; 
    protected $show           = ['last_education', 'father_name', 'mother_name', 'blood_type','tribe_id', 'first_name', 'last_name', 'country_id'];

    protected $prop_attributes = [
    ];
    
    protected static function newFactory(){
        return \Zahzah\ModulePeople\Factories\People\PeopleFactory::new();
    }

    public function toViewApi(){
        return new ViewPeople($this);
    }

    public function toShowApi(){
        return new ShowPeople($this);
    }

    public function getBloodTypes(): array{
        return array_column(BloodType::cases(),'value');
    }

    public function initializePeople(){
        $this->identity_flags = Enums\People\CardIdentity::cases();
    }

    public function tribe(){return $this->belongsToModel('Tribe');}
    public function country(){return $this->belongsToModel('Country');}
    public function addresses(){return $this->morphManyModel('Address','model');}
    public function familyRelationship(){return $this->hasOneModel('FamilyRelationship');}
}
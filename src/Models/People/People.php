<?php

namespace Hanafalah\ModulePeople\Models\People;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\LaravelSupport\Concerns\Support\HasPhone;
use Hanafalah\ModuleCardIdentity\Concerns\HasCardIdentity;
use Hanafalah\ModuleUser\Concerns\UserReference\HasUserReference;
use Hanafalah\ModulePeople\Enums;
use Hanafalah\ModulePeople\Enums\People\BloodType;
use Hanafalah\ModulePeople\Resources\People\ShowPeople;
use Hanafalah\ModulePeople\Resources\People\ViewPeople;
use Hanafalah\ModuleRegional\Concerns\HasAddress;
use Hanafalah\ModuleRegional\Concerns\HasLocation;

class People extends BaseModel
{
    use HasUlids, HasCardIdentity, HasAddress, HasUserReference, HasProps, HasLocation, HasPhone;

    protected $table          = "peoples";
    protected $keyType        = "string";
    protected $primaryKey     = "id";
    protected $identity_flags = [];
    protected $list           = ['id', 'uuid', 'name', 'sex', 'dob', 'pob'];
    protected $show           = [
        'last_education', 'father_name', 'mother_name', 
        'blood_type', 'first_name', 'last_name', 
        'country_id', 'total_children', 'marital_status'
    ];

    protected $prop_attributes = [];

    protected static function newFactory()
    {
        return \Hanafalah\ModulePeople\Factories\People\PeopleFactory::new();
    }

    public function getViewResource(){
        return ViewPeople::class;
    }

    public function getShowResource(){
        return ShowPeople::class;
    }

    public function getBloodTypes(): array{
        return array_column(BloodType::cases(), 'value');
    }

    public function initializePeople(){
        $this->identity_flags = Enums\People\CardIdentity::cases();
    }

    public function country(){
        return $this->belongsToModel('Country');
    }

    public function addresses(){
        return $this->morphManyModel('Address', 'model');
    }

    public function familyRelationship(){
        return $this->hasOneModel('FamilyRelationship');
    }
}

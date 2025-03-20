<?php

namespace Zahzah\ModulePeople\Models\Identity;

use Zahzah\LaravelSupport\Models\BaseModel;

class Tribe extends BaseModel{
    public $timestamps = false;
    protected $fillable = ['id','parent_id','name'];
}
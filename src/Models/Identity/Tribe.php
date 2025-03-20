<?php

namespace Hanafalah\ModulePeople\Models\Identity;

use Hanafalah\LaravelSupport\Models\BaseModel;

class Tribe extends BaseModel
{
    public $timestamps = false;
    protected $fillable = ['id', 'parent_id', 'name'];
}

<?php

namespace Zahzah\ModulePeople\Models\Identity;

use Illuminate\Database\Eloquent\SoftDeletes;
use Zahzah\LaravelSupport\Models\BaseModel;

class CardIdentity extends BaseModel{
    use SoftDeletes;

    public static $__flags     = [];
    protected $fillable = ['id','reference_type','reference_id','flag','value'];

    protected static function booted(): void{
        parent::booted();
        static::addGlobalScope('flagIn',function($query){
            $query->flagIn(self::$__flags);
        });
    }

    public static function setIdentityFlags(array $flags){
        self::$__flags = $flags;
    }
}
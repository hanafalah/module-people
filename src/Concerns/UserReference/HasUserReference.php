<?php

namespace Hanafalah\ModulePeople\Concerns\UserReference;

trait HasUserReference
{
    public function userReference()
    {
        return $this->morphOneModel('UserReference', 'reference');
    }
    public function userReferences()
    {
        return $this->morphManyModel('UserReference', 'reference');
    }
    public function user()
    {
        return $this->hasOneThroughModel(
            'User',
            'UserReference',
            'reference_id',
            $this->getKeyName(),
            $this->getKeyName(),
            $this->getForeignKey()
        )->where('reference_type', $this->getMorphClass());
    }
}

<?php

namespace Hanafalah\ModulePeople\Schemas;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModulePeople\Contracts\Tribe as ContractsTribe;

class Tribe extends PackageManagement implements ContractsTribe
{
    protected array $__guard   = ['id', 'parent_id', 'name'];
    protected array $__add     = [];
    protected string $__entity = 'Tribe';

    public function booting(): self
    {
        static::$__class = $this;
        static::$__model = $this->{$this->__entity . "Model"}();
        return $this;
    }

    /**
     * Add a new API access or update the existing one if found.
     *
     * The given attributes will be merged with the existing API access.
     *
     * @param array $attributes The attributes to be added to the API access.
     *
     * @return \Illuminate\Database\Eloquent\Model The API access model.
     */
    public function addOrChange(?array $attributes = []): self
    {
        $this->updateOrCreate($attributes);
        return $this;
    }
}

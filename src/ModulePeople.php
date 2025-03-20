<?php

namespace Hanafalah\ModulePeople;

use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModulePeople\Contracts\ModulePeople as ContractsModulePeople;

class ModulePeople extends PackageManagement implements ContractsModulePeople
{
    public function booting(): self
    {
        static::$__class = $this;
        static::$__model = $this->{$this->__entity . "Model"}();
        return $this;
    }

    protected array $__guard   = ['id', 'uuid'];
    protected array $__add     = [
        'name',
        'first_name',
        'last_name',
        'dob',
        'pob',
        'last_education',
        'marga_id',
        'citizenship_id'
    ];

    protected string $__entity = 'People';

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

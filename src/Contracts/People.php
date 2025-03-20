<?php

namespace Hanafalah\ModulePeople\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\DataManagement;

interface People extends DataManagement
{
    public function people(mixed $conditionals = []): Builder;
    public function getPeople(): ?Model;
}

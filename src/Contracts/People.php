<?php

namespace Zahzah\ModulePeople\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Zahzah\LaravelSupport\Contracts\DataManagement;

interface People extends DataManagement{
    public function people(mixed $conditionals = []): Builder;
    public function getPeople():? Model;
}
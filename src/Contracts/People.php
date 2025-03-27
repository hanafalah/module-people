<?php

namespace Hanafalah\ModulePeople\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModulePeople\Data\PeopleData;

interface People extends DataManagement
{
    public function prepareShowPeople(?Model $model = null, ?array $attributes = null): Model;
    public function showPeople(?Model $model = null): array;
    public function prepareStorePeople(PeopleData $people_dto): Model;
    public function storePeople(?PeopleData $people_dto = null): array;
    public function getPeople(): mixed;
    public function people(mixed $conditionals = []): Builder;
    
}

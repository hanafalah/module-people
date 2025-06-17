<?php

namespace Hanafalah\ModulePeople\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModulePeople\Contracts\Data\PeopleStuffData as DataPeopleStuffData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class PeopleStuffData extends Data implements DataPeopleStuffData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public string $name;

    #[MapInputName('flag')]
    #[MapName('flag')]
    public string $flag;

    #[MapInputName('label')]
    #[MapName('label')]
    public string $label;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;
}
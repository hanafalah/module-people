<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class FamilyRelationshipData extends Data{
    public function __construct(
        #[MapInputName('people_id')]
        #[MapName('people_id')]
        public mixed $people_id = null,

        #[MapInputName('role')]
        #[MapName('role')]
        public ?string $role = null,

        #[MapInputName('name')]
        #[MapName('name')]
        public ?string $name = null,

        #[MapInputName('phone')]
        #[MapName('phone')]
        public ?string $phone = null,
    ){}
}
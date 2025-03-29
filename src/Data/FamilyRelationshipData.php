<?php

namespace Hanafalah\ModulePeople\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModulePeople\Contracts\Data\FamilyRelationshipData as DataFamilyRelationshipData;
use Hanafalah\ModulePeople\Enums\FamilyRelationship\Flag;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Enum;

class FamilyRelationshipData extends Data implements DataFamilyRelationshipData{
    public function __construct(
        #[MapInputName('people_id')]
        #[MapName('people_id')]
        public mixed $people_id = null,

        #[MapInputName('role')]
        #[MapName('role')]
        #[Enum(Flag::class)]
        public ?string $role = null,

        #[MapInputName('name')]
        #[MapName('name')]
        public ?string $name = null,

        #[MapInputName('phone')]
        #[MapName('phone')]
        public ?string $phone = null,
    ){}
}
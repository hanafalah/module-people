<?php

namespace Hanafalah\ModulePeople\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModulePeople\Contracts\Data\PeopleData as DataPeopleData;
use Hanafalah\ModulePeople\Enums\People\BloodType;
use Hanafalah\ModulePeople\Enums\People\MaritalStatus;
use Hanafalah\ModulePeople\Enums\People\Sex;
use Spatie\LaravelData\Attributes\{
    MapInputName, MapName,
    Validation\DateFormat,
    Validation\Enum,
    Validation\RequiredWithout,
    Validation\RequiredWithoutAll
};

class PeopleData extends Data implements DataPeopleData{
    public function __construct(
        #[MapInputName('id')]
        #[MapName('id')]
        public mixed $id = null,

        #[MapInputName('uuid')]
        #[MapName('uuid')]
        public ?string $uuid = null,

        #[MapInputName('name')]
        #[MapName('name')]
        #[RequiredWithoutAll('first_name','last_name')]
        public ?string $name = null,

        #[MapInputName('first_name')]
        #[MapName('first_name')]
        public ?string $first_name = null,
        
        #[MapInputName('last_name')]
        #[MapName('last_name')]
        #[RequiredWithout('name')]
        public ?string $last_name = null,

        #[MapInputName('sex')]
        #[MapName('sex')]
        #[Enum(Sex::class)]
        public string $sex,

        #[MapInputName('dob')]
        #[MapName('dob')]
        #[DateFormat(['Y-m-d', 'd-m-Y'])]
        public ?string $dob = null,

        #[MapInputName('pob')]
        #[MapName('pob')]
        public ?string $pob = null,

        #[MapInputName('last_education')]
        #[MapName('last_education')]
        public ?string $last_education = null,

        #[MapInputName('father_name')]
        #[MapName('father_name')]
        public ?string $father_name = null,

        #[MapInputName('mother_name')]
        #[MapName('mother_name')]
        public ?string $mother_name = null,

        #[MapInputName('blood_type')]
        #[MapName('blood_type')]
        #[Enum(BloodType::class)]
        public ?string $blood_type = null,

        #[MapInputName('marital_status')]
        #[MapName('marital_status')]
        #[Enum(MaritalStatus::class)]
        public ?string $marital_status = null,
        
        #[MapInputName('total_children')]
        #[MapName('total_children')]
        public ?int $total_children = null,

        #[MapInputName('is_nationality')]
        #[MapName('is_nationality')]
        public mixed $is_nationality = null,

        #[MapInputName('country_id')]
        #[MapName('country_id')]
        public mixed $country_id = null,

        #[MapInputName('address')]
        #[MapName('address')]
        public ?PeopleAddressData $address = null,

        #[MapInputName('card_identity')]
        #[MapName('card_identity')]
        public ?CardIdentityData $card_identity = null,

        #[MapInputName('family_relationship')]
        #[MapName('family_relationship')]
        public ?FamilyRelationshipData $family_relationship = null,

        #[MapInputName('phones')]
        #[MapName('phones')]
        public ?array $phones = [],

        #[MapInputName('props')]
        #[MapName('props')]
        public ?array $props = []
    ){}
}
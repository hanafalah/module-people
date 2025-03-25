<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Carbon\Carbon;
use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModulePeople\Enums\People\BloodType;
use Hanafalah\ModulePeople\Enums\People\MaritalStatus;
use Hanafalah\ModulePeople\Enums\People\Sex;
use Hanafalah\ModuleRegional\Data\AddressData;
use Spatie\LaravelData\Attributes\{
    MapInputName, MapName,
    Validation\BeforeOrEqual,
    Validation\DateFormat,
    Validation\Enum,
    Validation\RequiredWithout,
    Validation\RequiredWithoutAll
};

class PeopleData extends Data{
    public function __construct(
        #[MapInputName('id')]
        #[MapName('id')]
        public mixed $id = null,

        #[MapInputName('name')]
        #[MapName('name')]
        #[RequiredWithoutAll('first_name','last_name')]
        public string $name,

        #[MapInputName('first_name')]
        #[MapName('first_name')]
        public string $first_name,
        
        #[MapInputName('last_name')]
        #[MapName('last_name')]
        #[RequiredWithout('name')]
        public string $last_name,

        #[MapInputName('sex')]
        #[MapName('sex')]
        #[Enum(Sex::class)]
        public string $sex,

        #[MapInputName('dob')]
        #[MapName('dob')]
        #[BeforeOrEqual(Carbon::today())]
        #[DateFormat(['Y-m-d', 'd-m-Y'])]
        public ?Carbon $dob = null,

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

        #[MapInputName('country_id')]
        #[MapName('country_id')]
        public mixed $country_id = null,

        #[MapInputName('ktp_address')]
        #[MapName('ktp_address')]
        public ?AddressData $ktp_address = null,

        #[MapInputName('residence_address')]
        #[MapName('residence_address')]
        public ?AddressData $residence_address = null,
    ){}
}
<?php

namespace Hanafalah\ModuleWorkspace\Data;

use Carbon\Carbon;
use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModulePeople\Enums\People\BloodType;
use Hanafalah\ModulePeople\Enums\People\MaritalStatus;
use Hanafalah\ModulePeople\Enums\People\Sex;
    use Hanafalah\ModuleRegional\Data\AddressData;
use Spatie\LaravelData\Attributes\{
    MapInputName, MapName
};

class PeopleAddressData extends Data{
    public function __construct(
        #[MapInputName('ktp')]
        #[MapName('ktp')]
        public ?AddressData $ktp = null,

        #[MapInputName('residence_same_as_ktp')]
        #[MapName('residence_same_as_ktp')]
        public ?bool $residence_same_as_ktp = false,

        #[MapInputName('residence')]
        #[MapName('residence')]
        public ?AddressData $residence = null,
    ){}
}
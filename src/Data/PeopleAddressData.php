<?php

namespace Hanafalah\ModulePeople\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModulePeople\Contracts\Data\PeopleAddressData as DataPeopleAddressData;
use Hanafalah\ModuleRegional\Data\AddressData;
use Spatie\LaravelData\Attributes\{
    MapInputName, MapName
};

class PeopleAddressData extends Data implements DataPeopleAddressData{
    #[MapInputName('ktp')]
    #[MapName('ktp')]
    public ?AddressData $ktp = null;

    #[MapInputName('residence_same_as_ktp')]
    #[MapName('residence_same_as_ktp')]
    public ?bool $residence_same_as_ktp = false;

    #[MapInputName('residence')]
    #[MapName('residence')]
    public ?AddressData $residence = null;
}
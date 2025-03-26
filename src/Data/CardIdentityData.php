<?php

namespace Hanafalah\ModulePeople\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Spatie\LaravelData\Attributes\{
    MapInputName, MapName
};

class CardIdentityData extends Data{
    public function __construct(
        #[MapInputName('nik')]
        #[MapName('nik')]
        public ?string $nik = null,

        #[MapInputName('kk')]
        #[MapName('kk')]
        public ?string $kk = null,

        #[MapInputName('passport')]
        #[MapName('passport')]
        public ?string $passport = null,

        #[MapInputName('sim')]
        #[MapName('sim')]
        public ?string $sim = null,

        #[MapInputName('npwp')]
        #[MapName('npwp')]
        public ?string $npwp = null,

        #[MapInputName('visa')]
        #[MapName('visa')]
        public ?string $visa = null,

        #[MapInputName('ihs')]
        #[MapName('ihs')]
        public ?string $ihs = null,

        #[MapInputName('bpjs')]
        #[MapName('bpjs')]
        public ?string $bpjs = null,
    ){}
}
<?php

namespace Hanafalah\ModulePeople\Enums\People;

enum CardIdentity: string
{
    case NIK      = 'NIK';
    case SIM      = 'SIM';
    case PASSPORT = 'PASSPORT';
    case VISA     = 'VISA';
    case KK       = 'KK';
    case NPWP     = 'NPWP';
}

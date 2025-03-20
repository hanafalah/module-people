<?php

namespace Zahzah\ModulePeople\Enums\People;

enum CardIdentity: string{
    case NIK      = 'NIK'; 
    case SIM      = 'SIM'; 
    case PASSPORT = 'PASSPORT'; 
    case VISA     = 'VISA'; 
    case KK       = 'KK';
}
<?php

namespace Zahzah\ModulePeople\Facades;

use Illuminate\Support\Facades\Facade;
use Zahzah\ModulePeople\Contracts\ModulePeople as ContractsPeople;


/**
 * @method static self impersonate(Tenant|string|int $tenant)
 */
class ModulePeople extends Facade{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(){
        return ContractsPeople::class;
    } 
}
<?php

use Hanafalah\ModulePeople\{
    Commands
};
use Hanafalah\ModulePeople\Enums\People\CardIdentity;

return [
    'namespace' => 'Hanafalah\\ModulePeople',
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
        ]
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
        ]
    ],
    'commands' => [
        Commands\InstallMakeCommand::class
    ],
    'card_identities' => CardIdentity::cases(),
];

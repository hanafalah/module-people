<?php

use Hanafalah\ModulePeople\{
    Models as ModulePeople,
    Contracts
};

return [
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
            'people' => Contracts\People::class,
            'tribe'  => Contracts\Tribe::class
        ],
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts'
    ],
    'database' => [
        'models' => [
            'People'             => ModulePeople\People\People::class,
            'Tribe'              => ModulePeople\Identity\Tribe::class,
            'FamilyRelationship' => ModulePeople\FamilyRelationship\FamilyRelationship::class,
        ]
    ]
];

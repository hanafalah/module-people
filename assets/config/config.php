<?php

use Hanafalah\ModulePeople\{
    Models as ModulePeople,
    Contracts
};

return [
    'contracts' => [
        'people' => Contracts\People::class,
        'tribe'  => Contracts\Tribe::class
    ],
    'database' => [
        'models' => [
            'People'             => ModulePeople\People\People::class,
            'Tribe'              => ModulePeople\Identity\Tribe::class,
            'FamilyRelationship' => ModulePeople\FamilyRelationship\FamilyRelationship::class,
        ]
    ]
];

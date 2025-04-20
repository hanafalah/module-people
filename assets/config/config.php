<?php

use Hanafalah\ModulePeople\{
    Models as ModulePeople,
    Contracts
};

return [
    "namespace"     => "Hanafalah\ModulePeople",
    "paths"         => [
        "base_path"    => __DIR__.'\\..\\'
    ],
    'app' => [
        'contracts' => [
            //ADD YOUR CONTRACTS HERE
        ],
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database'
    ],
    'database' => [
        'models' => [
        ]
    ]
];

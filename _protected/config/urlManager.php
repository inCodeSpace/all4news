<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '<controller>/<action>/<id:\d+>' => '<controller>/<action>', // единное правило для обработки id
/*
        // Отдельные правила дя news:
        'control/news-update/<id:\d+>'=>'control/news-update',
        'control/news-delete/<id:\d+>'=>'control/news-delete',

        // Отдельные правила дя images:
        'control/images-update/<id:\d+>'=>'control/images-update',
        'control/images-delete/<id:\d+>'=>'control/images-delete',
*/
    ],
];

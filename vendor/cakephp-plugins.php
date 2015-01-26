<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/plugins/Bake/',
        'Bootstrap3' => $baseDir . '/plugins/Bootstrap3/',
        'DebugKit' => $baseDir . '/plugins/DebugKit/',
        'Migrations' => $baseDir . '/plugins/Migrations/'
    ]
];

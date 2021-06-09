<?php

return
[
    'paths' => [
        'migrations' => 'config/db/migrations',
        'seeds' => 'config/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => getenv('MYSQL_HOST'),
            'name' => getenv('MYSQL_NAME'),
            'user' => getenv('MYSQL_USER'),
            'pass' => getenv('MYSQL_PASS'),
            'port' => getenv('MYSQL_PORT'),
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => getenv('MYSQL_HOST'),
            'name' => getenv('MYSQL_NAME'),
            'user' => getenv('MYSQL_USER'),
            'pass' => getenv('MYSQL_PASS'),
            'port' => getenv('MYSQL_PORT'),
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => getenv('MYSQL_HOST'),
            'name' => getenv('MYSQL_NAME'),
            'user' => getenv('MYSQL_USER'),
            'pass' => getenv('MYSQL_PASS'),
            'port' => getenv('MYSQL_PORT'),
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];

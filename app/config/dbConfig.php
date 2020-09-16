<?php 
return [
    'default'     => 'default',
    'databases'   => [
        'default' => ['connection' => 'postgres']
    ],
    'connections' => [
        'postgres'  => [
            'driver'   => Spiral\Database\Driver\Postgres\PostgresDriver::class,
            'options' => [
                'connection' => 'pgsql:host=db;dbname=competitions',
                'username'   => 'admin',
                'password'   => 'admin',
             ],
        ],
    ]
];
<?php

use Cycle\ORM\Schema;
use Cycle\ORM\Relation;
use Cycle\ORM\Mapper\Mapper;

return [
    'car' => [
        Schema::ENTITY      => Car::class,
        Schema::MAPPER      => Mapper::class,
        Schema::DATABASE    => 'default',
        Schema::TABLE       => 'car',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS     => [
            'id'         => 'id',
            'brand'      => 'brand',
            'model'      => 'model',
            'wheelDrive' => 'wheelDrive'
        ],
        Schema::TYPECAST    => [
            'id'         => 'int',
            'brand'      => 'string',
            'model'      => 'string',
            'wheelDrive' => 'string'
        ],
        Schema::SCHEMA      => [],
        Schema::RELATIONS   => []
    ],
    'competition' => [
        Schema::ENTITY      => Competition::class,
        Schema::MAPPER      => Mapper::class,
        Schema::DATABASE    => 'default',
        Schema::TABLE       => 'competition',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS     => [
            'id'    => 'id',
            'date'  => 'date',
            'title' => 'title'
        ],
        Schema::TYPECAST    => [
            'id'    => 'int',
            'date'  => 'string',
            'title' => 'string'
        ],
        Schema::SCHEMA      => [],
        Schema::RELATIONS   => []
    ],
    'lapTime' => [
        Schema::ENTITY      => LapTime::class,
        Schema::MAPPER      => Mapper::class,
        Schema::DATABASE    => 'default',
        Schema::TABLE       => 'lapTime',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS     => [
            'id'     => 'id',
            'result' => 'result'
        ],
        Schema::TYPECAST    => [
            'id'     => 'int',
            'result' => 'string'
        ],
        Schema::SCHEMA      => [],
        Schema::RELATIONS   => []
    ],
    'tyre' => [
        Schema::ENTITY      => Tyre::class,
        Schema::MAPPER      => Mapper::class,
        Schema::DATABASE    => 'default',
        Schema::TABLE       => 'tyre',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS     => [
            'id'    => 'id',
            'brand' => 'brand',
            'model' => 'model'
        ],
        Schema::TYPECAST    => [
            'id'    => 'int',
            'brand' => 'string',
            'model' => 'string'
        ],
        Schema::SCHEMA      => [],
        Schema::RELATIONS   => []
    ],
    'application' => [
        Schema::ENTITY      => Applications::class,
        Schema::MAPPER      => Mapper::class,
        Schema::DATABASE    => 'default',
        Schema::TABLE       => 'application',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS     => [
            'id'      => 'id',
            'surName'       => 'surName',
            'name'          => 'name',
            'middleName'    => 'middleName',
            'carBrand'      => 'carBrand',
            'carModel'      => 'carModel',
            'carWheelDrive' => 'carWheelDrive',
            'tireBrand'     => 'tireBrand',
            'tireModel'     => 'tireModel'
        ],
        Schema::TYPECAST    => [
            'id'            => 'id',
            'surName'       => 'string',
            'name'          => 'string',
            'middleName'    => 'string',
            'carBrand'      => 'string',
            'carModel'      => 'string',
            'carWheelDrive' => 'string',
            'tireBrand'     => 'string',
            'tireModel'     => 'string'
        ],
        Schema::SCHEMA      => [],
        Schema::RELATIONS   => [
            'competition' => [
                Relation::TYPE   => Relation::HAS_ONE,
                Relation::TARGET => 'competition',
                Relation::SCHEMA => [
                    Relation::CASCADE   => true,
                    Relation::INNER_KEY => 'id',
                    Relation::OUTER_KEY => 'idCompetition',
                ],
           ]
        ]
    ],
    'pilot' => [
        Schema::ENTITY      => Pilot::class,
        Schema::MAPPER      => Mapper::class,
        Schema::DATABASE    => 'default',
        Schema::TABLE       => 'pilot',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS     => [
            'id'         => 'id',
            'surName'    => 'surName',
            'name'       => 'name',
            'middleName' => 'middleName'
        ],
        Schema::TYPECAST    => [
            'id'         => 'id',
            'surName'    => 'string',
            'name'       => 'string',
            'middleName' => 'string'
        ],
        Schema::SCHEMA      => [],
        Schema::RELATIONS   => [
            'car' => [
                Relation::TYPE   => Relation::HAS_ONE,
                Relation::TARGET => 'car',
                Relation::SCHEMA => [
                    Relation::CASCADE   => true,
                    Relation::INNER_KEY => 'id',
                    Relation::OUTER_KEY => 'idCar',
                ]
            ],
            'tyre' => [
                Relation::TYPE   => Relation::HAS_ONE,
                Relation::TARGET => 'tyre',
                Relation::SCHEMA => [
                    Relation::CASCADE   => true,
                    Relation::INNER_KEY => 'id',
                    Relation::OUTER_KEY => 'idTyre',
                ]
            ]
        ]
    ],
    'startingNumber' => [
        Schema::ENTITY      => StartingNumber::class,
        Schema::MAPPER      => Mapper::class,
        Schema::DATABASE    => 'default',
        Schema::TABLE       => 'startingNumber',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS     => [
            'id'             => 'id',
            'startingNumber' => 'startingNumber'
        ],
        Schema::TYPECAST    => [
            'id'             => 'int',
            'startingNumber' => 'int'
        ],
        Schema::SCHEMA      => [],
        Schema::RELATIONS   => [
            'competition' => [
                Relation::TYPE   => Relation::HAS_ONE,
                Relation::TARGET => 'competition',
                Relation::SCHEMA => [
                    Relation::CASCADE   => true,
                    Relation::INNER_KEY => 'id',
                    Relation::OUTER_KEY => 'idCompetition',
                ]
            ],
            'pilot' => [
                Relation::TYPE   => Relation::HAS_ONE,
                Relation::TARGET => 'pilot',
                Relation::SCHEMA => [
                    Relation::CASCADE   => true,
                    Relation::INNER_KEY => 'id',
                    Relation::OUTER_KEY => 'idPilot',
                ]
            ]
        ]
    ],
    'race' => [
        Schema::ENTITY      => Race::class,
        Schema::MAPPER      => Mapper::class,
        Schema::DATABASE    => 'default',
        Schema::TABLE       => 'race',
        Schema::PRIMARY_KEY => 'id',
        Schema::COLUMNS     => [
            'id' => 'id'
        ],
        Schema::TYPECAST    => [
            'id' => 'int'
        ],
        Schema::SCHEMA      => [],
        Schema::RELATIONS   => [
            'startingNumber' => [
                Relation::TYPE   => Relation::HAS_ONE,
                Relation::TARGET => 'startingNumber',
                Relation::SCHEMA => [
                    Relation::CASCADE   => true,
                    Relation::INNER_KEY => 'id',
                    Relation::OUTER_KEY => 'idStartingNumber',
                ]
            ],
            'lapTime' => [
                Relation::TYPE   => Relation::HAS_ONE,
                Relation::TARGET => 'lapTime',
                Relation::SCHEMA => [
                    Relation::CASCADE   => true,
                    Relation::INNER_KEY => 'id',
                    Relation::OUTER_KEY => 'idLapTime',
                ]
            ]
        ]
    ]
];

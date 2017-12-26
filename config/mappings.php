<?php
use Ramsey\Uuid\Doctrine\UuidGenerator;

return [
    'App\\Domain\\Cart\\Cart' => [
        'type'   => 'entity',
        'table'  => 'carts',
        'id'     => [
            'id' => [
                'type'     => 'uuid',
                'generator' => [
                    'strategy' => 'custom'
                ],
                'customIdGenerator' => [
                    'class' => UuidGenerator::class,
                ],
            ],
        ],
        'fields' => [
            'wishlist' => [
                'type' => 'boolean',
            ]
        ],
    ],
    'App\\Domain\\Item\\Item' => [
        'type'   => 'entity',
        'table'  => 'items',
        'id'     => [
            'id' => [
                'type'     => 'uuid',
                'generator' => [
                    'strategy' => 'custom'
                ],
                'customIdGenerator' => [
                    'class' => UuidGenerator::class,
                ],
            ],
        ],
        'fields' => [
            'name' => [
                'type' => 'string'
            ],
            'price' => [
                'type' => 'float',
            ]
        ],
    ],
    'App\\Domain\\ItemCart\\ItemCart' => [
        'type'   => 'entity',
        'table'  => 'item_cart',
        'id'     => [
            'id' => [
                'type'     => 'uuid',
                'generator' => [
                    'strategy' => 'custom'
                ],
                'customIdGenerator' => [
                    'class' => UuidGenerator::class,
                ],
            ],
        ],
        'fields' => [
            'cart_id' => [
                'type' => 'string'
            ],
            'item_id' => [
                'type' => 'string'
            ],
        ],
        'oneToOne' => [
            'cart' => [
                    'targetEntity' => '\\App\\Domain\\Cart\\Cart',
                    'joinColumn' => [
                        'name' => 'cart_id',
                        'referencedColumnName' => 'id'
                    ],
                    'cascade' => ["persist", "merge"],
                ],
            'item' => [
                    'targetEntity' => '\\App\\Domain\\Item\\Item',
                    'joinColumn' => [
                        'name' => 'item_id',
                        'referencedColumnName' => 'id'
                    ],
                    'cascade' => ["persist", "merge"]
                ]
        ]
    ],
];

<?php
return [
    'service_manager' => [
        'factories' => [
            \Status\V1\Rest\Status\StatusResource::class => \Status\V1\Rest\Status\StatusResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'status.rest.status' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/status[/:status_id]',
                    'defaults' => [
                        'controller' => 'Status\\V1\\Rest\\Status\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'status.rest.status',
        ],
    ],
    'api-tools-rest' => [
        'Status\\V1\\Rest\\Status\\Controller' => [
            'listener' => \Status\V1\Rest\Status\StatusResource::class,
            'route_name' => 'status.rest.status',
            'route_identifier_name' => 'status_id',
            'collection_name' => 'status',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \StatusLib\Entity::class,
            'collection_class' => \StatusLib\Collection::class,
            'service_name' => 'Status',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Status\\V1\\Rest\\Status\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Status\\V1\\Rest\\Status\\Controller' => [
                0 => 'application/vnd.status.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Status\\V1\\Rest\\Status\\Controller' => [
                0 => 'application/vnd.status.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Status\V1\Rest\Status\StatusEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializableHydrator::class,
            ],
            \Status\V1\Rest\Status\StatusCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'is_collection' => true,
            ],
            \StatusLib\Entity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'hydrator' => \Laminas\Hydrator\ObjectPropertyHydrator::class,
            ],
            \StatusLib\Collection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'status.rest.status',
                'route_identifier_name' => 'status_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Status\\V1\\Rest\\Status\\Controller' => [
            'input_filter' => 'Status\\V1\\Rest\\Status\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Status\\V1\\Rest\\Status\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '140',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'message',
                'description' => 'A status message of no more than 140 characters',
                'error_message' => 'A status message must contain between 1 and 140 characters',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Regex::class,
                        'options' => [
                            'pattern' => '/^(dev)$/',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'user',
                'description' => 'The user submitting the status message.',
                'error_message' => 'You must provide a valid user.',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\Digits::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'timestamp',
                'description' => 'The timestamp when the status message was last modified',
                'error_message' => 'You must provide a timestamp',
            ],
        ],
    ],
    'api-tools-mvc-auth' => [
        'authorization' => [
            'Status\\V1\\Rest\\Status\\Controller' => [
                'collection' => [
                    'GET' => false,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => false,
                    'POST' => false,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
    ],
];

<?php

namespace Api;

return array(
    'errors' => array(
        'post_processor' => 'json-pp',
        'show_exceptions' => array(
            'message' => true,
            'trace' => true
        )
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'json-pp' => 'Api\PostProcessor\Json',
                'image-pp' => 'Api\PostProcessor\Image',
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'info' => 'Api\Controller\InfoController',
            'goal' => 'Api\Controller\GoalController',
        )
    ),
    'router' => array(
        'routes' => array(
            'restful' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/:controller[.:formatter][/:id]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'formatter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[a-zA-Z0-9_-]*'
                    ),
                ),
            ),
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);

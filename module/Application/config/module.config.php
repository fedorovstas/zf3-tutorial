<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Album\AlbumController;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => \Album\Controller\AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Home',
                'route' => 'album',
                'pages' => [
                    [
                        'label' => 'Add',
                        'route' => 'album',
                        'action' => 'add'
                    ],
                    [
                        'label' => 'Edit',
                        'route' => 'album',
                        'action' => 'edit'
                    ],
                    [
                        'label' => 'Delete',
                        'route' => 'album',
                        'action' => 'delete'
                    ]
                ]
            ],
            [
                'label' => 'Blog',
                'route' => 'blog',
                'pages' => [
                    [
                        'label' => 'Add',
                        'route' => 'blog/add',
                        'action' => 'add'
                    ],
                    [
                        'label' => 'Edit',
                        'route' => 'blog/edit',
                        'action' => 'edit'
                    ],
                    [
                        'label' => 'Delete',
                        'route' => 'blog/delete',
                        'action' => 'delete'
                    ],
                    [
                        'label' => 'Detail',
                        'route' => 'blog/detail',
                        'action' => 'detail'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];

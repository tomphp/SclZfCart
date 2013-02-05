<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'SclZfCart\Controller\Checkout' => 'SclZfCart\Controller\CheckoutController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'cart' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/cart',
                    'defaults' => array(
                        'controller' => 'SclZfCart\Controller\Checkout',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    //'view' => array(
                    //    'type'    => 'literal',
                    //    'options' => array(
                    //        'route'    => '/view',
                    //        'defaults' => array(
                    //            'controller' => 'SclZfCart\Controller\Checkout',
                    //            'action'     => 'index',
                    //        ),
                    //    ),
                    //),
                ), 
            ),
        ),
    ),

    'scl_cart' => array(
        'session_name' => 'SclZfCart',
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'SclZfCart\Controller' => __DIR__ . '/../view',
        ),
    ),
);

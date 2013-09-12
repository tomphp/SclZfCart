<?php

namespace SclZfCart;

return array(
    'controllers' => array(
        'invokables' => array(
            'SclZfCart\Controller\Cart'     => 'SclZfCart\Controller\CartController',
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
                        'controller' => 'SclZfCart\Controller\Cart',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes'  => array(
                    'remove' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/remove/:item',
                            'defaults' => array(
                                'controller' => 'SclZfCart\Controller\Cart',
                                'action'     => 'removeItem',
                            ),
                        ),
                    ),
                    'checkout' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/checkout',
                            'defaults' => array(
                                'controller' => 'SclZfCart\Controller\Checkout',
                                'action'     => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes'  => array(
                            'process' => array(
                                'type'    => 'literal',
                                'options' => array(
                                    'route'    => '/process',
                                    'defaults' => array(
                                        'controller' => 'SclZfCart\Controller\Checkout',
                                        'action'     => 'process',
                                    ),
                                ),
                            ),
                            'complete' => array(
                                'type'    => 'literal',
                                'options' => array(
                                    'route'    => '/complete',
                                    'defaults' => array(
                                        'controller' => 'SclZfCart\Controller\Checkout',
                                        'action'     => 'completed',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'asset_manager' => array(
        'resolver_configs' => array(
            'map' => array(
                'css/scl-zf-cart/cart.css' => __DIR__ . '/../public/less/cart.less',
            ),
        ),
        'filters' => array(
            'css/scl-zf-cart/cart.css' => array(
                array(
                    'filter' => 'LessphpFilter',
                ),
            ),
        ),
    ),

    'scl_zf_cart' => array(
        'session_name'       => 'SclZfCart',
        'storage_class'      => 'SclZfCart\Storage\DoctrineStorage',
        'order_class'        => 'SclZfCart\Entity\Order',
        'item_class'         => 'SclZfCart\Entity\OrderItem',
        'order_mapper_class' => 'SclZfCart\Mapper\OrderMapper',
        'item_mapper_class'  => 'SclZfCart\Mapper\OrderItemMapper',
    ),

    // @todo Move to .dist config file
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml/doctrine-entities'
            ),
            'orm_default' => array(
                'drivers' => array(
                    // Added trailing backslash to avoid partial matches
                    __NAMESPACE__ . '\\' => __NAMESPACE__ . '_driver',
                ),
            ),
        ),
    ),

    'controller_plugins' => array(
        'invokables' => array(
            'getCart' => 'SclZfCart\Controller\Plugin\Cart',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'getCart' => 'SclZfCart\View\Helper\Cart',
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'SclZfCart\Controller' => __DIR__ . '/../view',
        ),
    ),
);

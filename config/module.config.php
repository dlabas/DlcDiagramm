<?php
namespace DlcDiagramm;

return array(
    'controllers' => array(
        'invokables' => array(
            'dlcdiagramm_yuml' => 'DlcDiagramm\Controller\YumlController',
        ),
    ),

    //diagramm/yuml/proxy
    'router' => array(
        'routes' => array(
            'dlcdiagramm' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/diagramm',
                    'defaults' => array(
                        'controller' => 'dlcdiagramm_yuml',
                        'action'     => 'proxy',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'yuml' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route'    => '/yuml[/dsl_text/:dslText]',
                            'constraints' => array(
                            ),
                            'defaults' => array(
                                'controller' => 'dlcdiagramm_yuml',
                                'action'     => 'proxy',
                                'dslText'    => null,
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'dlcdiagramm' => __DIR__ . '/../view',
        ),
    ),
);
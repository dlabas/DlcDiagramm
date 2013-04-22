<?php
namespace DlcDiagramm;

use DlcBase\Module\AbstractModule;

class Module extends AbstractModule
{
    /**
     * (non-PHPdoc)
     * @see \DlcBase\Module\AbstractModule::getServiceConfig()
     */
    public function getServiceConfig()
    {
        return array(
            'aliases' => array(
            ),
            
            'invokables' => array(
                'dlcdiagramm_diagramm_service' => 'DlcDiagramm\Service\Diagramm',
            ),
            
            'factories' => array(
                'dlcdiagramm_yuml_httpclient' => function ($sm) {
                    $httpClient = new \Zend\Http\Client(\DlcDiagramm\Generator\Yuml::YUML_URL, array('timeout' => 30));
                    $httpClient->setMethod(\Zend\Http\Request::METHOD_POST);
                    return $httpClient;
                },
                'dlcdiagramm_yuml_generator' => function ($sm) {
                    $filter = new \Zend\Filter\FilterChain();
                    $filter->attach(new \Zend\Filter\Word\DashToUnderscore())
                           ->attach(new \Zend\Filter\Word\SeparatorToCamelCase(' '));
                    
                    $generator  = new \DlcDiagramm\Generator\Yuml($sm->get('dlcdiagramm_yuml_httpclient'));
                    $generator->setFilter($filter);
                    return $generator;
                },
                'dlcdiagramm_module_options' => function ($sm) {
                    $config = $sm->get('Config');
                    return new Options\ModuleOptions(isset($config['dlcdiagramm']) ? $config['dlcdiagramm'] : array());
                },
            ),
        );
    }
}
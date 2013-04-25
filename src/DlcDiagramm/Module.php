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
                'dlcdiagramm_yuml_generator' => 'DlcDiagramm\Generator\Yuml',
                'dlcdiagramm_yuml_proxy' => 'DlcDiagramm\Proxy\Yuml',
                'dlcdiagramm_diagramm_service' => 'DlcDiagramm\Service\Diagramm',
            ),

            'factories' => array(
                'dlcdiagramm_yuml_filter' => function ($sm) {
                    $filter = new \Zend\Filter\FilterChain();
                    $filter->attach(new \Zend\Filter\Word\SeparatorToCamelCase(' '))
                           ->attach(new \Zend\Filter\Word\DashToUnderscore());
                    return $filter;
                },
                'dlcdiagramm_yuml_httpclient' => function ($sm) {
                    $url = $sm->get('dlcdiagramm_module_options')->getYumlUrl();
                    $httpClient = new \Zend\Http\Client($url, array('timeout' => 30));
                    $httpClient->setMethod(\Zend\Http\Request::METHOD_POST);
                    return $httpClient;
                },
                'dlcdiagramm_module_options' => function ($sm) {
                    $config = $sm->get('Config');
                    return new Options\ModuleOptions(isset($config['dlcdiagramm']) ? $config['dlcdiagramm'] : array());
                },
            ),
        );
    }
}
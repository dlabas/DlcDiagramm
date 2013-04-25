<?php
namespace DlcDiagramm\Proxy;

use DlcBase\Options\ModuleOptionsAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractProxy implements ModuleOptionsAwareInterface, ServiceLocatorAwareInterface
{
    /**
     * The module options
     *
     * @var \DlcDiagramm\Options\ModuleOptions
     */
    protected $options;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * Getter for $options
     *
     * @return \DlcDiagramm\Options\ModuleOptions $options
     */
    public function getOptions()
    {
        if (null === $this->options) {
            $serviceKey = 'dlcdiagramm_module_options';
            $this->setOptions($this->getServiceLocator()->get($serviceKey));
        }
        return $this->options;
    }

    /**
     * Setter for $options
     *
     * @param  \DlcDiagramm\Options\ModuleOptions $options
     * @return Yuml
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Set serviceManager instance
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return void
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Retrieve serviceManager instance
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Requests a diagramm from a web service
     *
     * @param string $type
     * @param string $text
     * @return string
     */
    abstract public function requestDiagramm($type, $text);
}
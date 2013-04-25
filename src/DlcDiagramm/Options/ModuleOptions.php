<?php

namespace DlcDiagramm\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions
{
    /**
     * Turn off strict options mode
     */
    protected $__strictMode__ = false;

    /**
     * The URL to yuml.me service
     *
     * @var string
     */
    protected $yumlUrl = 'http://yuml.me/';

    /**
     * The URL to yuml.me activity diagramm service
     *
     * @var string
     */
    protected $yumlActivityDiagrammUrl = 'http://yuml.me/diagram/activity/';

    /**
     * The URL to yuml.me class diagramm service
     *
     * @var string
     */
    protected $yumlClassDiagrammUrl = 'http://yuml.me/diagram/class/';

    /**
     * The URL to yuml.me use case diagramm service
     *
     * @var string
     */
    protected $yumlUseCaseDiagrammUrl = 'http://yuml.me/diagram/usecase/';

    /**
     * Return an dummy image instead of calling yuml?
     *
     * @var boolean
     */
    protected $returnDummyImage = false;

    /**
     * Path to dummy image
     *
     * @var string
     */
    protected $dummyImage = '/img/no_thumbnail.png';

    /**
     * Getter for $yumlUrl
     *
     * @return string $yumlUrl
     */
    public function getYumlUrl()
    {
        return $this->yumlUrl;
    }

    /**
     * Setter for $yumlUrl
     *
     * @param  string $yumlUrl
     * @return ModuleOptions
     */
    public function setYumlUrl($yumlUrl)
    {
        $this->yumlUrl = $yumlUrl;
        return $this;
    }

    /**
     * Getter for $yumlActivityDiagrammUrl
     *
     * @return string $yumlActivityDiagrammUrl
     */
    public function getYumlActivityDiagrammUrl()
    {
        return $this->yumlActivityDiagrammUrl;
    }

    /**
     * Setter for $yumlActivityDiagrammUrl
     *
     * @param  string $yumlActivityDiagrammUrl
     * @return ModuleOptions
     */
    public function setYumlActivityDiagrammUrl($yumlActivityDiagrammUrl)
    {
        $this->yumlActivityDiagrammUrl = $yumlActivityDiagrammUrl;
        return $this;
    }

    /**
     * Getter for $yumlClassDiagrammUrl
     *
     * @return string $yumlClassDiagrammUrl
     */
    public function getYumlClassDiagrammUrl()
    {
        return $this->yumlClassDiagrammUrl;
    }

    /**
     * Setter for $yumlClassDiagrammUrl
     *
     * @param  string $yumlClassDiagrammUrl
     * @return ModuleOptions
     */
    public function setYumlClassDiagrammUrl($yumlClassDiagrammUrl)
    {
        $this->yumlClassDiagrammUrl = $yumlClassDiagrammUrl;
        return $this;
    }

    /**
     * Getter for $yumlUseCaseDiagrammUrl
     *
     * @return string $yumlUseCaseDiagrammUrl
     */
    public function getYumlUseCaseDiagrammUrl()
    {
        return $this->yumlUseCaseDiagrammUrl;
    }

    /**
     * Setter for $yumlUseCaseDiagrammUrl
     *
     * @param  string $yumlUseCaseDiagrammUrl
     * @return ModuleOptions
     */
    public function setYumlUseCaseDiagrammUrl($yumlUseCaseDiagrammUrl)
    {
        $this->yumlUseCaseDiagrammUrl = $yumlUseCaseDiagrammUrl;
        return $this;
    }

    /**
     * Getter for $returnDummyImage
     *
     * @return boolean $returnDummyImage
     */
    public function getReturnDummyImage()
    {
        return $this->returnDummyImage;
    }

    /**
     * Setter for $returnDummyImage
     *
     * @param  boolean $returnDummyImage
     * @return ModuleOptions
     */
    public function setReturnDummyImage($returnDummyImage)
    {
        $this->returnDummyImage = $returnDummyImage;
        return $this;
    }

    /**
     * Getter for $dummyImage
     *
     * @return string $dummyImage
     */
    public function getDummyImage()
    {
        return $this->dummyImage;
    }

    /**
     * Setter for $dummyImage
     *
     * @param  string $dummyImage
     * @return ModuleOptions
     */
    public function setDummyImage($dummyImage)
    {
        $this->dummyImage = $dummyImage;
        return $this;
    }
}
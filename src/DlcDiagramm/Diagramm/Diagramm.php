<?php
namespace DlcDiagramm\Diagramm;

use DlcDiagramm\Diagramm\Dependency\DependencyInterface;
use DlcDiagramm\Diagramm\Node\NodeInterface;
use DlcDiagramm\Generator\AbstractGenerator;
use Zend\Stdlib\ArrayObject;

class Diagramm implements DiagrammInterface
{
    const TYPE_ACTIVITY = 'Activity';
    const TYPE_CLASS    = 'Class';
    const TYPE_DIAGRAMM = 'Diagramm';
    const TYPE_USE_CASE = 'UseCase';
    
    /**
     * Diagramm type
     * 
     * @var string
     */
    protected $type;
    
    /**
     * Nodes of this diagramm
     * 
     * @var array
     */
    protected $nodes = array();
    
    /**
     * Dependencies of this diagramm
     * 
     * @var array
     */
    protected $dependencies = array();
    
    /**
     * The diagramm generator
     * 
     * @var AbstractGenerator
     */
    protected $generator;
    
    /**
     * Available diagramm types
     * 
     * @var array
     */
    protected static $availableTypes = array(
        self::TYPE_ACTIVITY,
        self::TYPE_CLASS,
        self::TYPE_DIAGRAMM,
        self::TYPE_USE_CASE
    );
    
	/**
     * Getter for $type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

	/**
     * Setter for $type
     *
     * @param  string $type
     * @return Diagramm
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

	/**
     * Getter for $nodes
     *
     * @return array $nodes
     */
    public function getNodes()
    {
        return $this->nodes;
    }

	/**
     * Setter for $nodes
     *
     * @param  array $nodes
     * @return Diagramm
     */
    public function setNodes(array $nodes)
    {
        $this->nodes = $nodes;
        return $this;
    }
    
    /**
     * Add a node
     * 
     * @param NodeInterface $node
     */
    public function addNode(NodeInterface $node)
    {
        $this->nodes[$node->getNodeIdentifier()] = $node;
    }

	/**
     * Getter for $dependencies
     *
     * @return array $dependencies
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

	/**
     * Setter for $dependencies
     *
     * @param  array $dependencies
     * @return Diagramm
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;
        return $this;
    }

    /**
     * Add a dependency
     * 
     * @param DependencyInterface $dependency
     * @return \DlcDiagramm\Diagramm\Diagramm
     */
    public function addDependency(DependencyInterface $dependency)
    {
        $this->dependencies[] = $dependency;
        return $this;
    }
	/**
     * Getter for $availableTypes
     *
     * @return multitype: $availableTypes
     */
    public function getAvailableTypes()
    {
        return $this->availableTypes;
    }
	/**
     * Getter for $generator
     *
     * @return \DlcDiagramm\Generator\AbstractGenerator $generator
     */
    public function getGenerator()
    {
        return $this->generator;
    }

	/**
     * Setter for $generator
     *
     * @param  \DlcDiagramm\Generator\AbstractGenerator $generator
     * @return Diagramm
     */
    public function setGenerator(AbstractGenerator $generator)
    {
        $this->generator = $generator;
        return $this;
    }

    public function toText()
    {
        return $this->getGenerator()->generateText($this);
    }

    public function toImage()
    {
        return $this->getGenerator()->generateImage($this);
    }
}
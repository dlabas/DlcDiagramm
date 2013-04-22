<?php
namespace DlcDiagramm\Diagramm;

use DlcDiagramm\Diagramm\Dependency\DependencyInterface;
use DlcDiagramm\Diagramm\Node\NodeInterface;
use Zend\Stdlib\ArrayObject;

class Node implements NodeInterface
{
    const TYPE_USE_CASE = 'UseCase';
    
    /**
     * The name of the name
     * 
     * @var string
     */
    protected $nodeName;
    
    /**
     * Dependencies of this node
     * 
     * @var ArrayObject
     */
    protected $dependencies;
    
    /**
     * Node type
     * 
     * @var string
     */
    protected $nodeType;
    
    /**
     * The constuctor
     */
    public function __construct()
    {
        $this->setDependencies(new ArrayObject());
    }
    
    /**
     * Getter for $nodeName
     *
     * @return string $nodeName
     */
    public function getNodeName()
    {
        return $this->nodeName;
    }

	/**
     * Setter for $nodeName
     *
     * @param  string $nodeName
     * @return Node
     */
    public function setNodeName($nodeName)
    {
        $this->nodeName = $nodeName;
        return $this;
    }

	/**
     * Getter for $dependencies
     *
     * @return \Zend\Stdlib\ArrayObject $dependencies
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

	/**
     * Setter for $dependencies
     *
     * @param  \Zend\Stdlib\ArrayObject $dependencies
     * @return Node
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;
        return $this;
    }

	/**
     * Getter for $nodeType
     *
     * @return string $nodeType
     */
    public function getNodeType()
    {
        return $this->nodeType;
    }

	/**
     * Setter for $nodeType
     *
     * @param  string $nodeType
     * @return Node
     */
    public function setNodeType($nodeType)
    {
        $this->nodeType = $nodeType;
        return $this;
    }

	/**
     * Returns the unique identifier of this node
     *
     * @return string
     */
    public function getNodeIdentifier()
    {
        return $this->getName();
    }
    
    
    /**
     * Add an dependency
     * 
     * @param Dependency $dependency
     * @return \DlcDiagramm\Diagramm\Node
     */
    public function addDependency(DependencyInterface $dependency)
    {
        $this->getDependencies()->apend($dependency);
        return $this;
    }
    
    
}
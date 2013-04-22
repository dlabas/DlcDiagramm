<?php
namespace DlcDiagramm\Diagramm\Node;

use DlcDiagramm\Diagramm\Dependency\DependencyInterface;
use Zend\Stdlib\ArrayObject;

interface NodeInterface
{
    /**
     * Returns the unique identifier of this node
     * 
     * @return string
     */
    public function getNodeIdentifier();
    
    /**
     * Getter for $name
     *
     * @return string $name
     */
    public function getNodeName();
    
    /**
     * Getter for $dependencies
     *
     * @return \Zend\Stdlib\ArrayObject $dependencies
     */
    public function getDependencies();
    
    /**
     * Returns the node type
     *
     * @return string $type
     */
    public function getNodeType();
}
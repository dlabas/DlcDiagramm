<?php
namespace DlcDiagramm\Diagramm\Dependency;

use DlcDiagramm\Diagramm\Node\NodeInterface;

interface DependencyInterface
{
    /**
     * Returns the unique identifier of this dependency
     *
     * @return string
     */
    public function getIdentifier();
    
    /**
     * Set from node
     * 
     * @param NodeInterface $node
     * @return \DlcDiagramm\Diagramm\Dependency
     */
    public function from(NodeInterface $node);
    
    /**
     * Set the to node
     *
     * @param NodeInterface $node
     * @return Ambigous \DlcDiagramm\Diagramm\Dependency
     */
    public function to(NodeInterface $node);
    
    /**
     * Getter for $type
     *
     * @return string $type
     */
    public function getType();
    
    /**
     * Setter for $type
     *
     * @param  string $type
     * @return Dependency
     */
    public function setType($type);
}
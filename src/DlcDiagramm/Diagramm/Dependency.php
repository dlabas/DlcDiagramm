<?php
namespace DlcDiagramm\Diagramm;

use DlcDiagramm\Diagramm\Dependency\DependencyInterface;
use DlcDiagramm\Diagramm\Node\NodeInterface;

class Dependency implements DependencyInterface
{
    const TYPE_ASSOCIATION    = 'association';
    const TYPE_AGGREGATION    = 'aggregation';
    const TYPE_COMPOSITION    = 'composition';
    const TYPE_EXTENSION      = 'extension';
    const TYPE_GENERALIZATION = 'generalization';
    const TYPE_INCLUSION      = 'inclusion';
    const TYPE_INHERITANCE    = 'inheritance';
    const TYPE_REALIZATION    = 'realization';
    
    
    /** 
     * @var NodeInterface
     */
    protected $fromNode;
    
    /**
     * @var NodeInterface
     */
    protected $toNode;
    
    /**
     * Dependency type
     * 
     * @var string
     */
    protected $type;
    
    /**
     * Array os available types
     * @var unknown_type
     */
    static protected $staticAvailableTypes = array(
        self::TYPE_ASSOCIATION => 'association',
        //self::TYPE_AGGREGATION => '',
        //self::TYPE_COMPOSITION,
        self::TYPE_EXTENSION => 'extends',
        //self::TYPE_GENERALIZATION,
        self::TYPE_INCLUSION => 'includes',
        self::TYPE_INHERITANCE => 'inherits',
        //self::TYPE_REALIZATION,
    );
    
    protected $availableTypes = array(
        self::TYPE_ASSOCIATION,
        self::TYPE_AGGREGATION,
        self::TYPE_COMPOSITION,
        self::TYPE_EXTENSION,
        self::TYPE_GENERALIZATION,
        self::TYPE_INCLUSION,
        self::TYPE_INHERITANCE,
        self::TYPE_REALIZATION,
    );
    
    /**
     * The constructor
     * 
     * @param string $type
     */
    public function __construct($type = self::TYPE_ASSOCIATION)
    {
        $this->setType($type);
    }
    
    /**
     * Returns the unique identifier of this node
     *
     * @return string
     */
    public function getIdentifier()
    {
        $identifier = $this->getFromNode()->getIdentifier() 
                    . '-'
                    . $this->getType()
                    . '-'
                    . $this->getToNode()->getIdentifier();
        
        return $identifier;
    }
    
	/**
     * Getter for $fromNode
     *
     * @return \DlcDiagramm\Diagramm\NodeInterface $fromNode
     */
    public function getFromNode()
    {
        return $this->fromNode;
    }

	/**
     * Setter for $fromNode
     *
     * @param  \DlcDiagramm\Diagramm\NodeInterface $fromNode
     * @return Dependency
     */
    public function setFromNode($fromNode)
    {
        $this->fromNode = $fromNode;
        return $this;
    }
    
    /**
     * Set from node
     * 
     * @param NodeInterface $node
     * @return \DlcDiagramm\Diagramm\Dependency
     */
    public function from(NodeInterface $node)
    {
        return $this->setFromNode($node);
    }

	/**
     * Getter for $toNode
     *
     * @return \DlcDiagramm\Diagramm\NodeInterface $toNode
     */
    public function getToNode()
    {
        return $this->toNode;
    }

	/**
     * Setter for $toNode
     *
     * @param  \DlcDiagramm\Diagramm\NodeInterface $toNode
     * @return Dependency
     */
    public function setToNode($toNode)
    {
        $this->toNode = $toNode;
        return $this;
    }
    
    /**
     * Set the to node
     * 
     * @param NodeInterface $node
     * @return Ambigous \DlcDiagramm\Diagramm\Dependency
     */
    public function to(NodeInterface $node)
    {
        return $this->setToNode($node);
    }

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
     * @return Dependency
     */
    public function setType($type)
    {
        if (!in_array($type, $this->getAvailableTypes())) {
            throw new \InvalidArgumentException('Unknown dependency type "' . $type . '"');
        }
        $this->type = $type;
        return $this;
    }
    
	/**
     * Getter for $availableTypes
     *
     * @return \DlcDiagramm\Diagramm\unknown_type $availableTypes
     */
    public function getAvailableTypes()
    {
        return $this->availableTypes;
    }
    
    static public function getAvailableTypesStatic()
    {
        return self::$staticAvailableTypes;
    }

	/**
     * Setter for $availableTypes
     *
     * @param  \DlcDiagramm\Diagramm\unknown_type $availableTypes
     * @return Dependency
     */
    public function setAvailableTypes($availableTypes)
    {
        $this->availableTypes = $availableTypes;
        return $this;
    }
}
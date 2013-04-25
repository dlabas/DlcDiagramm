<?php
namespace DlcDiagramm\Generator;

use DlcDiagramm\Diagramm\Dependency;
use DlcDiagramm\Diagramm\Dependency\DependencyInterface;
use DlcDiagramm\Diagramm\Diagramm;
use DlcDiagramm\Diagramm\DiagrammInterface;
use DlcDiagramm\Diagramm\Node;
use DlcDiagramm\Diagramm\Node\NodeInterface;
use DlcDiagramm\Diagramm\NoteProviderInterface;
use DlcDiagramm\Proxy\Yuml as YumlProxy;
use Zend\Http\Client;

class Yuml extends AbstractGenerator
{
    /**
     *
     * @var \Zend\Filter\Filter
     */
    protected $filter;

    /**
     *
     * @var YumlProxy
     */
    protected $proxy;

    /**
     * Dependency type to dsl text map
     *
     * @var array
     */
    protected $dependncyTypeToDslText = array(
        Dependency::TYPE_ASSOCIATION       => '-',
        Dependency::TYPE_AGGREGATION       => '+->',
        Dependency::TYPE_CLASS_INHERITANCE => '^-',
        Dependency::TYPE_COMPOSITION       => '++-1>',
        Dependency::TYPE_EXTENSION         => '<',
        //Dependency::TYPE_GENERALIZATION  => '',
        Dependency::TYPE_INCLUSION         => '>',
        Dependency::TYPE_INHERITANCE       => '^',
        //Dependency::TYPE_REALIZATION     => ''
    );

    /**
     * Node type to dsl text map
     *
     * @var array
     */
    protected $nodeTypeToDslText = array(
        Node::TYPE_NOTE     => '(note: %s{bg:%s})',
        Node::TYPE_USE_CASE => '(%s)',
    );

    /**
     * Getter for $filter
     *
     * @return \Zend\Filter\Filter $filter
     */
    public function getFilter()
    {
        if ($this->filter === null) {
            $this->setFilter($this->getServiceLocator()->get('dlcdiagramm_yuml_filter'));
        }
        return $this->filter;
    }

	/**
     * Setter for $filter
     *
     * @param  \Zend\Filter\Filter $filter
     * @return Yuml
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * Getter for $proxy
     *
     * @return \DlcDiagramm\Proxy\Yuml $proxy
     */
    public function getProxy()
    {
        if (!$this->proxy instanceof YumlProxy) {
            $this->setProxy($this->getServiceLocator()->get('dlcdiagramm_yuml_proxy'));
        }
        return $this->proxy;
    }

    /**
     * Setter for $proxy
     *
     * @param  \DlcDiagramm\Proxy\Yuml $proxy
     * @return Yuml
     */
    public function setProxy($proxy)
    {
        $this->proxy = $proxy;
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see \DlcDiagramm\Generator\AbstractGenerator::generate()
     */
	public function generate(DiagrammInterface $diagramm)
    {
        return $this->generateImage($diagramm);
    }

    /**
     * Generates an image of the diagramm
     *
     * @param DiagrammInterface $diagramm
     */
    public function generateImage(DiagrammInterface $diagramm)
    {
        $dslText = $this->generateDslText($diagramm);

        $diagramm->setAsText($dslText);

        return $this->getProxy()->requestDiagramm($diagramm->getType(), $dslText);
    }

    /**
     * Generates text diagramm of the diagramm
     *
     * @param DiagrammInterface $diagramm
     */
    public function generateText(DiagrammInterface $diagramm)
    {
        return $this->generateDslText($diagramm);
    }

    /**
     * Generates dsl text for the diagramm
     *
     * @param DiagrammInterface $diagramm
     */
    public function generateDslText(DiagrammInterface $diagramm)
    {
        $dslText = '';

        foreach ($diagramm->getNodes() as $node) {
            $dslText .= $this->nodeToDslText($node);
            $dslText .= ',';

            //Create a note if the note information is set
            $dslText .= $this->noteFromNodeToDslText($node);

            foreach ($node->getDependencies() as $dependency) {
                $dslText .= $this->dependencyToDslText($dependency);
                $dslText .= ',';
            }
        }

        if (substr($dslText, -1, 1) == ',') {
            $dslText = substr($dslText, 0, -1);
        }

        return $dslText;
    }

    /**
     * Converts a node to dsl text
     *
     * @param NodeInterface $node
     * @throws \InvalidArgumentException
     * @return string
     */
    public function nodeToDslText(NodeInterface $node)
    {
        switch ($node->getNodeType()) {
            case Node::TYPE_USE_CASE:
                return $this->useCaseNodeToDslText($node);
                break;
            default:
                throw new \InvalidArgumentException('Unknown node type "' . $node->getNodeType() . '"');
                break;
        }
    }

    /**
     * Converts a note of a node to dsl text
     *
     * @param NodeInterface $node
     * @throws \InvalidArgumentException
     * @return string
     */
    public function noteFromNodeToDslText(NodeInterface $node)
    {
        if (!$node instanceof NoteProviderInterface) {
            throw new \InvalidArgumentException('Node must implement NoteProviderInterface');
        }

        $note   = $node->getNote();
        $noteBg = $node->getNoteBg();

        if (!is_string($note) || strlen($note) < 1) {
            return '';
        }

        if (!is_string($noteBg) || strlen($noteBg) < 1) {
            $noteBg = NoteProviderInterface::BG_BEIGE;
        }

        $noteDslText = $this->useCaseNodeToDslText($node)
                     . $this->dependncyTypeToDslText[Dependency::TYPE_ASSOCIATION]
                     . sprintf($this->nodeTypeToDslText[Node::TYPE_NOTE], $note, $noteBg)
                     . ',';

        return $noteDslText;
    }

    /**
     * Converts a dependency to dsl text
     *
     * @param DependencyInterface $dependency
     * @throws \InvalidArgumentException
     * @return string
     */
    public function dependencyToDslText(DependencyInterface $dependency)
    {
        $type = $dependency->getType();

        if (!array_key_exists($type, $this->dependncyTypeToDslText)) {
            throw new \InvalidArgumentException('Unknown dependncy type "' . $type . '"');
        }

        $dslText = $this->nodeToDslText($dependency->getFromNode())
                 . $this->dependncyTypeToDslText[$type]
                 . $this->nodeToDslText($dependency->getToNode());

        return $dslText;
    }

    /**
     * Converts a node of type class to dsl text
     *
     * @param NodeInterface $node
     * @throws \InvalidArgumentException
     * @return string
     */
    protected function classNodeToDslText(NodeInterface $node)
    {
        return 'Not implemented yet';
    }

    /**
     * Converts a node of type use case to dsl text
     *
     * @param NodeInterface $node
     * @throws \InvalidArgumentException
     * @return string
     */
    protected function useCaseNodeToDslText(NodeInterface $node)
    {
        $dslText = sprintf(
            $this->nodeTypeToDslText[Node::TYPE_USE_CASE],
            $this->getFilter()->filter($node->getNodeName())
        );

        return $dslText;
    }

}
<?php
namespace DlcDiagramm\Generator;

use DlcDiagramm\Diagramm\DiagrammInterface;

abstract class AbstractGenerator
{
    /**
     * Generates the diagramm
     * 
     * @param DiagrammInterface $diagramm
     */
    abstract public function generate(DiagrammInterface $diagramm);
    
    /**
     * Generates an image of the diagramm
     *
     * @param DiagrammInterface $diagramm
     */
    abstract public function generateImage(DiagrammInterface $diagramm);
    
    /**
     * Generates text diagramm of the diagramm
     *
     * @param DiagrammInterface $diagramm
     */
    abstract public function generateText(DiagrammInterface $diagramm);
}
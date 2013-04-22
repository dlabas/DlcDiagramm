<?php
namespace DlcDiagramm\Service;

use DlcBase\Service\AbstractService;
use DlcDiagramm\Diagramm\Dependency\DependencyInterface;
use DlcDiagramm\Diagramm\Diagramm as BaseDiagramm;
use DlcDiagramm\Diagramm\DiagrammInterface;
use DlcDiagramm\Diagramm\UseCase as UseCaseDiagramm;

class Diagramm extends AbstractService
{
    public function createDiagrammFromNodes($nodes, $type = BaseDiagramm::TYPE_DIAGRAMM)
    {
        $serviceLocator = $this->getServiceLocator();
        
        switch ($type) {
            case BaseDiagramm::TYPE_ACTIVITY:
            case BaseDiagramm::TYPE_CLASS:
                throw new \InvalidArgumentException('Diagramm type "' . $type . '" is not supported yet');
                break;
            case BaseDiagramm::TYPE_DIAGRAMM:
                $diagramm  = new BaseDiagramm();
                $diagramm->setGenerator($serviceLocator->get('dlcdiagramm_text_generator'));
                break;
            case BaseDiagramm::TYPE_USE_CASE:
                $diagramm  = new UseCaseDiagramm();
                $diagramm->setGenerator($serviceLocator->get('dlcdiagramm_yuml_generator'));
                break;
            default:
                throw new \InvalidArgumentException('Unkown diagramm type "' . $type . '"');
                break;
        }
        
        foreach ($nodes as $node) {
            $diagramm->addNode($node);
            foreach ($node->getDependencies() as $dependency) {
                $diagramm->addDependency($dependency);
            }
        }
        
        return $diagramm;
    }
}
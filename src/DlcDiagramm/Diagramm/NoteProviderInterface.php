<?php
namespace DlcDiagramm\Diagramm;

interface NoteProviderInterface
{
    const BG_BEIGE    = 'beige';
    const BG_CORNSILK = 'cornsilk';
    const BG_GREEN    = 'green';
    const BG_ORANGE   = 'orange';
    
    /**
     * Returns an note
     * 
     * @return string
     */
    public function getNote();
    
    /**
     * Returns the background color of this note
     *
     * @return string
     */
    public function getNoteBg();
}
<?php
namespace DlcDiagramm\Controller;

use DlcBase\Controller\AbstractActionController;

class YumlController extends AbstractActionController
{
    public function proxyAction()
    {
        $post     = $this->getRequest()->getPost();
        $response = $this->getResponse();

        //@TODO error handling
        /*if (isseT($post->dsl_text)) {
            print_r($post->dsl_text);
            print_r($post->type);
        }*/

        $proxy  = $this->getServiceLocator()->get('dlcdiagramm_yuml_proxy');
        $result = $proxy->requestDiagramm($post->type, $post->dsl_text);

        $response->setContent($result);

        return $response;
    }
}
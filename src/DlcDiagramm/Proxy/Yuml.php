<?php
namespace DlcDiagramm\Proxy;

use DlcDiagramm\Diagramm\Diagramm;
use Zend\Http\Client;

class Yuml extends AbstractProxy
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * Getter for $httpClient
     *
     * @return \Zend\Http\Client $httpClient
     */
    public function getHttpClient()
    {
        if (!$this->httpClient instanceof Client) {
            $this->setHttpClient($this->getServiceLocator()->get('dlcdiagramm_yuml_httpclient'));
        }
        return $this->httpClient;
    }

    /**
     * Setter for $httpClient
     *
     * @param  \Zend\Http\Client $httpClient
     * @return Yuml
     */
    public function setHttpClient(Client $httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * Returns the URI for the yuml service for a diagramm type
     *
     * @param string $type
     * @throws \InvalidArgumentException
     * @return string
     */
    public function getUriForDiagrammType($type)
    {
        switch ($type) {
            case Diagramm::TYPE_ACTIVITY:
                $uri = $this->getOptions()->getYumlActivityDiagrammUrl();
                break;
            case Diagramm::TYPE_CLASS:
                $uri = $this->getOptions()->getYumlClassDiagrammUrl();
                break;
            case Diagramm::TYPE_DIAGRAMM:
                throw new \InvalidArgumentException('Unsupported diagramm type "' . $type . '"');
                break;
            case Diagramm::TYPE_USE_CASE:
                $uri = $this->getOptions()->getYumlUseCaseDiagrammUrl();
                break;
            default:
                throw new \InvalidArgumentException('Unkown diagramm type "' . $type . '"');
                break;
        }
        return $uri;
    }

    /**
     * Requests a diagramm from yuml web service
     *
     * @param string $type
     * @param string $dslText
     * @throws \UnexpectedValueException
     * @return string
     */
    public function requestDiagramm($type, $dslText)
    {
        if ($this->getOptions()->getReturnDummyImage()) {
            return $this->getOptions()->getDummyImage();
        }

        $httpClient = $this->getHttpClient();
        $httpClient->setUri($this->getUriForDiagrammType($type));
        $httpClient->setParameterPost(array('dsl_text' => $dslText));

        $response = $httpClient->send();

        if (!$response->isSuccess()) {
            throw new \UnexpectedValueException('HTTP Request failed');
        }

        return $this->getOptions()->getYumlUrl() . $response->getBody();
    }
}
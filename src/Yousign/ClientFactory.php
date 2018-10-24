<?php

namespace Yousign;

class ClientFactory
{
    /**
     * @var Environment
     */
    private $environment;

    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * ClientFactory constructor.
     * @param Environment $environment
     * @param Authentication|null $authentication
     */
    public function __construct(Environment $environment, Authentication $authentication = null)
    {
        $this->environment = $environment;
        $this->authentication = $authentication;
    }

    /**
     * @param array $options
     * @return Client
     */
    public function createClient($options = array())
    {
        $client = new Client();
        foreach(Services::listing() as $service) {
            $wsdl = self::buildWsdlUrl($this->environment->getHost(), $service);
            $soapClient = new \SoapClient($wsdl, $options);

            $header = new \SoapHeader('http://www.yousign.com', 'Auth', (object)(array)$this->authentication);
            $soapClient->__setSoapHeaders($header);

            $client->addSoapClient($service, $soapClient);
        }

        return $client;
    }

    /**
     * @param string $host
     * @param string $service
     * @return string
     */
    public static function buildWsdlUrl($host, $service)
    {
        return sprintf('%s/%s/%s?wsdl', $host, $service, $service);
    }
}

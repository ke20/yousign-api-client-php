<?php

namespace Tests\Yousign;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Yousign\Authentication;
use Yousign\Client;
use Yousign\ClientFactory;
use Yousign\Environment;
use Yousign\Services;

class ClientFactoryTest extends TestCase
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * @var Authentication|ObjectProphecy
     */
    protected $authentication;

    /**
     * @var ClientFactory|ObjectProphecy
     */
    protected $factory;

    protected function setUp()
    {
        $this->environment = new Environment(Environment::DEMO);
        $this->authentication = $this->prophesize(Authentication::class);

        $this->factory = new ClientFactory(
            $this->environment,
            $this->authentication->reveal()
        );
    }

    public function testCreateClient()
    {
        $client = $this->factory->createClient([]);

        $this->assertInstanceOf(Client::class, $client);

        foreach (Services::listing() as $service) {
            $this->assertTrue($client->hasSoapClient($service));
            $this->assertInstanceOf(\SoapClient::class, $client->getSoapClient($service));
        }
    }
}

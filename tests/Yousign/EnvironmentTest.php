<?php

namespace Tests\Yousign;

use PHPUnit\Framework\TestCase;
use Yousign\Environment;
use Yousign\Exception\EnvironmentException;

class EnvironmentTest extends TestCase
{
    public function testShouldThrowExceptionIfEnvironmentNotFound()
    {
        $this->expectException(EnvironmentException::class);
        $this->expectExceptionMessage('Given environment is not correct');

        new Environment('test');
    }

    public function testGetHostShouldReturnTheHostAccordingToTheGivenEnv()
    {
        $this->assertEquals('https://apidemo.yousign.fr:8181', (new Environment(Environment::DEMO))->getHost());
        $this->assertEquals('https://api.yousign.fr:8181', (new Environment(Environment::PROD))->getHost());
    }
}

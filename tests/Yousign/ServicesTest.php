<?php

namespace Tests\Yousign;

use PHPUnit\Framework\TestCase;
use Yousign\Services;

class ServicesTest extends TestCase
{
    public function testListing()
    {
        $services = Services::listing();

        $this->assertCount(3, $services);

        $this->assertContains(Services::ARCHIVE, $services);
        $this->assertContains(Services::AUTHENTICATION, $services);
        $this->assertContains(Services::COSIGNATURE, $services);
    }
}

<?php

namespace Tests\Yousign;

use PHPUnit\Framework\TestCase;
use Yousign\Authentication;

class AuthenticationTest extends TestCase
{
    public function testBuildHashedPassword()
    {
        $password = 'This is a test';
        $expectedResult = sha1(sha1($password).sha1($password));
        $this->assertEquals($expectedResult, Authentication::buildHashedPassword($password));
    }
}

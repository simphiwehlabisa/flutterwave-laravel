<?php

namespace Tests\Unit;

use Kasipay\Rave\Rave;
use Tests\TestCase;

class RaveServiceProviderTests extends TestCase
{
    /**
     * Tests if service provider Binds alias "laravelrave" to \Kasipay\Rave\Rave
     *
     * @test
     */
    public function isBound()
    {
        $this->assertTrue($this->app->bound('laravelrave'));
    }
    /**
     * Test if service provider returns \Rave as alias for \Kasipay\Rave\Rave
     *
     * @test
     */
    public function hasAliased()
    {
        $this->assertTrue($this->app->isAlias("Kasipay\Rave\Rave"));
        $this->assertEquals('laravelrave', $this->app->getAlias("Kasipay\Rave\Rave"));
    }
}

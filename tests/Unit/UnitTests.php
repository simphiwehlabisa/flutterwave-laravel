<?php

namespace Tests\Unit;

use Kasipay\Rave\Rave;
use ReflectionClass;
use ReflectionProperty;
use Tests\Concerns\ExtractProperties;
use Tests\TestCase;

class UnitTests extends TestCase
{

    use ExtractProperties;

    /**
     * Tests if app returns \Kasipay\Rave\Rave if called with ailas.
     *
     * @test
     * @return \Kasipay\Rave\Rave
     */
    public function initiateRaveFromApp()
    {

        $rave = $this->app->make("laravelrave");

        $this->assertTrue($rave instanceof Rave);

        return $rave;
    }

    /**
     * Test Rave initiallizes with default values;.
     *
     * @test
     *
     * @depends initiateRaveFromApp
     * @param \Kasipay\Rave\Rave $rave
     * @return void
     * @throws \ReflectionException
     */
    public function initializeWithDefaultValues(Rave $rave)
    {

        $reflector = new ReflectionClass($rave);

        $methods = $reflector->getProperties(ReflectionProperty::IS_PROTECTED);

        foreach ($methods as $method) {
            if ($method->getName() == 'baseUrl') {
                $baseUrl = $method;
            }

            if ($method->getName() == 'secretKey') {
                $secretKey = $method;
            }

            if ($method->getName() == 'publicKey') {
                $publicKey = $method;
            }

        };

        $baseUrl->setAccessible(true);
        $publicKey->setAccessible(true);
        $secretKey->setAccessible(true);

        $this->assertEquals($this->app->config->get("flutterwave.secretKey"), $secretKey->getValue($rave));
        $this->assertEquals($this->app->config->get("flutterwave.publicKey"), $publicKey->getValue($rave));
        $this->assertEquals(
            "https://api.flutterwave.com/v3",
            $baseUrl->getValue($rave)
        );
    }

    /**
     * Tests if transaction reference is generated.
     *
     * @test
     * @depends initiateRaveFromApp
     * @param Rave $rave
     * @return void
     */
    public function generateReference(Rave $rave)
    {

        $ref = $rave->generateReference();

        $prefix = 'flw';

        $this->assertRegExp("/^{$prefix}_\w{13}$/", $ref);
    }

    /**
     * Testing if keys are modified using setkeys.
     *
     * @test
     * @depends initiateRaveFromApp
     * @param Rave $rave
     * @return void
     * @throws \ReflectionException
     */
    public function settingKeys(Rave $rave)
    {

        $newPublicKey = "public_key";
        $newSecretKey = "secret_key";
        $rave->setKeys($newPublicKey, $newSecretKey);
        $reflector = new ReflectionClass($rave);
        $reflector = $reflector->getProperties(ReflectionProperty::IS_PROTECTED);

        $keys = array_map(function ($value) use ($rave, $newPublicKey, $newSecretKey) {
            $name = $value->getName();
            if ($name === "publicKey" || $name === "secretKey") {
                $value->setAccessible(true);
                $key = $value->getValue($rave);
                $this->assertEquals(${"new" . ucfirst($name)}, $key);
            }
        }, $reflector);
    }
}

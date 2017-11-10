<?php

namespace Swis\PdokGeodatastoreApi\Tests;

use Swis\PdokGeodatastoreApi\Api;
use Swis\PdokGeodatastoreApi\Client;
use Swis\PdokGeodatastoreApi\Exception\BadMethodCallException;
use Swis\PdokGeodatastoreApi\HttpClient\Plugin\Authentication;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function shouldNotHaveToPassHttpClientToConstructor()
    {
        $client = new Client();

        $this->assertInstanceOf(\Http\Client\HttpClient::class, $client->getHttpClient());
    }

    /**
     * @test
     */
    public function shouldPassHttpClientInterfaceToConstructor()
    {
        $httpClientMock = $this->getMockBuilder(\Http\Client\HttpClient::class)
            ->getMock();

        $client = Client::createWithHttpClient($httpClientMock);

        $this->assertInstanceOf(\Http\Client\HttpClient::class, $client->getHttpClient());
    }

    /**
     * @test
     */
    public function shouldAuthenticateUsingGivenParameters()
    {
        $builder = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\HttpClient\Builder::class)
            ->setMethods(array('addPlugin', 'removePlugin'))
            ->disableOriginalConstructor()
            ->getMock();
        $builder->expects($this->once())
            ->method('addPlugin')
            ->with($this->equalTo(new Authentication('login', 'password')));
        $builder->expects($this->once())
            ->method('removePlugin')
            ->with(Authentication::class);

        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['getHttpClientBuilder'])
            ->getMock();
        $client->expects($this->any())
            ->method('getHttpClientBuilder')
            ->willReturn($builder);

        $client->authenticate('login', 'password');
    }

    /**
     * @test
     * @dataProvider getApiClassesProvider
     */
    public function shouldGetApiInstance($apiName, $class)
    {
        $client = new Client();

        $this->assertInstanceOf($class, $client->api($apiName));
    }

    /**
     * @test
     * @dataProvider getApiClassesProvider
     */
    public function shouldGetMagicApiInstance($apiName, $class)
    {
        $client = new Client();

        $this->assertInstanceOf($class, $client->$apiName());
    }

    /**
     * @test
     * @expectedException \Swis\PdokGeodatastoreApi\Exception\InvalidArgumentException
     */
    public function shouldNotGetApiInstance()
    {
        $client = new Client();
        $client->api('do_not_exist');
    }

    /**
     * @test
     * @expectedException BadMethodCallException
     */
    public function shouldNotGetMagicApiInstance()
    {
        $client = new Client();
        $client->doNotExist();
    }

    public function getApiClassesProvider()
    {
        return array(
            array('dataset', Api\Dataset::class),
            array('datasets', Api\Dataset::class),

            array('registry', Api\Registry::class),
            array('registries', Api\Registry::class),
        );
    }
}

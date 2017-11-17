<?php

namespace Swis\PdokGeodatastoreApi\Tests;

use Swis\PdokGeodatastoreApi\Api;
use Swis\PdokGeodatastoreApi\Client;
use Swis\PdokGeodatastoreApi\Exception\BadMethodCallException;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function itShouldNotHaveToPassHttpClientToConstructor()
    {
        $client = new Client();

        $this->assertInstanceOf(\Http\Client\HttpClient::class, $client->getHttpClient());
    }

    /**
     * @test
     */
    public function itShouldPassHttpClientInterfaceToConstructor()
    {
        $httpClientMock = $this->getMockBuilder(\Http\Client\HttpClient::class)
            ->getMock();

        $client = Client::createWithHttpClient($httpClientMock);

        $this->assertInstanceOf(\Http\Client\HttpClient::class, $client->getHttpClient());
    }

    /**
     * @test
     */
    public function itShouldUseTestingEnvironment()
    {
        $builder = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\HttpClient\Builder::class)
            ->setMethods(['addPlugin', 'removePlugin'])
            ->disableOriginalConstructor()
            ->getMock();
        $builder->expects($this->once())
            ->method('addPlugin')
            ->with($this->isInstanceOf(\Http\Client\Common\Plugin\BaseUriPlugin::class));
        $builder->expects($this->once())
            ->method('removePlugin')
            ->with(\Http\Client\Common\Plugin\BaseUriPlugin::class);

        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['getHttpClientBuilder', 'getApiVersion'])
            ->getMock();
        $client->expects($this->any())
            ->method('getHttpClientBuilder')
            ->willReturn($builder);
        $client->expects($this->any())
            ->method('getApiVersion')
            ->willReturn('v1');

        $client->useTestingEnvironment();
    }

    /**
     * @test
     */
    public function itShouldAuthenticateUsingGivenParameters()
    {
        $builder = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\HttpClient\Builder::class)
            ->setMethods(['addPlugin', 'removePlugin'])
            ->disableOriginalConstructor()
            ->getMock();
        $authentication = new \Http\Message\Authentication\BasicAuth('login', 'password');
        $builder->expects($this->once())
            ->method('addPlugin')
            ->with($this->equalTo(new \Http\Client\Common\Plugin\AuthenticationPlugin($authentication)));
        $builder->expects($this->once())
            ->method('removePlugin')
            ->with(\Http\Client\Common\Plugin\AuthenticationPlugin::class);

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
    public function itShouldGetApiInstance($apiName, $class)
    {
        $client = new Client();

        $this->assertInstanceOf($class, $client->api($apiName));
    }

    /**
     * @test
     * @dataProvider getApiClassesProvider
     */
    public function itShouldGetMagicApiInstance($apiName, $class)
    {
        $client = new Client();

        $this->assertInstanceOf($class, $client->$apiName());
    }

    /**
     * @test
     * @expectedException \Swis\PdokGeodatastoreApi\Exception\InvalidArgumentException
     */
    public function itShouldNotGetApiInstance()
    {
        $client = new Client();
        $client->api('do_not_exist');
    }

    /**
     * @test
     * @expectedException BadMethodCallException
     */
    public function itShouldNotGetMagicApiInstance()
    {
        $client = new Client();
        $client->doNotExist();
    }

    public function getApiClassesProvider()
    {
        return [
            ['dataset', Api\Dataset::class],
            ['datasets', Api\Dataset::class],

            ['registry', Api\Registry::class],
            ['registries', Api\Registry::class],
        ];
    }
}

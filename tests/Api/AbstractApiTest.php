<?php

namespace Swis\PdokGeodatastoreApi\Tests\Api;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Constraint\ArraySubset;
use Swis\PdokGeodatastoreApi\Api\AbstractApi;

class AbstractApiTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldPassGETRequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMethodsMock(['get']);
        $httpClient
            ->expects($this->any())
            ->method('get')
            ->with('/path?param1=param1value', ['header1' => 'header1value'])
            ->will($this->returnValue($this->getPSR7Response($expectedArray)));
        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\Client::class)
            ->setMethods(['getHttpClient'])
            ->getMock();
        $client->expects($this->any())
            ->method('getHttpClient')
            ->willReturn($httpClient);

        $api = $this->getAbstractApiObject($client);

        $actual = $this->getMethod($api, 'get')
            ->invokeArgs($api, ['/path', ['param1' => 'param1value'], ['header1' => 'header1value']]);

        $this->assertEquals($expectedArray, $actual);
    }

    /**
     * @test
     */
    public function itShouldPassHEADRequestToClient()
    {
        $httpClient = $this->getHttpMethodsMock(['head']);
        $httpClient
            ->expects($this->any())
            ->method('head')
            ->with('/path?param1=param1value', ['header1' => 'header1value'])
            ->will($this->returnValue($this->getPSR7Response([])));
        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\Client::class)
            ->setMethods(['getHttpClient'])
            ->getMock();
        $client->expects($this->any())
            ->method('getHttpClient')
            ->willReturn($httpClient);

        $api = $this->getAbstractApiObject($client);

        $actual = $this->getMethod($api, 'head')
            ->invokeArgs($api, ['/path', ['param1' => 'param1value'], ['header1' => 'header1value']]);

        $this->assertInstanceOf(\GuzzleHttp\Psr7\Response::class, $actual);
    }

    /**
     * @test
     */
    public function itShouldPassPOSTRequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMethodsMock(['post']);
        $httpClient
            ->expects($this->once())
            ->method('post')
            ->with('/path', new ArraySubset(['option1' => 'option1value']), $this->isInstanceOf(\GuzzleHttp\Psr7\Stream::class))
            ->will($this->returnValue($this->getPSR7Response($expectedArray)));

        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\Client::class)
            ->setMethods(['getHttpClient'])
            ->getMock();
        $client->expects($this->any())
            ->method('getHttpClient')
            ->willReturn($httpClient);

        $api = $this->getAbstractApiObject($client);
        $actual = $this->getMethod($api, 'post')
            ->invokeArgs($api, ['/path', ['param1' => 'param1value'], ['option1' => 'option1value']]);

        $this->assertEquals($expectedArray, $actual);
    }

    /**
     * @test
     */
    public function itShouldPassPATCHRequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMethodsMock(['patch']);
        $httpClient
            ->expects($this->once())
            ->method('patch')
            ->with('/path', new ArraySubset(['option1' => 'option1value']), $this->isInstanceOf(\GuzzleHttp\Psr7\Stream::class))
            ->will($this->returnValue($this->getPSR7Response($expectedArray)));

        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\Client::class)
            ->setMethods(['getHttpClient'])
            ->getMock();
        $client->expects($this->any())
            ->method('getHttpClient')
            ->willReturn($httpClient);

        $api = $this->getAbstractApiObject($client);
        $actual = $this->getMethod($api, 'patch')
            ->invokeArgs($api, ['/path', ['param1' => 'param1value'], ['option1' => 'option1value']]);

        $this->assertEquals($expectedArray, $actual);
    }

    /**
     * @test
     */
    public function itShouldPassPUTRequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMethodsMock(['put']);
        $httpClient
            ->expects($this->once())
            ->method('put')
            ->with('/path', new ArraySubset(['option1' => 'option1value']), $this->isInstanceOf(\GuzzleHttp\Psr7\Stream::class))
            ->will($this->returnValue($this->getPSR7Response($expectedArray)));

        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\Client::class)
            ->setMethods(['getHttpClient'])
            ->getMock();
        $client->expects($this->any())
            ->method('getHttpClient')
            ->willReturn($httpClient);

        $api = $this->getAbstractApiObject($client);
        $actual = $this->getMethod($api, 'put')
            ->invokeArgs($api, ['/path', ['param1' => 'param1value'], ['option1' => 'option1value']]);

        $this->assertEquals($expectedArray, $actual);
    }

    /**
     * @test
     */
    public function itShouldPassDELETERequestToClient()
    {
        $expectedArray = ['value'];

        $httpClient = $this->getHttpMethodsMock(['delete']);
        $httpClient
            ->expects($this->once())
            ->method('delete')
            ->with('/path', new ArraySubset(['option1' => 'option1value']), $this->isInstanceOf(\GuzzleHttp\Psr7\Stream::class))
            ->will($this->returnValue($this->getPSR7Response($expectedArray)));

        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\Client::class)
            ->setMethods(['getHttpClient'])
            ->getMock();
        $client->expects($this->any())
            ->method('getHttpClient')
            ->willReturn($httpClient);

        $api = $this->getAbstractApiObject($client);
        $actual = $this->getMethod($api, 'delete')
            ->invokeArgs($api, ['/path', ['param1' => 'param1value'], ['option1' => 'option1value']]);

        $this->assertEquals($expectedArray, $actual);
    }

    /**
     * @param $client
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getAbstractApiObject($client)
    {
        return $this->getMockBuilder($this->getApiClass())
            ->setMethods(null)
            ->setConstructorArgs([$client])
            ->getMock();
    }

    /**
     * @return string
     */
    protected function getApiClass()
    {
        return AbstractApi::class;
    }

    /**
     * @return \Swis\PdokGeodatastoreApi\Client
     */
    protected function getClientMock()
    {
        return new \Swis\PdokGeodatastoreApi\Client($this->getHttpMethodsMock());
    }

    /**
     * Return a HttpMethods client mock
     *
     * @param array $methods
     *
     * @return \Http\Client\Common\HttpMethodsClient
     */
    protected function getHttpMethodsMock(array $methods = [])
    {
        $methods = array_merge(['sendRequest'], $methods);
        $mock = $this->getMockBuilder(\Http\Client\Common\HttpMethodsClient::class)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
        $mock
            ->expects($this->any())
            ->method('sendRequest');

        return $mock;
    }

    /**
     * @return \Http\Client\HttpClient
     */
    protected function getHttpClientMock()
    {
        $mock = $this->getMockBuilder(\Http\Client\HttpClient::class)
            ->setMethods(['sendRequest'])
            ->getMock();
        $mock
            ->expects($this->any())
            ->method('sendRequest');

        return $mock;
    }

    /**
     * @param $expectedArray
     *
     * @return Response
     */
    private function getPSR7Response($expectedArray)
    {
        return new Response(
            200,
            ['Content-Type' => 'application/json'],
            \GuzzleHttp\Psr7\stream_for(json_encode($expectedArray))
        );
    }
}

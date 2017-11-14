<?php

namespace Swis\PdokGeodatastoreApi\Tests\HttpClient\Plugin;

use GuzzleHttp\Psr7\Response;

class GeodatastoreExceptionThrowerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function itShouldNotThrowExceptionForSuccessfulRequest()
    {
        $exceptionThrower = new \Swis\PdokGeodatastoreApi\HttpClient\Plugin\GeodatastoreExceptionThrower();

        $exceptionThrower->handleRequest(
            $this->getRequestMock(),
            function () {
                return $this->getPromiseMock(200);
            },
            function () {
            }
        );
    }

    /**
     * @test
     * @expectedException \Swis\PdokGeodatastoreApi\Exception\ErrorException
     * @expectedExceptionMessage Whoops!
     */
    public function itShouldThrowExceptionFor400StatusCode()
    {
        $exceptionThrower = new \Swis\PdokGeodatastoreApi\HttpClient\Plugin\GeodatastoreExceptionThrower();

        $exceptionThrower->handleRequest(
            $this->getRequestMock(),
            function () {
                return $this->getPromiseMock(400, json_encode(['messages' => ['Whoops!']]));
            },
            function () {
            }
        );
    }

    /**
     * @test
     * @expectedException \Swis\PdokGeodatastoreApi\Exception\RuntimeException
     */
    public function itShouldThrowExceptionForOtherErrorStatusCodes()
    {
        $exceptionThrower = new \Swis\PdokGeodatastoreApi\HttpClient\Plugin\GeodatastoreExceptionThrower();

        $exceptionThrower->handleRequest(
            $this->getRequestMock(),
            function () {
                return $this->getPromiseMock(500);
            },
            function () {
            }
        );
    }

    private function getRequestMock()
    {
        $request = $this->getMockBuilder(\Psr\Http\Message\RequestInterface::class)
            ->setMethodsExcept()
            ->getMock();

        return $request;
    }

    private function getPromiseMock(int $statusCode, string $body = '')
    {
        $response = new Response(
            $statusCode,
            [
                'Content-Type' => 'application/json',
            ],
            \GuzzleHttp\Psr7\stream_for($body)
        );

        $promise = $this->getMockBuilder(\Http\Promise\Promise::class)
            ->setMethodsExcept()
            ->getMock();
        $promise->expects($this->once())
            ->method('then')
            ->willReturnCallback(
                function (callable $callback) use ($response) {
                    $callback($response);
                }
            );

        return $promise;
    }
}

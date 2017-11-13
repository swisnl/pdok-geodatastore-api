<?php

namespace Swis\PdokGeodatastoreApi\Tests\HttpClient\Plugin;

class PathPrependTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function shouldPrependPath()
    {
        $path = '/api/v1';

        $uri = $this->getMockBuilder(\Psr\Http\Message\UriInterface::class)
            ->setMethodsExcept()
            ->getMock();
        $uri->method('getPath')
            ->willReturn('/testpath');
        $uri->method('withPath')
            ->with($path.'/testpath')
            ->willReturn($uri);

        $request = $this->getMockBuilder(\Psr\Http\Message\RequestInterface::class)
            ->setMethodsExcept()
            ->getMock();
        $request->method('getUri')
            ->willReturn($uri);
        $request->expects($this->once())
            ->method('withUri')
            ->with($uri, false);

        $pathPrepend = new \Swis\PdokGeodatastoreApi\HttpClient\Plugin\PathPrepend($path);

        $pathPrepend->handleRequest($request, function() {}, function() {});
    }
}

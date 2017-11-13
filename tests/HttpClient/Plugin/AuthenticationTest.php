<?php

namespace Swis\PdokGeodatastoreApi\Tests\HttpClient\Plugin;

class AuthenticationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function shouldAddAuthorizationHeaders()
    {
        $username = 'username';
        $password = 'password';

        $request = $this->getMockBuilder(\Psr\Http\Message\RequestInterface::class)
            ->setMethodsExcept()
            ->getMock();
        $request->expects($this->once())
            ->method('withHeader')
            ->with('Authorization', sprintf('Basic %s', base64_encode($username.':'.$password)));

        $authentication = new \Swis\PdokGeodatastoreApi\HttpClient\Plugin\Authentication($username, $password);

        $authentication->handleRequest($request, function() {}, function() {});
    }
}

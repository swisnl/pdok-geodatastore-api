<?php

namespace Swis\PdokGeodatastoreApi\Tests\HttpClient\Message;

use GuzzleHttp\Psr7\Response;
use Swis\PdokGeodatastoreApi\HttpClient\Message\ResponseMediator;

class ResponseMediatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function itCanGetContent()
    {
        $body = ['foo' => 'bar'];
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            \GuzzleHttp\Psr7\stream_for(json_encode($body))
        );

        $this->assertEquals($body, ResponseMediator::getContent($response));
    }

    /**
     * If content-type is not json we should get the raw body.
     *
     * @test
     */
    public function itCanGetContentNotJson()
    {
        $body = 'foobar';
        $response = new Response(
            200,
            [],
            \GuzzleHttp\Psr7\stream_for($body)
        );

        $this->assertEquals($body, ResponseMediator::getContent($response));
    }

    /**
     * Make sure we return the body if we have invalid json
     *
     * @test
     */
    public function itCanGetContentInvalidJson()
    {
        $body = 'foobar';
        $response = new Response(
            200,
            ['Content-Type' => 'application/json'],
            \GuzzleHttp\Psr7\stream_for($body)
        );

        $this->assertEquals($body, ResponseMediator::getContent($response));
    }

    /**
     * @test
     */
    public function itCanGetHeader()
    {
        $header = 'application/json';
        $response = new Response(
            200,
            ['Content-Type' => $header]
        );

        $this->assertEquals($header, ResponseMediator::getHeader($response, 'content-type'));
    }
}

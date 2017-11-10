<?php

namespace Swis\PdokGeodatastoreApi\Tests\HttpClient\Message;

use GuzzleHttp\Psr7\Response;
use Swis\PdokGeodatastoreApi\HttpClient\Message\ResponseMediator;

class ResponseMediatorTest extends \PHPUnit\Framework\TestCase
{
    public function testGetContent()
    {
        $body = array('foo' => 'bar');
        $response = new Response(
            200,
            array('Content-Type' => 'application/json'),
            \GuzzleHttp\Psr7\stream_for(json_encode($body))
        );

        $this->assertEquals($body, ResponseMediator::getContent($response));
    }

    /**
     * If content-type is not json we should get the raw body.
     */
    public function testGetContentNotJson()
    {
        $body = 'foobar';
        $response = new Response(
            200,
            array(),
            \GuzzleHttp\Psr7\stream_for($body)
        );

        $this->assertEquals($body, ResponseMediator::getContent($response));
    }

    /**
     * Make sure we return the body if we have invalid json
     */
    public function testGetContentInvalidJson()
    {
        $body = 'foobar';
        $response = new Response(
            200,
            array('Content-Type' => 'application/json'),
            \GuzzleHttp\Psr7\stream_for($body)
        );

        $this->assertEquals($body, ResponseMediator::getContent($response));
    }

    public function testGetHeader()
    {
        $header = 'application/json';
        $response = new Response(
            200,
            array('Content-Type' => $header)
        );

        $this->assertEquals($header, ResponseMediator::getHeader($response, 'content-type'));
    }
}

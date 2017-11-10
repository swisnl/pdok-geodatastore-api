<?php

namespace Swis\PdokGeodatastoreApi\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

/**
 * Add authentication to the request.
 */
class Authentication implements Plugin
{
    private $username;

    private $password;

    public function __construct($username, $password = null)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $request = $request->withHeader(
            'Authorization',
            sprintf('Basic %s', base64_encode($this->username.':'.$this->password))
        );

        return $next($request);
    }
}

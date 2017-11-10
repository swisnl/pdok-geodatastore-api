<?php

namespace Swis\PdokGeodatastoreApi\HttpClient\Plugin;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Swis\PdokGeodatastoreApi\Exception\ErrorException;
use Swis\PdokGeodatastoreApi\Exception\RuntimeException;
use Swis\PdokGeodatastoreApi\HttpClient\Message\ResponseMediator;

class GeodatastoreExceptionThrower implements Plugin
{
    /**
     * {@inheritdoc}
     *
     * @throws \Swis\PdokGeodatastoreApi\Exception\ErrorException
     * @throws \Swis\PdokGeodatastoreApi\Exception\RuntimeException
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        return $next($request)->then(
            function (ResponseInterface $response) {
                if ($response->getStatusCode() < 400 || $response->getStatusCode() > 600) {
                    return $response;
                }

                $content = ResponseMediator::getContent($response);
                if (is_array($content) && isset($content['messages'])) {
                    if (400 === $response->getStatusCode()) {
                        throw new ErrorException($content['messages'][0], 400);
                    }
                }

                throw new RuntimeException(
                    isset($content['messages']) ? $content['messages'][0] : $content,
                    $response->getStatusCode()
                );
            }
        );
    }
}

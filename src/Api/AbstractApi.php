<?php

namespace Swis\PdokGeodatastoreApi\Api;

use Http\Message\MultipartStream\MultipartStreamBuilder;
use Swis\PdokGeodatastoreApi\Client;
use Swis\PdokGeodatastoreApi\HttpClient\Message\ResponseMediator;

/**
 * Abstract class for Api classes.
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * The client.
     *
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send a GET request with query parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     GET parameters.
     * @param array  $requestHeaders Request Headers.
     *
     * @return array|string
     */
    protected function get($path, array $parameters = array(), array $requestHeaders = array())
    {
        if (count($parameters) > 0) {
            $path .= '?'.http_build_query($parameters);
        }

        $response = $this->client->getHttpClient()->get($path, $requestHeaders);

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a HEAD request with query parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     HEAD parameters.
     * @param array  $requestHeaders Request headers.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function head($path, array $parameters = array(), array $requestHeaders = array())
    {
        if (count($parameters) > 0) {
            $path .= '?'.http_build_query($parameters);
        }

        return $this->client->getHttpClient()->head($path, $requestHeaders);
    }

    /**
     * Send a POST request with JSON-encoded parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     POST parameters to be JSON encoded.
     * @param array  $requestHeaders Request headers.
     *
     * @return array|string
     */
    protected function post($path, array $parameters = array(), array $requestHeaders = array())
    {
        $builder = $this->getMultipartStreamBuilder($parameters);

        $response = $this->client->getHttpClient()->post(
            $path,
            array_merge(
                ['Content-Type' => 'multipart/form-data; boundary="'.$builder->getBoundary().'"'],
                $requestHeaders
            ),
            $builder->build()
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PATCH request with JSON-encoded parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     POST parameters to be JSON encoded.
     * @param array  $requestHeaders Request headers.
     *
     * @return array|string
     */
    protected function patch($path, array $parameters = array(), array $requestHeaders = array())
    {
        $builder = $this->getMultipartStreamBuilder($parameters);

        $response = $this->client->getHttpClient()->patch(
            $path,
            array_merge(
                ['Content-Type' => 'multipart/form-data; boundary="'.$builder->getBoundary().'"'],
                $requestHeaders
            ),
            $builder->build()
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a PUT request with JSON-encoded parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     POST parameters to be JSON encoded.
     * @param array  $requestHeaders Request headers.
     *
     * @return array|string
     */
    protected function put($path, array $parameters = array(), array $requestHeaders = array())
    {
        $builder = $this->getMultipartStreamBuilder($parameters);

        $response = $this->client->getHttpClient()->put(
            $path,
            array_merge(
                ['Content-Type' => 'multipart/form-data; boundary="'.$builder->getBoundary().'"'],
                $requestHeaders
            ),
            $builder->build()
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Send a DELETE request with JSON-encoded parameters.
     *
     * @param string $path           Request path.
     * @param array  $parameters     POST parameters to be JSON encoded.
     * @param array  $requestHeaders Request headers.
     *
     * @return array|string
     */
    protected function delete($path, array $parameters = array(), array $requestHeaders = array())
    {
        $builder = $this->getMultipartStreamBuilder($parameters);

        $response = $this->client->getHttpClient()->delete(
            $path,
            array_merge(
                ['Content-Type' => 'multipart/form-data; boundary="'.$builder->getBoundary().'"'],
                $requestHeaders
            ),
            $builder->build()
        );

        return ResponseMediator::getContent($response);
    }

    /**
     * Create a new MultipartStreamBuilder of an array of parameters.
     *
     * @param array $parameters Request parameters
     *
     * @return MultipartStreamBuilder
     */
    protected function getMultipartStreamBuilder(array $parameters)
    {
        $builder = new MultipartStreamBuilder($this->client->getStreamFactory());

        foreach ($parameters as $name => $resource) {
            $builder->addResource($name, $resource);
        }

        return $builder;
    }
}

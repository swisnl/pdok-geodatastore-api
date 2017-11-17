<?php

namespace Swis\PdokGeodatastoreApi;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin;
use Http\Client\HttpClient;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\Authentication\BasicAuth;
use Http\Message\StreamFactory;
use Swis\PdokGeodatastoreApi\Api\ApiInterface;
use Swis\PdokGeodatastoreApi\Exception\BadMethodCallException;
use Swis\PdokGeodatastoreApi\Exception\InvalidArgumentException;
use Swis\PdokGeodatastoreApi\HttpClient\Builder;
use Swis\PdokGeodatastoreApi\HttpClient\Plugin\GeodatastoreExceptionThrower;

/**
 * Simple yet very cool PHP GitHub client.
 *
 * @method Api\Dataset dataset()
 * @method Api\Dataset datasets()
 * @method Api\Registry registry()
 * @method Api\Registry registries()
 *
 * @author Jasper Zonneveld <jasper@swis.nl>
 *
 * Website: https://github.com/swisnl/pdok-geodatastore-api
 */
class Client
{
    /**
     * @var string
     */
    private $apiVersion;

    /**
     * @var Builder
     */
    private $httpClientBuilder;

    /**
     * Instantiate a new client.
     *
     * @param Builder|null $httpClientBuilder
     * @param string|null  $apiVersion
     */
    public function __construct(Builder $httpClientBuilder = null, $apiVersion = null)
    {
        $this->httpClientBuilder = $builder = $httpClientBuilder ?: new Builder();
        $this->apiVersion = $apiVersion ?: 'v1';

        $uri = $this->getUri();
        $builder->addPlugin(new GeodatastoreExceptionThrower());
        $builder->addPlugin(new Plugin\RedirectPlugin());
        $builder->addPlugin(new Plugin\AddHostPlugin($uri));
        $builder->addPlugin(new Plugin\AddPathPlugin($uri));
        $builder->addPlugin(
            new Plugin\HeaderDefaultsPlugin(
                [
                    'User-Agent' => 'pdok-geodatastore-api (https://github.com/swisnl/pdok-geodatastore-api)',
                ]
            )
        );

        $builder->addHeaderValue('Accept', 'application/json');
    }

    /**
     * @return \Psr\Http\Message\UriInterface
     */
    private function getUri()
    {
        return UriFactoryDiscovery::find()->createUri(sprintf('https://geodatastore.pdok.nl/api/%s', $this->getApiVersion()));
    }

    /**
     * Create a Client using a HttpClient.
     *
     * @param HttpClient $httpClient
     *
     * @return Client
     */
    public static function createWithHttpClient(HttpClient $httpClient)
    {
        $builder = new Builder($httpClient);

        return new self($builder);
    }

    /**
     * @param string $name
     *
     * @throws InvalidArgumentException
     *
     * @return ApiInterface
     */
    public function api($name)
    {
        switch ($name) {
            case 'dataset':
            case 'datasets':
                $api = new Api\Dataset($this);
                break;

            case 'registry':
            case 'registries':
                $api = new Api\Registry($this);
                break;

            default:
                throw new InvalidArgumentException(sprintf('Undefined api instance called: "%s"', $name));
        }

        return $api;
    }

    /**
     * Authenticate a user for all next requests.
     *
     * @param string $username NGR private username
     * @param string $password NGR password
     */
    public function authenticate($username, $password)
    {
        $builder = $this->getHttpClientBuilder();
        $builder->removePlugin(Plugin\AuthenticationPlugin::class);
        $builder->addPlugin(new Plugin\AuthenticationPlugin(new BasicAuth($username, $password)));
    }

    /**
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * @param string $name
     *
     * @throws BadMethodCallException
     *
     * @return ApiInterface
     */
    public function __call($name, $args)
    {
        try {
            return $this->api($name);
        } catch (InvalidArgumentException $e) {
            throw new BadMethodCallException(sprintf('Undefined method called: "%s"', $name));
        }
    }

    /**
     * @return HttpMethodsClient
     */
    public function getHttpClient()
    {
        return $this->getHttpClientBuilder()->getHttpClient();
    }

    /**
     * @return StreamFactory
     */
    public function getStreamFactory()
    {
        return $this->getHttpClientBuilder()->getStreamFactory();
    }

    /**
     * @return Builder
     */
    protected function getHttpClientBuilder()
    {
        return $this->httpClientBuilder;
    }
}

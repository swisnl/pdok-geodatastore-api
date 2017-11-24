<?php

namespace Swis\PdokGeodatastoreApi\Api;

/**
 * Listing registries and listing denominators, locations, licenses and topicCategories.
 *
 * @link https://geodatastore.pdok.nl/api/v1/docs
 */
class Registry extends AbstractApi
{
    /**
     * Gets the available registry objects.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#path--api-v1-registries
     *
     * @return array
     */
    public function all()
    {
        return $this->get('/registries');
    }

    /**
     * Gets registry objects.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#path--api-v1-registry--name-
     *
     * @param string $name the name of the registry
     * @param array $params query parameters
     *
     * @return array
     */
    public function show($name, array $params = [])
    {
        return $this->get('/registry/'.rawurlencode($name), $params);
    }

    /**
     * Gets denominator objects.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#path--api-v1-registry--name-
     *
     * @param array $params query parameters
     *
     * @return array
     */
    public function denominators(array $params = [])
    {
        return $this->show('denominator', $params);
    }

    /**
     * Gets license objects.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#path--api-v1-registry--name-
     *
     * @param array $params query parameters
     *
     * @return array
     */
    public function licenses(array $params = [])
    {
        return $this->show('license', $params);
    }

    /**
     * Gets location objects.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#path--api-v1-registry-location
     *
     * @param array $params query parameters to filter locations by (see link)
     *
     * @return array
     */
    public function locations(array $params = [])
    {
        return $this->show('location', $params);
    }

    /**
     * Gets topicCategory objects.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#path--api-v1-registry--name-
     *
     * @param array $params query parameters
     *
     * @return array
     */
    public function topicCategories(array $params = [])
    {
        return $this->show('topicCategory', $params);
    }
}

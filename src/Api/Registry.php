<?php

namespace Swis\PdokGeodatastoreApi\Api;

/**
 * Listing registries, listing locations and listing keywords.
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
     * Gets location objects.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#path--api-v1-registry-location
     *
     * @param array $params query parameters to filter locations by (see link)
     *
     * @return array
     */
    public function locations(array $params = array())
    {
        return $this->get('/registry/location', $params);
    }

    /**
     * Gets keyword objects.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#path--api-v1-registry--name-
     *
     * @param string $name the name of the registry
     *
     * @return array
     */
    public function keywords($name)
    {
        return $this->get('/registry/'.rawurlencode($name));
    }
}

<?php

namespace Swis\PdokGeodatastoreApi\Api;

/**
 * Listing, creating, updating and destroying datasets.
 *
 * @link https://geodatastore.pdok.nl/api/v1/docs
 */
class Dataset extends AbstractApi
{
    /**
     * Gets dataset objects of the user organization.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#operation--api-v1-datasets-get
     *
     * @param array $params query parameters to filter datasets by (see link)
     *
     * @return array
     */
    public function all(array $params = [])
    {
        return $this->get('/datasets', $params);
    }

    /**
     * Create a new dataset.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#path--api-v1-dataset
     *
     * @param array $params the new dataset data
     *
     * @return array
     */
    public function create(array $params)
    {
        return $this->post('/dataset', $params);
    }

    /**
     * Update an existing dataset.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#operation--api-v1-dataset--id--post
     *
     * @param string $id     the dataset id
     * @param array  $params the new dataset data
     *
     * @return array
     */
    public function update($id, array $params)
    {
        return $this->post('/dataset/'.rawurlencode($id), $params);
    }

    /**
     * Delete a dataset. The metadata, dataset and thumbnail are removed from the system.
     *
     * @link https://geodatastore.pdok.nl/api/v1/docs#operation--api-v1-dataset--id--delete
     *
     * @param string $id the dataset id
     *
     * @return array
     */
    public function destroy($id)
    {
        return $this->delete('/dataset/'.rawurlencode($id));
    }
}

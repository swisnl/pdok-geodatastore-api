<?php

namespace Swis\PdokGeodatastoreApi\Tests\Api;

class DatasetTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldGetAllDatasets()
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('get')
            ->with('/datasets');

        $api->all();
    }

    /**
     * @test
     */
    public function itShouldGetAllDatasetsWithFilterParameters()
    {
        $api = $this->getApiMock();
        $filterData = ['foo' => 'bar', 'bar' => 'foo'];

        $api->expects($this->once())
            ->method('get')
            ->with('/datasets', $filterData);

        $api->all($filterData);
    }

    /**
     * @test
     */
    public function itShouldCreateDataset()
    {
        $api = $this->getApiMock();
        $datasetData = ['metadata' => 'rl76tg5q9mff7l04bk19kxjj5q1w8eblm58dusd7'];

        $api->expects($this->once())
            ->method('post')
            ->with('/dataset', $datasetData);

        $api->create($datasetData);
    }

    /**
     * @test
     */
    public function itShouldUpdateDataset()
    {
        $api = $this->getApiMock();
        $datasetData = ['metadata' => 'rl76tg5q9mff7l04bk19kxjj5q1w8eblm58dusd7'];

        $api->expects($this->once())
            ->method('post')
            ->with('/dataset/1', $datasetData);

        $api->update(1, $datasetData);
    }

    /**
     * @test
     */
    public function itShouldDestroyDataset()
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('delete')
            ->with('/dataset/1');

        $api->destroy(1);
    }

    /**
     * @return string
     */
    protected function getApiClass()
    {
        return \Swis\PdokGeodatastoreApi\Api\Dataset::class;
    }
}

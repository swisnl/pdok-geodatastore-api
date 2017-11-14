<?php

namespace Swis\PdokGeodatastoreApi\Tests\Api;

class RegistryTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldGetAllRegistries()
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('get')
            ->with('/registries');

        $api->all();
    }

    /**
     * @test
     */
    public function itShouldGetAllLocations()
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/location');

        $api->locations();
    }

    /**
     * @test
     */
    public function itShouldGetAllLocationsWithFilterParameters()
    {
        $api = $this->getApiMock();
        $filterData = ['foo' => 'bar', 'bar' => 'foo'];

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/location', $filterData);

        $api->locations($filterData);
    }

    /**
     * @test
     */
    public function itShouldGetAllKeywords()
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/foo-bar');

        $api->keywords('foo-bar');
    }

    /**
     * @return string
     */
    protected function getApiClass()
    {
        return \Swis\PdokGeodatastoreApi\Api\Registry::class;
    }
}

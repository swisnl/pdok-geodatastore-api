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
    public function itShouldGetAllRegistriesByType()
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/foo-bar');

        $api->show('foo-bar');
    }

    /**
     * @test
     */
    public function itShouldGetAllRegistriesByTypeWithFilterParameters()
    {
        $api = $this->getApiMock();
        $filterData = ['foo' => 'bar', 'bar' => 'foo'];

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/foo-bar', $filterData);

        $api->show('foo-bar', $filterData);
    }

    /**
     * @test
     */
    public function itShouldGetAllDenominators()
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/denominator');

        $api->denominators();
    }

    /**
     * @test
     */
    public function itShouldGetAllDenominatorsWithFilterParameters()
    {
        $api = $this->getApiMock();
        $filterData = ['foo' => 'bar', 'bar' => 'foo'];

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/denominator', $filterData);

        $api->denominators($filterData);
    }

    /**
     * @test
     */
    public function itShouldGetAllLicenses()
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/license');

        $api->licenses();
    }

    /**
     * @test
     */
    public function itShouldGetAllLicensesWithFilterParameters()
    {
        $api = $this->getApiMock();
        $filterData = ['foo' => 'bar', 'bar' => 'foo'];

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/license', $filterData);

        $api->licenses($filterData);
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
    public function itShouldGetAllTopicCategories()
    {
        $api = $this->getApiMock();

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/topicCategory');

        $api->topicCategories();
    }

    /**
     * @test
     */
    public function itShouldGetAllTopicCategoriesWithFilterParameters()
    {
        $api = $this->getApiMock();
        $filterData = ['foo' => 'bar', 'bar' => 'foo'];

        $api->expects($this->once())
            ->method('get')
            ->with('/registry/topicCategory', $filterData);

        $api->topicCategories($filterData);
    }

    /**
     * @return string
     */
    protected function getApiClass()
    {
        return \Swis\PdokGeodatastoreApi\Api\Registry::class;
    }
}

<?php

namespace Swis\PdokGeodatastoreApi\Tests\HttpClient;

use Http\Client\Common\Plugin;

class BuilderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function itShouldClearHeaders()
    {
        $builder = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\HttpClient\Builder::class)
            ->setMethods(['addPlugin', 'removePlugin'])
            ->getMock();
        $builder->expects($this->once())
            ->method('addPlugin')
            ->with($this->isInstanceOf(Plugin\HeaderAppendPlugin::class));

        $builder->expects($this->once())
            ->method('removePlugin')
            ->with(Plugin\HeaderAppendPlugin::class);

        $builder->clearHeaders();
    }

    /**
     * @test
     */
    public function itShouldAddHeaders()
    {
        $headers = ['header1', 'header2'];

        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\HttpClient\Builder::class)
            ->setMethods(['addPlugin', 'removePlugin'])
            ->getMock();
        $client->expects($this->once())
            ->method('addPlugin')
            // TODO verify that headers exists
            ->with($this->isInstanceOf(Plugin\HeaderAppendPlugin::class));

        $client->expects($this->once())
            ->method('removePlugin')
            ->with(Plugin\HeaderAppendPlugin::class);

        $client->addHeaders($headers);
    }

    /**
     * @test
     */
    public function itShouldAddAndRemovePluginWhenAppendingHeader()
    {
        $expectedHeaders = [
            'X-Test-Header' => 'application/json',
        ];

        $client = $this->getMockBuilder(\Swis\PdokGeodatastoreApi\HttpClient\Builder::class)
            ->setMethods(['removePlugin', 'addPlugin'])
            ->getMock();

        $client->expects($this->once())
            ->method('removePlugin')
            ->with(Plugin\HeaderAppendPlugin::class);

        $client->expects($this->once())
            ->method('addPlugin')
            ->with(new Plugin\HeaderAppendPlugin($expectedHeaders));

        $client->addHeaderValue('X-Test-Header', 'application/json');
    }
}

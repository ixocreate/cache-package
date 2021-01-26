<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\CacheItemPool;
use Ixocreate\Cache\Option\Chain;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

class ChainTest extends TestCase
{
    /**
     * @var Chain
     */
    private $chain;

    public function setUp(): void
    {
        $this->chain = new Chain([
            'foo',
            'bar',
        ]);
    }

    public function testCreate()
    {
        $name = 'foo';

        $this->assertInstanceOf(CacheItemPoolInterface::class, $this->chain->create($name, $this->serviceManagerMock()));
    }

    public function testSerialize()
    {
        $serialize = \serialize([
            'caches' => [
                'foo',
                'bar',
            ],
        ]);

        $this->assertSame($serialize, $this->chain->serialize());
    }

    public function testUnserialize()
    {
        $serialize = \serialize([
                'foo',
                'bar',
        ]);

        $chainSerialize = $this->chain->serialize();

        $this->chain->unserialize($chainSerialize);

        $reflection = new \ReflectionClass($this->chain);
        $property = $reflection->getProperty('caches');
        $property->setAccessible(true);

        $this->assertSame(\unserialize($serialize), $property->getValue($this->chain));
    }

    private function serviceManagerMock()
    {
        $cacheItemPoolSubManager = $this->createMock(SubManagerInterface::class);
        $cacheItemPoolSubManager->method('get')->willReturnCallback(function ($request) {
            $pool = [
                'foo' => $this->createMock(CacheItemPoolInterface::class),
                'bar' => new CacheItemPool($this->createMock(CacheItemPoolInterface::class)),
            ];
            return $pool[$request];
        });

        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);
        $serviceManagerMock->method('get')->willReturnCallback(function ($request) use ($cacheItemPoolSubManager) {
            return $cacheItemPoolSubManager;
        });

        return $serviceManagerMock;
    }
}

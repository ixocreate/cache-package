<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache\Factory;

use Ixocreate\Cache\Config;
use Ixocreate\Cache\Factory\CacheItemPoolFactory;
use Ixocreate\Cache\OptionInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

class CacheItemPoolFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $cacheItemPoolFactory = new CacheItemPoolFactory();
        $cacheItemPool = $cacheItemPoolFactory($this->serviceManagerMock(), 'foo');
        $this->assertInstanceOf(CacheItemPoolInterface::class, $cacheItemPool);
    }

    private function serviceManagerMock()
    {
        $optionInterface = $this->createMock(OptionInterface::class);
        $optionInterface->method('create')->willReturnCallback(function ($requestedName, $container) {
            $cacheItemPool = $this->createMock(CacheItemPoolInterface::class);
            return $cacheItemPool;
        });
        $config = new Config(['foo' => $optionInterface]);

        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);
        $serviceManagerMock->method('get')->willReturnCallback(function ($request) use ($config) {
            return $config;
        });
        return $serviceManagerMock;
    }
}

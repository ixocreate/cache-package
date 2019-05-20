<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\Cache;
use Ixocreate\Cache\Factory\CacheFactory;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

class CacheFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $cacheFactory = new CacheFactory();
        $cache = $cacheFactory($this->serviceManagerMock(), 'foo');

        $this->assertInstanceOf(Cache::class, $cache);
    }

    private function serviceManagerMock()
    {
        $cacheItemPoolSubManager = $this->createMock(SubManagerInterface::class);
        $cacheItemPoolSubManager->method('get')->willReturnCallback(function ($request) {
            return $this->createMock(CacheItemPoolInterface::class);
        });

        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);
        $serviceManagerMock->method('get')->willReturnCallback(function ($request) use ($cacheItemPoolSubManager) {
            return $cacheItemPoolSubManager;
        });

        return $serviceManagerMock;
    }
}

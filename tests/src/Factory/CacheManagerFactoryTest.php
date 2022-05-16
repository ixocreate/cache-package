<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache\Factory;

use Ixocreate\Cache\CacheManager;
use Ixocreate\Cache\Factory\CacheManagerFactory;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class CacheManagerFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $cacheManagerFactory = new CacheManagerFactory();
        $cacheManager = $cacheManagerFactory($this->serviceManagerMock(), 'foo');

        $this->assertInstanceOf(CacheManager::class, $cacheManager);
    }

    private function serviceManagerMock()
    {
        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);
        $serviceManagerMock->method('get')->willReturnCallback(function ($request) {
            return $this->createMock(ContainerInterface::class);
        });
        return $serviceManagerMock;
    }
}

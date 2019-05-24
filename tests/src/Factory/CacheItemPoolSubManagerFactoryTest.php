<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\CacheItemPoolSubManager;
use Ixocreate\Cache\Config;
use Ixocreate\Cache\Factory\CacheItemPoolSubManagerFactory;
use Ixocreate\Cache\OptionInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class CacheItemPoolSubManagerFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $cacheItemPoolSubManagerFactory = new CacheItemPoolSubManagerFactory();
        $cacheItemPoolSubManager = $cacheItemPoolSubManagerFactory($this->serviceManagerMock(), 'foo');

        $this->assertInstanceOf(CacheItemPoolSubManager::class, $cacheItemPoolSubManager);
    }

    private function serviceManagerMock()
    {
        $optionInterface = $this->createMock(OptionInterface::class);

        $config = new Config(['foo' => $optionInterface]);

        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);
        $serviceManagerMock->method('get')->willReturnCallback(function ($request) use ($config) {
            return $config;
        });
        return $serviceManagerMock;
    }
}

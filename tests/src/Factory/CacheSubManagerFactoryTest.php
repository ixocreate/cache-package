<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\CacheSubManager;
use Ixocreate\Cache\Config;
use Ixocreate\Cache\Factory\CacheSubManagerFactory;
use Ixocreate\Cache\OptionInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;

class CacheSubManagerFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $cacheSubManagerFactory = new CacheSubManagerFactory();
        $cacheSubManager = $cacheSubManagerFactory($this->serviceManagerMock(), 'foo');

        $this->assertInstanceOf(CacheSubManager::class, $cacheSubManager);
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

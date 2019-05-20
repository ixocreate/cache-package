<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Application\Service\ServiceRegistryInterface;
use Ixocreate\Cache\CacheConfigurator;
use Ixocreate\Cache\Config;
use Ixocreate\Cache\OptionInterface;
use PHPUnit\Framework\TestCase;

class CacheConfiguratorTest extends TestCase
{
    /**
     * @var CacheConfigurator
     */
    private $cacheConfigurator;

    public function setUp()
    {
        $this->cacheConfigurator = new CacheConfigurator();
    }

    public function testAddCacheableDirectory()
    {
        $directory = 'foo';

        $recursive = true;

        $this->assertNull($this->cacheConfigurator->addCacheableDirectory($directory, $recursive));
    }

    public function testAddCacheable()
    {
        $cacheable = 'foo';

        $this->assertNull($this->cacheConfigurator->addCacheable($cacheable));
    }

    public function testAddCache()
    {
        $name = 'foo';

        $option = $this->createMock(OptionInterface::class);

        $this->assertNull($this->cacheConfigurator->addCache($name, $option));
    }

    public function testRegisterService()
    {
        $collector = [];
        $serviceRegistry = $this->createMock(ServiceRegistryInterface::class);
        $serviceRegistry->method('add')->willReturnCallback(function ($name, $object) use (&$collector) {
            $collector[$name] = $object;
        });

        $this->cacheConfigurator->registerService($serviceRegistry);

        $this->assertArrayHasKey(Config::class, $collector);
        $this->assertInstanceOf(Config::class, $collector[Config::class]);
    }
}

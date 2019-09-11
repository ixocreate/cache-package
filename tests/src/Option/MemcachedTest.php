<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\Option\Memcached;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

class MemcachedTest extends TestCase
{
    /**
     * @var Memcached
     */
    private $memcached;

    public function setUp()
    {
        if (!extension_loaded('memcached')) {
            $this->markTestSkipped('The memcached extension is not available.');
        }

        $this->memcached = new Memcached();
    }

    public function testCreate()
    {
        $name = 'foo';

        $this->assertInstanceOf(CacheItemPoolInterface::class, $this->memcached->create($name, $this->serviceManagerMock()));
    }

    public function testSerialize()
    {
        $serialize = \serialize([]);

        $this->assertSame($serialize, $this->memcached->serialize());
    }

    public function testUnserialize()
    {
        $serialize = \serialize([]);

        $this->assertNull($this->memcached->unserialize($serialize));
    }

    private function serviceManagerMock()
    {
        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);

        return $serviceManagerMock;
    }
}

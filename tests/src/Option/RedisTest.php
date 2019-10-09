<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\Option\Redis;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

class RedisTest extends TestCase
{
    public function setUp()
    {
        if (!\extension_loaded('redis')) {
            $this->markTestSkipped('The redis extension is not available.');
        }
    }

    public function testCreate()
    {
        $redis = new Redis('127.0.0.1');

        $this->assertInstanceOf(CacheItemPoolInterface::class, $redis->create('foo', $this->serviceManagerMock()));
    }

    public function testSerialize()
    {
        $redis = new Redis('127.0.0.1', '1234', 'secret', '5');

        $serialized = \serialize($redis);
        $cache = \unserialize($serialized);

        $this->assertEquals($redis, $cache);
    }

    private function serviceManagerMock()
    {
        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);

        return $serviceManagerMock;
    }
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\Option\InMemory;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

class InMemoryTest extends TestCase
{
    /**
     * @var InMemory
     */
    private $inMemory;

    public function setUp()
    {
        $this->inMemory = new InMemory();
    }

    public function testCreate()
    {
        $name = 'foo';

        $this->assertInstanceOf(CacheItemPoolInterface::class, $this->inMemory->create($name, $this->serviceManagerMock()));
    }

    public function testSerialize()
    {
        $serialize = \serialize([]);

        $this->assertSame($serialize, $this->inMemory->serialize());
    }

    public function testUnserialize()
    {
        $serialize = \serialize([]);

        $this->assertNull($this->inMemory->unserialize($serialize));
    }

    private function serviceManagerMock()
    {
        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);

        return $serviceManagerMock;
    }
}

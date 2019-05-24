<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\CacheBootstrapItem;
use Ixocreate\Cache\CacheConfigurator;
use PHPUnit\Framework\TestCase;

class CacheBootstrapItemTest extends TestCase
{
    /**
     * @var CacheBootstrapItem
     */
    private $cacheBootstrapItem;

    public function setUp()
    {
        $this->cacheBootstrapItem = new CacheBootstrapItem();
    }

    public function testConfigurator()
    {
        $this->assertInstanceOf(CacheConfigurator::class, $this->cacheBootstrapItem->getConfigurator());
    }

    public function testGetVariableName()
    {
        $this->assertSame('cache', $this->cacheBootstrapItem->getVariableName());
    }

    public function testGetFileName()
    {
        $this->assertSame('cache.php', $this->cacheBootstrapItem->getFileName());
    }
}

<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\CacheBootstrapItem;
use Ixocreate\Cache\Package;
use PHPUnit\Framework\TestCase;

class PackageTest extends TestCase
{
    /**
     * @covers \Ixocreate\Cache\Package
     */
    public function testPackage()
    {
        $package = new Package();

        $this->assertSame([
            CacheBootstrapItem::class,
        ], $package->getBootstrapItems());

        $this->assertDirectoryExists($package->getBootstrapDirectory());
        $this->assertEmpty($package->getDependencies());
    }
}

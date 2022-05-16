<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache\Option;

use Ixocreate\Cache\Option\Filesystem;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

class FilesystemTest extends TestCase
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function setUp(): void
    {
        $this->filesystem = new Filesystem('foo', 100);
    }

    public function testSetUpWithoutParameters()
    {
        $filesystem = new Filesystem();

        $this->assertInstanceOf(Filesystem::class, $filesystem);
        $this->assertDirectoryExists($filesystem->directory());
        $this->assertSame(0, $filesystem->defaultLifetime());
    }

    public function testDirectory()
    {
        $this->assertSame('foo', $this->filesystem->directory());
    }

    public function testDefaultLifetime()
    {
        $this->assertSame(100, $this->filesystem->defaultLifetime());
    }

    public function testCreate()
    {
        $name = 'bar';

        $this->assertInstanceOf(CacheItemPoolInterface::class, $this->filesystem->create($name, $this->serviceManagerMock()));
    }

    public function testSerialize()
    {
        $serialize = \serialize([
            'defaultLifetime' => 100,
            'directory' => 'foo',
        ]);

        $this->assertSame($serialize, $this->filesystem->serialize());
    }

    public function testUnserialize()
    {
        $serialize = \serialize([
            'defaultLifetime' => 100,
            'directory' => 'foo',
        ]);

        $filesystemSerialize = $this->filesystem->serialize();

        $this->filesystem->unserialize($filesystemSerialize);

        $result = [
            'defaultLifetime' => $this->filesystem->defaultLifetime(),
            'directory' => $this->filesystem->directory(),
        ];

        $this->assertSame(\unserialize($serialize), $result);
    }

    private function serviceManagerMock()
    {
        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);

        return $serviceManagerMock;
    }
}

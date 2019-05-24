<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\Option\Database;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

class DatabaseTest extends TestCase
{
    /**
     * @var Database
     */
    private $database;

    public function setUp()
    {
        $this->database = new Database('foo', 100);
    }

    public function testConnection()
    {
        $this->assertSame('foo', $this->database->connection());
    }

    public function testDefaultLifetime()
    {
        $this->assertSame(100, $this->database->defaultLifetime());
    }

    public function testCreate()
    {
        $name = 'bar';

        $this->assertInstanceOf(CacheItemPoolInterface::class, $this->database->create($name, $this->serviceManagerMock()));
    }

    public function testSerialize()
    {
        $serialize = \serialize([
            'defaultLifetime' => 100,
            'connection' => 'foo',
        ]);

        $this->assertSame($serialize, $this->database->serialize());
    }

    public function testUnserialize()
    {
        $serialize = \serialize([
            'defaultLifetime' => 100,
            'connection' => 'foo',
        ]);

        $databaseSerialize = $this->database->serialize();

        $this->database->unserialize($databaseSerialize);

        $result = [
            'defaultLifetime' => $this->database->defaultLifetime(),
            'connection' => $this->database->connection(),
        ];

        $this->assertSame(\unserialize($serialize), $result);
    }

    private function serviceManagerMock()
    {
        $connectionSubManager = $this->createMock(SubManagerInterface::class);
        $connectionSubManager->method('get')->willReturnCallback(function ($request) {
            return 'foo';
        });

        $serviceManagerMock = $this->createMock(ServiceManagerInterface::class);
        $serviceManagerMock->method('get')->willReturnCallback(function ($request) use ($connectionSubManager) {
            return $connectionSubManager;
        });
        return $serviceManagerMock;
    }
}

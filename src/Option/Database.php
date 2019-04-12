<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Cache\Option;

use Ixocreate\Cache\CacheItemPool;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Ixocreate\Database\Connection\Factory\ConnectionSubManager;
use Ixocreate\Package\Cache\OptionInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\PdoAdapter;

final class Database implements OptionInterface
{
    /**
     * @var string
     */
    private $connection;

    /**
     * @var int
     */
    private $defaultLifetime;

    /**
     * Filesystem constructor.
     * @param string $connection
     * @param int|null $defaultLifetime
     */
    public function __construct(string $connection, ?int $defaultLifetime = null)
    {
        $this->connection = $connection;

        $this->defaultLifetime = $defaultLifetime;
    }

    /**
     * @return string
     */
    public function connection(): string
    {
        return $this->connection;
    }

    /**
     * @return int
     */
    public function defaultLifetime(): ?int
    {
        return $this->defaultLifetime;
    }

    /**
     * @param string $name
     * @param ServiceManagerInterface $serviceManager
     * @return CacheItemPoolInterface
     */
    public function create(string $name, ServiceManagerInterface $serviceManager): CacheItemPoolInterface
    {
        return new CacheItemPool(
            new PdoAdapter(
                $serviceManager->get(ConnectionSubManager::class)->get($this->connection()),
                $name,
                $this->defaultLifetime(),
                [
                    'db_table' => 'cache_item',
                    'db_id_col' => 'id',
                    'db_data_col' => 'item',
                    'db_lifetime_col' => 'lifetime',
                    'db_time_col' => 'createdAt',
                ]
            )
        );
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([
            'defaultLifetime' => $this->defaultLifetime,
            'connection' => $this->connection,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $unserialized = unserialize($serialized);
        $this->defaultLifetime = $unserialized['defaultLifetime'];
        $this->connection = $unserialized['connection'];
    }
}

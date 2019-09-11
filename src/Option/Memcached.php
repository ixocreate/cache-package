<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Option;

use Ixocreate\Cache\CacheItemPool;
use Ixocreate\Cache\OptionInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\MemcachedAdapter;

final class Memcached implements OptionInterface
{
    private $dsns = [];

    public function addDsn(string $dsn, string $name = 'default'): void
    {
        $this->dsns[$name] = $dsn;
    }

    /**
     * @return string|void
     */
    public function serialize()
    {
        return \serialize($this->dsns);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->dsns = \unserialize($serialized);
    }

    /**
     * @param string $name
     * @param ServiceManagerInterface $serviceManager
     * @throws \ErrorException
     * @return CacheItemPoolInterface
     */
    public function create(string $name, ServiceManagerInterface $serviceManager): CacheItemPoolInterface
    {
        return new CacheItemPool(
            new MemcachedAdapter(
                MemcachedAdapter::createConnection(\array_values($this->dsns)),
                $name
            )
        );
    }
}

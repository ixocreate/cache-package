<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Option;

use Ixocreate\Cache\CacheItemPool;
use Ixocreate\Cache\OptionInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

final class InMemory implements OptionInterface
{
    /**
     * @param string $name
     * @param ServiceManagerInterface $serviceManager
     * @return CacheItemPoolInterface
     */
    public function create(string $name, ServiceManagerInterface $serviceManager): CacheItemPoolInterface
    {
        return new CacheItemPool(
            new ArrayAdapter(0, false)
        );
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return \serialize([]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
    }
}

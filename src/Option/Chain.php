<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Option;

use Ixocreate\Cache\CacheItemPool;
use Ixocreate\Cache\CacheItemPoolSubManager;
use Ixocreate\Cache\OptionInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\ChainAdapter;

final class Chain implements OptionInterface
{
    /**
     * @var array
     */
    private $caches;

    /**
     * InMemory constructor.
     * @param array $caches
     */
    public function __construct(array $caches)
    {
        $this->caches = $caches;
    }

    /**
     * @param string $name
     * @param ServiceManagerInterface $serviceManager
     * @return CacheItemPoolInterface
     */
    public function create(string $name, ServiceManagerInterface $serviceManager): CacheItemPoolInterface
    {
        $pool = [];
        foreach ($this->caches as $cache) {
            $cacheItemPool = $serviceManager->get(CacheItemPoolSubManager::class)->get($cache);
            if ($cacheItemPool instanceof CacheItemPool) {
                $pool[] = $cacheItemPool->innerPool();
                continue;
            }
            $pool[] = $cacheItemPool;
        }

        return new CacheItemPool(
            new ChainAdapter($pool)
        );
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return \serialize([
            'caches' => $this->caches,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $unserialized = \unserialize($serialized);
        $this->caches = $unserialized['caches'];
    }
}

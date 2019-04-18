<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Factory;

use Ixocreate\Cache\CacheManager;
use Ixocreate\ServiceManager\FactoryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Cache\CacheItemPoolSubManager;

final class CacheManagerFactory implements FactoryInterface
{
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        return new CacheManager(
            $container->get(CacheItemPoolSubManager::class)
        );
    }
}

<?php
declare(strict_types=1);
namespace Ixocreate\Package\Cache\Factory;

use Ixocreate\Cache\CacheManager;
use Ixocreate\Contract\ServiceManager\FactoryInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Ixocreate\Package\Cache\CacheItemPoolSubManager;

final class CacheManagerFactory implements FactoryInterface
{
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        return new CacheManager(
            $container->get(CacheItemPoolSubManager::class)
        );
    }
}

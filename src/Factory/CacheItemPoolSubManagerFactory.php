<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Package\Factory;

use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerFactoryInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;
use Ixocreate\Cache\Package\CacheItemPoolSubManager;
use Ixocreate\Cache\Package\Config;
use Ixocreate\ServiceManager\SubManager\SubManagerConfigurator;
use Psr\Cache\CacheItemPoolInterface;

final class CacheItemPoolSubManagerFactory implements SubManagerFactoryInterface
{
    /**
     * @param ServiceManagerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @return SubManagerInterface
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null): SubManagerInterface
    {
        $serviceManagerConfigurator = new SubManagerConfigurator(
            CacheItemPoolSubManager::class,
            CacheItemPoolInterface::class
        );

        /** @var Config $config */
        $config = $container->get(Config::class);
        foreach (array_keys($config->pools()) as $pool) {
            $serviceManagerConfigurator->addService($pool, CacheItemPoolFactory::class);
        }

        return new CacheItemPoolSubManager(
            $container,
            $serviceManagerConfigurator->getServiceManagerConfig(),
            CacheItemPoolInterface::class
        );
    }
}

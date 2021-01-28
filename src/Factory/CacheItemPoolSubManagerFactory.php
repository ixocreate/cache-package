<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Factory;

use Ixocreate\Application\ServiceManager\SubManagerConfigurator;
use Ixocreate\Cache\CacheItemPoolSubManager;
use Ixocreate\Cache\Config;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerFactoryInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;
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
        foreach (\array_keys($config->pools()) as $pool) {
            $serviceManagerConfigurator->addService($pool, CacheItemPoolFactory::class);
        }

        return new CacheItemPoolSubManager(
            $container,
            $serviceManagerConfigurator->getServiceManagerConfig()
        );
    }
}

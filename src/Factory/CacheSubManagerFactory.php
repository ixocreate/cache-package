<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Factory;

use Ixocreate\Application\ServiceManager\SubManagerConfigurator;
use Ixocreate\Cache\CacheInterface;
use Ixocreate\Cache\CacheSubManager;
use Ixocreate\Cache\Config;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerFactoryInterface;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;

final class CacheSubManagerFactory implements SubManagerFactoryInterface
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
            CacheSubManager::class,
            CacheInterface::class
        );

        /** @var Config $config */
        $config = $container->get(Config::class);
        foreach (\array_keys($config->pools()) as $pool) {
            $serviceManagerConfigurator->addService($pool, CacheFactory::class);
        }

        return new CacheSubManager(
            $container,
            $serviceManagerConfigurator->getServiceManagerConfig()
        );
    }
}

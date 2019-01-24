<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Cache;

use Ixocreate\Contract\Application\ConfiguratorInterface;
use Ixocreate\Contract\Application\ServiceRegistryInterface;
use Ixocreate\Contract\Cache\CacheableInterface;
use Ixocreate\ServiceManager\Factory\AutowireFactory;
use Ixocreate\ServiceManager\SubManager\SubManagerConfigurator;

final class CacheableConfigurator implements ConfiguratorInterface
{
    /**
     * @var SubManagerConfigurator
     */
    private $subManagerConfigurator;

    /**
     * MiddlewareConfigurator constructor.
     */
    public function __construct()
    {
        $this->subManagerConfigurator = new SubManagerConfigurator(CacheableSubManager::class, CacheableInterface::class);
    }

    /**
     * @param string $directory
     * @param bool $recursive
     */
    public function addDirectory(string $directory, bool $recursive = true): void
    {
        $this->subManagerConfigurator->addDirectory($directory, $recursive);
    }

    /**
     * @param string $action
     * @param string $factory
     */
    public function addCacheable(string $cacheable, string $factory = AutowireFactory::class): void
    {
        $this->subManagerConfigurator->addFactory($cacheable, $factory);
    }

    /**
     * @param ServiceRegistryInterface $serviceRegistry
     * @return void
     */
    public function registerService(ServiceRegistryInterface $serviceRegistry): void
    {
        $this->subManagerConfigurator->registerService($serviceRegistry);
    }
}

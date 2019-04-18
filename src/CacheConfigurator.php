<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache;

use Ixocreate\Application\Service\Configurator\ConfiguratorInterface;
use Ixocreate\Application\Service\Registry\ServiceRegistryInterface;
use Ixocreate\Cache\CacheableInterface;
use Ixocreate\ServiceManager\Factory\AutowireFactory;
use Ixocreate\Application\Service\SubManagerConfigurator;

final class CacheConfigurator implements ConfiguratorInterface
{
    /**
     * @var SubManagerConfigurator
     */
    private $cacheablesubManagerConfigurator;

    private $pools = [];

    /**
     * MiddlewareConfigurator constructor.
     */
    public function __construct()
    {
        $this->cacheablesubManagerConfigurator = new SubManagerConfigurator(CacheableSubManager::class, CacheableInterface::class);
    }

    /**
     * @param string $directory
     * @param bool $recursive
     */
    public function addCacheableDirectory(string $directory, bool $recursive = true): void
    {
        $this->cacheablesubManagerConfigurator->addDirectory($directory, $recursive);
    }

    /**
     * @param string $action
     * @param string $factory
     */
    public function addCacheable(string $cacheable, string $factory = AutowireFactory::class): void
    {
        $this->cacheablesubManagerConfigurator->addFactory($cacheable, $factory);
    }

    /**
     * @param string $name
     * @param OptionInterface $option
     */
    public function addCache(string $name, OptionInterface $option): void
    {
        $this->pools[$name] = $option;
    }

    /**
     * @param ServiceRegistryInterface $serviceRegistry
     * @return void
     */
    public function registerService(ServiceRegistryInterface $serviceRegistry): void
    {
        $this->cacheablesubManagerConfigurator->registerService($serviceRegistry);

        $serviceRegistry->add(Config::class, new Config($this->pools));
    }
}

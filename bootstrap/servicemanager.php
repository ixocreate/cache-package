<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache;

use Ixocreate\Application\ServiceManager\ServiceManagerConfigurator;
use Ixocreate\Cache\Factory\CacheItemPoolSubManagerFactory;
use Ixocreate\Cache\Factory\CacheManagerFactory;
use Ixocreate\Cache\Factory\CacheSubManagerFactory;

/** @var ServiceManagerConfigurator $serviceManager */
$serviceManager->addService(CacheManager::class, CacheManagerFactory::class);
$serviceManager->addSubManager(CacheItemPoolSubManager::class, CacheItemPoolSubManagerFactory::class);
$serviceManager->addSubManager(CacheSubManager::class, CacheSubManagerFactory::class);
$serviceManager->addSubManager(CacheableSubManager::class);

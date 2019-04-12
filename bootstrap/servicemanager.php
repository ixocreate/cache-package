<?php
declare(strict_types=1);
namespace Ixocreate\Package\Cache;

use Ixocreate\Cache\CacheManager;
use Ixocreate\Package\Cache\Factory\CacheItemPoolSubManagerFactory;
use Ixocreate\Package\Cache\Factory\CacheManagerFactory;
use Ixocreate\Package\Cache\Factory\CacheSubManagerFactory;

/** @var \Ixocreate\ServiceManager\ServiceManagerConfigurator $serviceManager */
$serviceManager->addService(CacheManager::class, CacheManagerFactory::class);
$serviceManager->addSubManager(CacheItemPoolSubManager::class, CacheItemPoolSubManagerFactory::class);
$serviceManager->addSubManager(CacheSubManager::class, CacheSubManagerFactory::class);
$serviceManager->addSubManager(CacheableSubManager::class);

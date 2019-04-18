<?php
declare(strict_types=1);
namespace Ixocreate\Cache\Package;

use Ixocreate\Cache\CacheManager;
use Ixocreate\Cache\Package\Factory\CacheItemPoolSubManagerFactory;
use Ixocreate\Cache\Package\Factory\CacheManagerFactory;
use Ixocreate\Cache\Package\Factory\CacheSubManagerFactory;

/** @var \Ixocreate\ServiceManager\ServiceManagerConfigurator $serviceManager */
$serviceManager->addService(CacheManager::class, CacheManagerFactory::class);
$serviceManager->addSubManager(CacheItemPoolSubManager::class, CacheItemPoolSubManagerFactory::class);
$serviceManager->addSubManager(CacheSubManager::class, CacheSubManagerFactory::class);
$serviceManager->addSubManager(CacheableSubManager::class);

<?php
declare(strict_types=1);
namespace Ixocreate\Package\Cache;

use Ixocreate\Cache\CacheManager;
use Ixocreate\Package\Cache\Factory\CacheItemPoolSubManagerFactory;
use Ixocreate\Package\Cache\Factory\CacheManagerFactory;
use Ixocreate\Package\Cache\Factory\CacheSubManagerFactory;
use Ixocreate\Package\Cache\Factory\ConfigFactory;

/** @var \Ixocreate\ServiceManager\ServiceManagerConfigurator $serviceManager */
$serviceManager->addService(CacheManager::class, CacheManagerFactory::class);
$serviceManager->addService(Config::class, ConfigFactory::class);
$serviceManager->addSubManager(CacheItemPoolSubManager::class, CacheItemPoolSubManagerFactory::class);
$serviceManager->addSubManager(CacheSubManager::class, CacheSubManagerFactory::class);
$serviceManager->addSubManager(CacheableSubManager::class);

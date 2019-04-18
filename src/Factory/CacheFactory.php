<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Package\Factory;

use Ixocreate\Cache\Cache;
use Ixocreate\ServiceManager\FactoryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Cache\Package\CacheItemPoolSubManager;

final class CacheFactory implements FactoryInterface
{
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        return new Cache(
            $container->get(CacheItemPoolSubManager::class)->get($requestedName)
        );
    }
}

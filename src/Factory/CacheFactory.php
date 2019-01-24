<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Cache\Factory;

use Ixocreate\Cache\Cache;
use Ixocreate\Contract\ServiceManager\FactoryInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Ixocreate\Package\Cache\CacheItemPoolSubManager;

final class CacheFactory implements FactoryInterface
{
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        return new Cache(
            $container->get(CacheItemPoolSubManager::class)->get($requestedName)
        );
    }
}

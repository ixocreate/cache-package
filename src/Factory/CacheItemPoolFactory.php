<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Factory;

use Ixocreate\ServiceManager\FactoryInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Cache\Config;

final class CacheItemPoolFactory implements FactoryInterface
{
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        /** @var Config $config */
        $config = $container->get(Config::class);

        $option = $config->get($requestedName);

        return $option->create($requestedName, $container);
    }
}

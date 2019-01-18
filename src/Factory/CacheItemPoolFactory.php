<?php
declare(strict_types=1);
namespace Ixocreate\Package\Cache\Factory;

use Ixocreate\Contract\Cache\DriverInterface;
use Ixocreate\Contract\ServiceManager\FactoryInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Ixocreate\Package\Cache\Config;

final class CacheItemPoolFactory implements FactoryInterface
{
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        /** @var Config $config */
        $config = $container->get(Config::class);

        $spec = $config->get($requestedName);
        $driver = $spec['driver'];
        $implements = class_implements($driver);
        if (!in_array(DriverInterface::class, $implements)) {
            //TODO Exception
        }

        /** @var DriverInterface $driver */
        $driver = new $driver($requestedName, $spec['options']);

        return $driver->create();
    }
}

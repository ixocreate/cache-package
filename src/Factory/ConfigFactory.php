<?php
declare(strict_types=1);
namespace Ixocreate\Package\Cache\Factory;

use Ixocreate\Config\Config;
use Ixocreate\Contract\ServiceManager\FactoryInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;

final class ConfigFactory implements FactoryInterface
{
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        /** @var Config $config */
        $config = $container->get(Config::class);
        $cache = $config->get("cache", []);

        return new \Ixocreate\Package\Cache\Config($cache);
    }
}

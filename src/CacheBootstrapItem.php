<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache;

use Ixocreate\Application\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\Configurator\ConfiguratorInterface;

final class CacheBootstrapItem implements BootstrapItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new CacheConfigurator();
    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return "cache";
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return "cache.php";
    }
}

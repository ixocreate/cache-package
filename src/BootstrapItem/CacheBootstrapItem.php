<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Package\BootstrapItem;

use Ixocreate\Application\Bootstrap\BootstrapItemInterface;
use Ixocreate\Application\ConfiguratorInterface;
use Ixocreate\Cache\Package\CacheConfigurator;

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

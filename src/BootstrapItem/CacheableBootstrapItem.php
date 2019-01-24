<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Cache\BootstrapItem;

use Ixocreate\Contract\Application\BootstrapItemInterface;
use Ixocreate\Contract\Application\ConfiguratorInterface;
use Ixocreate\Package\Cache\CacheableConfigurator;

final class CacheableBootstrapItem implements BootstrapItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new CacheableConfigurator();
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

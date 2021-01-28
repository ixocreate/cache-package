<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache;

use Ixocreate\ServiceManager\SubManager\AbstractSubManager;

final class CacheSubManager extends AbstractSubManager
{
    public static function validation(): ?string
    {
        return CacheInterface::class;
    }
}

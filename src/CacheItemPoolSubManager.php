<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache;

use Ixocreate\ServiceManager\SubManager\AbstractSubManager;
use Psr\Cache\CacheItemPoolInterface;

final class CacheItemPoolSubManager extends AbstractSubManager
{
    public static function validation(): ?string
    {
        return CacheItemPoolInterface::class;
    }
}

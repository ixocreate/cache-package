<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Package\Option;

use Ixocreate\Cache\CacheItemPool;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Ixocreate\Cache\Package\OptionInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

final class Filesystem implements OptionInterface
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @var int
     */
    private $defaultLifetime;

    /**
     * Filesystem constructor.
     * @param string|null $directory
     * @param int|null $defaultLifetime
     */
    public function __construct(?string $directory = null, ?int $defaultLifetime = null)
    {
        if (empty($directory)) {
            $directory = \sys_get_temp_dir();
        }
        if ($defaultLifetime === null) {
            $defaultLifetime = 0;
        }

        $this->directory = $directory;
        $this->defaultLifetime = $defaultLifetime;
    }

    /**
     * @return string
     */
    public function directory(): string
    {
        return $this->directory;
    }

    /**
     * @return int
     */
    public function defaultLifetime(): int
    {
        return $this->defaultLifetime;
    }

    /**
     * @param string $name
     * @param ServiceManagerInterface $serviceManager
     * @return CacheItemPoolInterface
     */
    public function create(string $name, ServiceManagerInterface $serviceManager): CacheItemPoolInterface
    {
        return new CacheItemPool(
            new FilesystemAdapter($name, $this->defaultLifetime(), $this->directory())
        );
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([
            'defaultLifetime' => $this->defaultLifetime,
            'directory' => $this->directory,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $unserialized = unserialize($serialized);
        $this->defaultLifetime = $unserialized['defaultLifetime'];
        $this->directory = $unserialized['directory'];
    }
}

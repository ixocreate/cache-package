<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Cache;

use Ixocreate\Cache\Driver\InMemoryDriver;

final class Config
{
    /**
     * @var array
     */
    private $pools = [];

    /**
     * Config constructor.
     * @param array $pools
     */
    public function __construct(array $pools)
    {
        foreach ($pools as $name => $spec) {
            $driver = $spec['driver'] ?? InMemoryDriver::class;
            $options = $spec['options'] ?? [];

            $this->pools[$name] = [
                'driver' => $driver,
                'options' => $options,
            ];
        }
    }

    /**
     * @param string $name
     * @return array
     */
    public function get(string $name): array
    {
        return $this->pools[$name];
    }

    public function pools(): array
    {
        return \array_keys($this->pools);
    }
}

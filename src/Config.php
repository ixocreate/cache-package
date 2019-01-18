<?php
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
     * @var array
     */
    private $drivers = [];

    /**
     * Config constructor.
     * @param array $pools
     */
    public function __construct(array $pools)
    {
        foreach ($pools as $name => $spec) {
            $driver = $spec['driver'] ?? InMemoryDriver::class;
            $options = $spec['options'] ?? [];

            $this->drivers[] = $driver;

            $this->pools[$name] = [
                'driver' => $driver,
                'options' => $options,
            ];
        }

        array_unique($this->drivers);
    }

    /**
     * @param string $name
     * @return array
     */
    public function get(string $name): array
    {
        return $this->pools[$name];
    }

    /**
     * @return array
     */
    public function drivers(): array
    {
        $this->drivers;
    }
}

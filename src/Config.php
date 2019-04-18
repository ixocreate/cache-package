<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache;

use Ixocreate\Application\Service\SerializableServiceInterface;

final class Config implements SerializableServiceInterface
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
        $this->pools = $pools;
    }

    /**
     * @param string $name
     * @return OptionInterface
     */
    public function get(string $name): OptionInterface
    {
        return $this->pools[$name];
    }

    /**
     * @return OptionInterface[]
     */
    public function pools(): array
    {
        return $this->pools;
    }

    /**
     * @return string|void
     */
    public function serialize()
    {
        return \serialize([
            'pools' => $this->pools,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $unserialize = \unserialize($serialized);
        $this->pools = $unserialize['pools'];
    }
}

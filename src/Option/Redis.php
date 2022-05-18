<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Option;

use Ixocreate\Cache\CacheItemPool;
use Ixocreate\Cache\OptionInterface;
use Ixocreate\ServiceManager\ServiceManagerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\RedisAdapter;

final class Redis implements OptionInterface
{
    private string $dsn;

    private bool $allowMemoryFallback;
    private array $options;

    /**
     * Redis constructor.
     * @param $host
     * @param null $port
     * @param null $auth
     * @param null $database
     */
    public function __construct($host, $port = null, $auth = null, $database = null, array $options = [], bool $allowMemoryFallback = false)
    {
        $this->dsn = 'redis://';
        if ($auth !== null) {
            $this->dsn .= $auth . '@';
        }
        $this->dsn .= $host;
        if ($port !== null) {
            $this->dsn .= ':' . $port;
        }
        if ($database !== null) {
            $this->dsn .= '/' . $database;
        }
        $this->options = $options;
        $this->allowMemoryFallback = $allowMemoryFallback;
    }

    /**
     * @return string|void
     */
    public function serialize()
    {
        return \serialize([
            'dsn' => $this->dsn,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = \unserialize($serialized);
        $this->dsn = $data['dsn'];
    }

    /**
     * @param string $name
     * @param ServiceManagerInterface $serviceManager
     * @throws \ErrorException
     * @return CacheItemPoolInterface
     */
    public function create(string $name, ServiceManagerInterface $serviceManager): CacheItemPoolInterface
    {
        try {
            $adapter = new RedisAdapter(
                RedisAdapter::createConnection($this->dsn, $this->options),
                $name
            );
        } catch (\Exception $e) {
            if (!$this->allowMemoryFallback) {
                throw $e;
            }
            $adapter = new ArrayAdapter(0, false);
        }

        return new CacheItemPool($adapter);
    }
}

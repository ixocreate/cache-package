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
use Symfony\Component\Cache\Adapter\RedisAdapter;

final class Redis implements OptionInterface
{
    /**
     * @var
     */
    private $dsn;

    /**
     * Redis constructor.
     * @param $host
     * @param null $port
     * @param null $auth
     * @param null $database
     */
    public function __construct($host, $port = null, $auth = null, $database = null)
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
        return new CacheItemPool(
            new RedisAdapter(
                RedisAdapter::createConnection($this->dsn),
                $name
            )
        );
    }
}

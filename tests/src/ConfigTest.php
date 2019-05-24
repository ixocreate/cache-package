<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Cache;

use Ixocreate\Cache\Config;
use Ixocreate\Cache\OptionInterface;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var array
     */
    private $pools = [];

    public function setUp()
    {
        $this->pools['foo'] = $this->createMock(OptionInterface::class);

        $this->config = new Config($this->pools);
    }

    public function testGet()
    {
        $this->assertInstanceOf(OptionInterface::class, $this->config->get('foo'));
    }

    public function testPools()
    {
        $this->assertSame($this->pools, $this->config->pools());
    }

    public function testSerialize()
    {
        $serialize = \serialize([
            'pools' => $this->pools,
        ]);

        $this->assertSame($serialize, $this->config->serialize());
    }

    public function testUnserialize()
    {
        $serialize = \serialize($this->pools);

        $configSerialize = $this->config->serialize();

        $this->config->unserialize($configSerialize);

        $this->assertSame(\unserialize($serialize), $this->config->pools());
    }
}

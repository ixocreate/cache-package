<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache\Console;

use Ixocreate\Application\Console\CommandInterface;
use Ixocreate\Cache\CacheItemPool;
use Ixocreate\Cache\CacheItemPoolSubManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearCacheConsole extends Command implements CommandInterface
{
    /**
     * @var CacheItemPoolSubManager
     */
    private $cacheItemPoolSubManager;

    /**
     * ClearCacheConsole constructor.
     * @param CacheItemPoolSubManager $cacheItemPoolSubManager
     */
    public function __construct(CacheItemPoolSubManager $cacheItemPoolSubManager)
    {
        parent::__construct(self::getCommandName());
        $this->cacheItemPoolSubManager = $cacheItemPoolSubManager;
    }

    public function configure()
    {
        $this
            ->addArgument('cache', InputArgument::REQUIRED, 'name of cache');

        $this->setDescription('flush a cache');
    }

    public static function getCommandName()
    {
        return 'cache:clear';
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->cacheItemPoolSubManager->has($input->getArgument('cache'))) {
            $output->writeln('<error>cache not found</error>');
            return 1;
        }

        /** @var CacheItemPool $cache */
        $cache = $this->cacheItemPoolSubManager->get($input->getArgument('cache'));
        $cache->clear();

        return 0;
    }
}

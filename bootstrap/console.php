<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Cache;

use Ixocreate\Application\Console\ConsoleConfigurator;
use Ixocreate\Cache\Console\ClearCacheConsole;

/** @var ConsoleConfigurator $console */
$console->addCommand(ClearCacheConsole::class);

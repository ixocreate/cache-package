<?php
declare(strict_types=1);

namespace Ixocreate\Package\Cache;

use Ixocreate\Contract\Application\ConfigExampleInterface;
use Ixocreate\Contract\Application\ConfigProviderInterface;

final class ConfigProvider implements ConfigProviderInterface, ConfigExampleInterface
{

    /**
     * @return string
     */
    public function configName(): string
    {
        return 'cache';
    }

    /**
     * @return string
     */
    public function configContent(): string
    {
        // TODO: Implement configContent() method.
    }

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'cache' => []
        ];
    }
}

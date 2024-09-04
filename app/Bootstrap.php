<?php

declare(strict_types=1);
namespace App;

use Nette\Configurator;

class Bootstrap
{
    public static function boot(): Configurator
    {
        $configurator = new Configurator;

        // Enable Tracy for error visualization
        $configurator->enableTracy(__DIR__ . '/../log');

        // Set the default timezone
        $configurator->setTimeZone('Europe/Prague');

        // Setup temporary directory
        $configurator->setTempDirectory(__DIR__ . '/../temp');

        // Load configurations
        $configurator->addConfig(__DIR__ . '/../config/common.neon');
        $configurator->addConfig(__DIR__ . '/../config/services.neon');

        return $configurator;
    }
}

<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Monolog\Logger;

// .env values should not be accessed directly outside of this file
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return function (ContainerBuilder $containerBuilder) {

    // This was moved from index.php
    if (!$_ENV['DEBUG']) { // Should be set to true in production
        $containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
    }

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {

            $debug_enabled = (bool) $_ENV['DEBUG'];

            return new Settings([
                'displayErrorDetails' => $debug_enabled, // Development: true. Production: false.
                'logError'            => !$debug_enabled, // Development: false. Production: true.
                'logErrorDetails'     => !$debug_enabled, // Development: false. Production: true.
                'logger' => [
                    'name' => $_ENV['PACKAGE_NAME'], // The name of the package as a string which follows Packagist naming conventions.
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => $debug_enabled ? Logger::DEBUG : Logger::ERROR, // Development: DEBUG. Production: ERROR.
                ],
            ]);
        }
    ]);
};

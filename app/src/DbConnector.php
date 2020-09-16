<?php declare(strict_types = 1);

namespace app;

use Spiral\Database;

final class DbConnector 
{    
    private static $dbal;

    private function _construct (): void
    {
        // empty
    }
    public static function getDbal(): Database\DatabaseManager
    {
        return new Database\DatabaseManager(
            new Database\Config\DatabaseConfig(
                $config = require __DIR__ . '/../config/dbConfig.php'
            )
        );
    }
} 
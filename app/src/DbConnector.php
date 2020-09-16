<?php declare(strict_types = 1);

namespace app;

use Spiral\Database;
use Cycle\ORM;

final class DbConnector 
{    
    private static $dbal;
    private static $orm;

    private function _construct(): void
    {
        // 
    }
    
    private function _clone(): void
    {
        // 
    }
    
    private function _wakeup(): void
    {
        throw new \Exception("Cannot unserialize this!");
    }
    
    private static function setDbal(): Database\DatabaseManager
    {
        self::$dbal = new Database\DatabaseManager(
            new Database\Config\DatabaseConfig(
                $config = require __DIR__ . '/../config/dbConfig.php'
            )
        );
        return self::$dbal;
    }
    
    public static function getDbal(): Database\DatabaseManager
    {
        return isset(self::$dbal) ? self::$dbal : self::setDbal();
    }

    private static function setOrm(): ORM\ORM
    {
        self::$orm = new ORM\ORM(new ORM\Factory(self::$dbal));
        return self::$orm;
    }

    public static function getOrm(): ORM\ORM
    {
        return isset(self::$orm) ? self::$orm : self::setOrm();
    }
} 
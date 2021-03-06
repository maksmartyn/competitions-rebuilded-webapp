<?php declare(strict_types = 1);

namespace app;

use Spiral\Database;
use Cycle\ORM;

final class DbConnector 
{    
    private static $dbal;
    private static $orm;

    private function __construct()
    {
        // 
    }
    
    private function __clone()
    {
        // 
    }
    
    private function __wakeup()
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
        $factory = new ORM\Factory(self::getDbal());
        $tables = self::getDbal()->database()->getTables();
        $validateResult = EntityValidator::validate($tables);
        if ($validateResult !== null) {           // TODO: after fixing a problems change !== to === 
            $schema = self::getSchema(self::getDbal());
        } else {
            throw new \Exception("Validate do not pass: ".implode(", ",$validateResult). ". " . "Message received: ");
        }
        self::$orm = new ORM\ORM($factory, $schema);
        return self::$orm;
    }

    public static function getOrm(): ORM\ORM
    {
        return isset(self::$orm) ? self::$orm : self::setOrm();
    }

    private static function getSchema(): ORM\SchemaInterface
    {
        $schema = null;
        if (file_exists(__DIR__ . '/../config/dbSchema.php')) {
            $schema = require __DIR__ . '/../config/dbSchema.php';
        } else {
            $schema = DbSchemaBuilder::buildSchema(self::getDbal());
        }        
        return new ORM\Schema($schema);
        
    }
}

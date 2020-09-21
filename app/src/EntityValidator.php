<?php declare(strict_types = 1);

namespace app;

class EntityValidator
{
    private static $invalidEntities;
    
    private function __construct()
    {
        //
    }

    public static function validate(array $tables)
    {
        self::$invalidEntities = null;
        
        foreach ($tables as $table) {
            $tableName = $table->getName();
            $className = ucfirst($tableName);
            $properties = array_keys($table->getColumns());
            self::validateEntity($className, $properties);
        }
        return self::$invalidEntities;
    }

    private static function validateEntity(string $className, array $properties): bool
    {
        if (class_exists($className)) {
            return self::validateProperties($className, $properties);
        } else {
            self::$invalidEntities[] = 'Class '.$className.' is not exists';
            return false;
        }
    }

    private static function validateProperties(string $className, array $properties): bool
    {
        foreach ($properties as $property) {
            if (!property_exists($className, $property)) {
                self::$invalidEntities[] = 'Property '.$property.' is not exists in '.$className;
                return false;
            } else {
                return self::validateGetMethod($className, 'get'.ucfirst($property));
            }
        }
    }

    private static function validateGetMethod(string $className, string $method): bool
    {
        if (!method_exists($className, $method)) {
            self::$invalidEntities[] = 'Method '.$method.' is not exists in '.$className;
            return false;
        } else {
                return true;
        }
    }
}

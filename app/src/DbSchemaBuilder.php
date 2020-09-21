<?php declare(strict_types = 1);

namespace app;

use Spiral\Database;
use Cycle\ORM\Schema;
use Cycle\ORM\SchemaInterface;

class DbSchemaBuilder
{
    private function __construct()
    {
        //
    }

    public static function buildSchema(Database\DatabaseManager $dbal, string $entitiesScope='app\\models', string $database='default'): array
    {
        $tables = $dbal->database($database)->getTables();
        $validateResult = EntityValidator::validate($tables);
        if ($validateResult === null) {
            foreach ($tables as $table) {
                $tableName = $table->getName();
                $className = ucfirst($tableName);
                $primaryKey = implode($table->getPrimaryKeys());
                $properties = array_keys($table->getColumns());
                $columns = array_combine($properties, $properties);
                $schema[$tableName] = [
                    Schema::MAPPER      => Mapper::class,
                    Schema::ENTITY      => $entitiesScope.'\\'.$className,
                    Schema::DATABASE    => $database,
                    Schema::TABLE       => $tableName,
                    Schema::PRIMARY_KEY => $primaryKey,
                    Schema::COLUMNS     => $columns,
                    Schema::TYPECAST    => [
                        'id' => 'int'
                    ],
                    Schema::RELATIONS   => $table->getForeignKeys()
                ];
            }
        } else {
            var_dump ($validateResult);
        }
        $schema = [];
        return $schema;
    }
}

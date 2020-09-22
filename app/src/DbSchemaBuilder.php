<?php declare(strict_types = 1);

namespace app;

use Spiral\Database;
use Cycle\ORM\Schema;
use Cycle\ORM\Relation;

class DbSchemaBuilder
{
    private function __construct()
    {
        //
    }

    public static function buildSchema(Database\DatabaseManager $dbal, string $entitiesScope='app\\models', string $database='default'): array
    {
        $tables = $dbal->database($database)->getTables();
        foreach ($tables as $table) {
            $tableName = $table->getName();
            $className = ucfirst($tableName);
            $primaryKey = implode($table->getPrimaryKeys());
            $properties = array_keys($table->getColumns());
            $columns = $table->getColumns();
            $columnsBindings = array_combine($properties, $properties);
            $columnsTypes = [];
            foreach ($columns as $column) {
                $columnsTypes[$column->getName()] = $column->getType();
            }
            $fks = $table->getForeignKeys();
            foreach ($fks as $fk) {
                $fkColumns = array_values($fk->getColumns());
                foreach ($fkColumns as $fkColumn) {
                    $relations[$fkColumn] = [
                        Relation::TYPE   => Relation::HAS_ONE,
                        Relation::TARGET => $fk->getForeignTable(),
                        Relation::SCHEMA => [
                            Relation::CASCADE   => true,
                            Relation::INNER_KEY => implode($fk->getForeignKeys()),
                            Relation::OUTER_KEY => implode($fk->getColumns()),
                        ]
                    ];
                }
            }
            var_dump ($relations);
            $schema[$tableName] = [
                Schema::MAPPER      => 'Cycle\ORM\Mapper',
                Schema::ENTITY      => $entitiesScope.'\\'.$className,
                Schema::DATABASE    => $database,
                Schema::TABLE       => $tableName,
                Schema::PRIMARY_KEY => $primaryKey,
                Schema::COLUMNS     => $columnsBindings,
                Schema::TYPECAST    => $columnsTypes,
                Schema::RELATIONS   => $relations 
            ];
        }
        //var_dump ($schema);
        $schema = [];
        return $schema;
    }
}

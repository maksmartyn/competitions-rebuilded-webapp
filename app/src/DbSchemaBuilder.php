<?php declare(strict_types = 1);

namespace app;

use Spiral\Database;
use Cycle\Schema;

class DbSchemaBuilder
{
    private function __construct()
    {
        //
    }

    public static function buildSchema(Database\DatabaseManager $dbal, string $entitiesScope='app\\models', string $database='default'): array
    {
        $registry = new Schema\Registry($dbal);
        $schema = (new Schema\Compiler())->compile($registry, []);
        return $schema;
    }
}

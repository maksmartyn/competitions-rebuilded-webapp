<?php declare(strict_types = 1);

namespace app;

final class App
{
    private function _construct(): void
    {
        //empty
    }

    public static function run()
    {
        return print_r(DbConnector::getDbal()->database('default')->getTables());
    }
};

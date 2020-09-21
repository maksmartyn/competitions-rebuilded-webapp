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
        $result = DbConnector::getOrm();
        return var_dump($result);
    }
};

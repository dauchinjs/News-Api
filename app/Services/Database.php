<?php

namespace App\Services;

use Doctrine\DBAL\DriverManager;

class Database
{
    public function connect()
    {
        $connectionParams = [
            'dbname' => 'news-api',
            'user' => 'root',
            'password' => $_ENV['MYSQL_PASSWORD'],
            'host' => $_ENV['MYSQL_HOST'],
            'driver' => 'pdo_mysql',
        ];

        return DriverManager::getConnection($connectionParams);
    }
}
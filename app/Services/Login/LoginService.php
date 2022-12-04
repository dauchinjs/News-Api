<?php

namespace App\Services\Login;

use App\Services\Database;
use Doctrine\DBAL\Connection;

class LoginService
{
    private Connection $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->connect();
    }

    public function execute(LoginServiceRequest $request) {
        $result = $this->connection->executeQuery(
            'SELECT id FROM `news-api`.users WHERE email=?', [
            $request->getEmail()]);

        $id = $result->fetchAssociative();

        $result = $this->connection->executeQuery(
            'SELECT password FROM `news-api`.users WHERE id=?', [$id['id']]);
        $hash = $result->fetchAllAssociative();

        if (password_verify($request->getPassword(), $hash[0]['password'])) {
            return $id;
        }
        return false;
    }
}
<?php

namespace App\Services\Register;

use App\Services\Database;
use Doctrine\DBAL\Connection;

class RegisterService
{
    private Connection $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->connect();
    }

    public function checkEmail($email) {
        $emailInDB = $this->connection->fetchAllKeyValue('SELECT id, email FROM `news-api`.users');
        if (in_array($email, $emailInDB)) {
            return 'email taken';
        }
        return null;
    }

    public function execute(RegisterServiceRequest $request)
    {
        $this->connection->insert('users', [
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
        ]);
    }
}
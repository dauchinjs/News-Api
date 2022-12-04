<?php

namespace App\Models;

use App\Services\Database;

class User {
    private string $name;

    public function __construct($id) {
        $db = new Database();
        $dbConnection = $db->connect();

        $this->name = $dbConnection->fetchOne('SELECT name FROM `news-api`.users WHERE id = ?', [$id]);
        $this->email = $dbConnection->fetchOne('SELECT email FROM `news-api`.users WHERE id = ?', [$id]);
    }

    public function getName(): string {
        return $this->name;
    }

}
<?php

namespace App\Services\Profile;

use App\Services\Database;

class ProfileService
{
    public function uploadProfile(string $type, string $value, string $id)
    {
        $connect = mysqli_connect(
            $_ENV['MYSQL_HOST'],
            'root',
            $_ENV['MYSQL_PASSWORD'],
            'news-api');
        if ($connect === false) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "UPDATE users SET {$type}='{$value}' WHERE id={$id}";
        if (mysqli_query($connect, $sql)) {
            return "Record was updated successfully.";
        }
        return "ERROR: Could not able to execute $sql. " . mysqli_error($connect);

//        Database::getConnection()->executeQuery("UPDATE users SET {$type} = '{$value}' WHERE id = {$id}")->fetchAssociative();
    }
}
<?php

namespace App\Services\Login;

use App\Services\Database;

class LoginService
{
    public function execute(LoginServiceRequest $request)
    {
        $result = Database::getConnection()->executeQuery(
            'SELECT id FROM `news-api`.users WHERE email=?', [
            $request->getEmail()]);

        $id = $result->fetchAssociative();

        $result = Database::getConnection()->executeQuery(
            'SELECT password FROM `news-api`.users WHERE id=?', [$id['id']]);
        $hash = $result->fetchAllAssociative();

        if (password_verify($request->getPassword(), $hash[0]['password'])) {
            return $id;
        }
        return false;
    }
}

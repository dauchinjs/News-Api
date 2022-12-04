<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\Login\LoginService;
use App\Services\Login\LoginServiceRequest;
use App\Template;

class LoginController
{

    public function showForm(): Template
    {
        return new Template('login.twig');
    }

    public function execute()
    {
        $loginService = new LoginService();
        $user = $loginService->execute(
            new LoginServiceRequest(
                $_POST['email'],
                $_POST['password'],
            ));

        if ($user === false) {
            return new Template('login.twig', ['credentials' => false]);
        }
        $_SESSION['users'] = $user['id'];
        return new Redirect('/');
    }
}

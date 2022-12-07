<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\Database;
use App\Services\Register\RegisterService;
use App\Services\Register\RegisterServiceRequest;
use App\Template;
use App\RegistrationValidation;

class RegisterController
{
    public function showForm(): Template
    {
        return new Template('register.twig');
    }

    public function store(): Redirect
    {
        (new RegistrationValidation())->validate($_POST);

        if (!empty($_SESSION['error'])) {
            return new Redirect('/register');
        }

        $registerService = new RegisterService();
        $registerService->execute(
            new RegisterServiceRequest(
                $_POST['name'],
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_DEFAULT),
            )
        );

        return new Redirect('/register');
    }
}

<?php

namespace App\Controllers;

use App\Redirect;
use App\RegistrationValidation;
use App\Services\Profile\ProfileService;
use App\Template;

class ProfileController
{
    public function showForm(): Template
    {
        return new Template('profile.twig');
    }

    public function updateProfile(): Redirect
    {
        (new RegistrationValidation())->validate($_POST);

        if (!empty($_SESSION['error'])) {
            return new Redirect('/profile');
        }

        if ($_POST['name'] && $_POST['email']) {
            (new ProfileService())->uploadProfile('name', $_POST['name'], $_SESSION['auth_id']);
            (new ProfileService())->uploadProfile('email', $_POST['email'], $_SESSION['auth_id']);
        } else if ($_POST['email']) {
            (new ProfileService())->uploadProfile('email', $_POST['email'], $_SESSION['auth_id']);
        } else if ($_POST['name']) {
            (new ProfileService())->uploadProfile('name', $_POST['name'], $_SESSION['auth_id']);
        } else if ($_POST['password']) {
            (new ProfileService())->uploadProfile('password',
                password_hash($_POST['password'], PASSWORD_DEFAULT), $_SESSION['auth_id']);
        }
        return new Redirect('/profile');
    }


}
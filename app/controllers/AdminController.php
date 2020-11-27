<?php

namespace app\controllers;

class AdminController extends AppController
{
    public function logoutAction()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }

    public function loginAction()
    {
        $credentials = require_once ROOT . '/config/config_admin.php';
        if ($_POST['login'] === $credentials['login'] && $_POST['password'] === $credentials['password']) {
            $_SESSION['user'] = 'admin';
        } else {
            $_SESSION['error'] = 'Wrong Credentials';
        }
        header('Location: /');
    }
}
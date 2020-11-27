<?php


namespace app\controllers;


use vendor\core\base\Controller;

class AppController extends Controller
{
    public    $is_admin = false;
    protected $model;

    /**
     * AppController constructor.
     * @param $route
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $this->is_admin = $this->isAdmin();
    }

    public function isAdmin()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }
}
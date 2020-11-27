<?php


namespace vendor\core\base;


abstract class Controller
{
    public $route = [];
    public $view;
    public $layout;
    public $vars;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view  = $route['action'];
    }

    public function getView()
    {
        if ($this->isAjax()) {
            echo json_encode($this->vars);
            return;
        }

        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    public function set($vars)
    {
        $this->vars = $vars;
    }
}
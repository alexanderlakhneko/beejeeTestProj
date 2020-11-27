<?php

namespace app\controllers;

use app\models\Exercises;

class ExercisesController extends AppController
{
    /**
     * ExercisesController constructor.
     * @param $route
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $this->model = new Exercises();
    }

    public function indexAction()
    {
        if ($this->is_admin) {
            $this->view = 'adminIndex';
        }

        $title = 'Exercises';
        $this->set(['title' => $title, 'isAdmin' => $this->is_admin]);
    }

    public function getAction()
    {
        if ($this->isAjax()) {
            $this->layout = false;
            $exercises    = $this->model;
            parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $query);
            $all                       = $exercises->get($this->columnNameByNumber($query['order'][0]['column']), $query['order'][0]['dir'], $query['length'], $query['start']);
            $count                     = $exercises->countAll();
            $result['draw']            = $query['draw'];
            $result['recordsTotal']    = $count;
            $result['recordsFiltered'] = $count;
            $result['data']            = array_values($all);
            $this->set($result);
        }
    }

    /**
     * @param $columnNumber
     * @return string|null
     */
    protected function columnNameByNumber($columnNumber): ?string
    {
        $columns = [
            0 => 'user_name',
            1 => 'email',
            2 => 'text',
            3 => 'is_finish',
            4 => 'is_edit_by_admin',
        ];

        return array_key_exists($columnNumber, $columns) ? $columns[$columnNumber] : null;
    }

    public function addAction()
    {
        $title = 'Add Exercises';
        $this->set(['title' => $title, 'isAdmin' => $this->isAdmin()]);
    }

    public function addExerciseAction()
    {
        if (!$this->validate($_POST)) {
            header('Location: /exercises/add');
        }

        $exercises            = $this->model;
        $exercises->user_name = htmlspecialchars($_POST['user_name']);
        $exercises->email     = htmlspecialchars($_POST['email']);
        $exercises->text      = htmlspecialchars($_POST['text']);
        if ($exercises->store()) {
            $_SESSION['flash'] = 'Success';
            header('Location: /exercises');
        } else {
            $_SESSION['error'] = 'Error';
            header('Location: /exercises');
        }
    }

    /**
     * @param $post
     * @return bool
     */
    protected function validate($post): bool
    {
        $flash = [];

        if (!isset($post['user_name'])) {
            $flash[] = 'User Name is require';
        }

        if (!isset($post['email'])) {
            $flash[] = 'User Name is require';
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $flash[] = 'Email is not valid';
        }

        if (!isset($post['text'])) {
            $flash[] = 'User Name is require';
        }

        if (count($flash)) {
            $_SESSION['errors'] = $flash;
            return false;
        }

        unset($_SESSION['errors']);
        return true;
    }

    public function editAction()
    {
        if (!$this->is_admin) {
            header('Location: /exercises');
        }

        $this->view = 'add';
        $title      = 'Edit Exercises';
        $exercises  = $this->model;
        $exercise   = $exercises->find($_GET['id']);
        $this->set(['title' => $title, 'isAdmin' => $this->isAdmin(), 'exercise' => $exercise]);
    }

    public function updateExerciseAction()
    {
        if (!$this->is_admin) {
            header('Location: /exercises');
        }

        if (!$this->validate($_POST)) {
            header(sprintf('Location: %s'), $_SERVER['HTTP_REFERER']);
        }

        $exercises = $this->model;

        $exercises->id               = $_GET['id'];
        $exercises->user_name        = htmlspecialchars($_POST['user_name']);
        $exercises->email            = htmlspecialchars($_POST['email']);
        $exercises->text             = htmlspecialchars($_POST['text']);
        $exercises->is_finish        = $_POST['is_finish'] === 'on' ? true : false;
        $exercises->is_edit_by_admin = true;
        if ($exercises->update()) {
            $_SESSION['flash'] = 'Success';
            header('Location: /exercises');
        } else {
            $_SESSION['error'] = 'Error';
            header('Location: /exercises');
        }
    }

}
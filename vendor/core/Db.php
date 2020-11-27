<?php


namespace vendor\core;

use R;

class Db
{
    protected static $instance;

    /**
     * Db constructor.
     */
    public function __construct()
    {
        $db = require_once ROOT . '/config/config_db.php';
        R::setup($db['dsn'], $db['user'], $db['password']);
        R::freeze(true);
    }

    /**
     * @return Db
     */
    public static function connect()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
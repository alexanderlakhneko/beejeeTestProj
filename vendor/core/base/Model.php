<?php


namespace vendor\core\base;


use vendor\core\Db;

abstract class Model
{
    protected $table;

    public function __construct()
    {
        Db::connect();
    }
}
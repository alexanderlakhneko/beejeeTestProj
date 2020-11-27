<?php

namespace app\models;

use vendor\core\base\Model;

class Exercises extends Model
{
    public    $id;
    public    $user_name;
    public    $email;
    public    $text;
    public    $is_finish        = false;
    public    $is_edit_by_admin = false;
    protected $rows             = ['user_name', 'email', 'text', 'is_finish', 'is_edit_by_admin'];

    /**
     * @param string $orderBy
     * @param string $orderType
     * @param null $limit
     * @param null $offset
     * @param bool $if_full_row
     * @return array|null
     */
    public function get($orderBy = 'id', $orderType = 'DESC', $limit = null, $offset = null, $if_full_row = false): ?array
    {
        $params = htmlspecialchars(sprintf('ORDER BY %s %s', $orderBy, $orderType));
        if ($limit) $params .= htmlspecialchars(sprintf(' LIMIT %s', $limit));
        if ($offset) $params .= htmlspecialchars(sprintf(' OFFSET %s', $offset));
        $columns = 'id,';
        if ($if_full_row) {
            $columns .= implode(',', $this->rows);
        } else {
            $columns .= ' user_name, email, text, is_finish, is_edit_by_admin';
        }

        return \R::getAll("SELECT $columns FROM exercises $params");
    }

    /**
     * @return int
     */
    public function countAll(): int
    {
        return \R::count('exercises');
    }

    /**
     * @return int|string|null
     */
    public function store()
    {
        $exercises = \R::dispense('exercises');

        foreach ($this->rows as $row) {
            $exercises->$row = $this->$row;
        }

        return \R::store($exercises);
    }

    /**
     * @return int|string|null
     */
    public function update()
    {
        $exercise = $this->load($this->id);

        foreach ($this->rows as $row) {
            if ($row === 'id') {
                continue;
            }
            $exercise->$row = $this->$row;
        }

        return \R::store($exercise);
    }

    /**
     * @param $id
     * @return \RedBeanPHP\OODBBean|null
     */
    public function load($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            return \R::load('exercises', $id);
        }
        return null;
    }

    /**
     * @param $id
     * @return array|null
     */
    public function find($id): ?array
    {
        $id = (int)$id;
        if ($id > 0) {
            return \R::getRow('select id, user_name, email, text, is_finish from exercises where id = ? limit 1', [$id]);
        }
        return [];
    }
}
<?php

namespace app\models;

use app\engine\Db;

abstract class DbModel extends Model
{

    public static function getLimit($from, $to)
    {
        $params = ['from'=> $from, 'to'=> $to];

        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}` LIMIT :from , :to";
        return Db::getInstance()->queryLimit($sql,$params);
    }

    public static function getCountWhere($field, $value) {
        $tableName = static::getTableName();
        $sql = "SELECT count(*) as count FROM {$tableName} WHERE `$field`=:value";
        return Db::getInstance()->queryOne($sql, ["value"=>$value])['count'];
    }

    public static function getWhereOne($field, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:value";
        return Db::getInstance()->queryObject($sql, ["value" => $value], static::class);
    }

    public function insert()
    {
        $params = [];
        $columns = [];

        foreach ($this->state as $key => $value) {
            $params[":{$key}"] = $this->$key;
            $columns[] = "`$key`";
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));

        $tableName = static::getTableName();

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        Db::getInstance()->execute($sql, $params);

        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ["id" => $this->id]);
    }

    public function update()
    {
        $tableName = $this->getTableName();
        $params = [];
        $columns = [];
        foreach ($this->state as $key => $value) {
            if ($value) {
                $columns[] = $key. ' = ' . "'" .$this->$key. "'";
                $params[":{$key}"] = $this->$key;
            }
        }
        $columns = implode(", ", $columns);

        $sql = 'UPDATE ' .$tableName.' SET  '. $columns. '  WHERE id =' . $this->id;

        Db::getInstance()->execute($sql,$params);

        $this->clearState();
        return $this;

    }

    public function save()
    {
        if (is_null($this->id))
            $this->insert();
        else
            $this->update();
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return Db::getInstance()->queryAll($sql);
    }

    abstract public static function getTableName();

}
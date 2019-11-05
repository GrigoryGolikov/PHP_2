<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModels;

abstract class Model implements IModels
{
    protected $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function insert()
    {
        $tableName = $this->getTableName();
        $params = [];
        $columns = [];

        foreach ($this as $key => $value){
            if ($key === "id") continue;
            if ($key === "db") continue;
            $params[":{$key}"] = $this->$key;
            $columns[] = "`$key`";
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ($values);";

        $this->db->execute($sql,$params);
        $this->id = $this->db->lastInsertId();
        var_dump($this->id);
    }

    public function delete()
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";

        $this->db->execute($sql,['id' => $this->id]);

    }

    public function update()
    {
        $tableName = $this->getTableName();
        $params = [];
        $columns = [];
        foreach ($this as $key => $value) {
            if ($key === "id") continue;
            if ($key === "db") continue;
            $columns[] = $key. ' = ' . "'" .$this->$key. "'";
            $params[":{$key}"] = $this->$key;
        }
        $columns = implode(", ", $columns);

        $sql = 'UPDATE ' .$tableName.' SET  '. $columns. '  WHERE id =' . $this->id;

        $this->db->execute($sql,$params);


    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id";
       // var_dump(get_class ($this) );
        return $this->db->queryObject($sql, ['id' => $id],get_class ($this) );
    }
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return $this->db->queryAll($sql);
    }

    abstract public function getTableName();

}
<?php

namespace app\models;

use app\engine\App;
use app\engine\Db;
use app\interfaces\IModels;

abstract class Repository implements IModels
{

    public function getWhereOne($field, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `$field`=:value";
        return App::call()->db->queryObject($sql, ["value" => $value], $this->getEntityClass());
    }

    public function insert($entity)
    {
        $params = [];
        $columns = [];

        foreach ($entity->state as $key => $value) {
            $params[":{$key}"] = $entity->$key;
            $columns[] = "`$key`";
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));

        $tableName = $this->getTableName();

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";

        App::call()->db->execute($sql, $params);
        $entity->id = App::call()->db->lastInsertId();
        return $entity;
    }

    public function delete($entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return App::call()->db->execute($sql, ["id" => $entity->id]);
    }

    public function update($entity)
    {
        $tableName = $this->getTableName();
        $params = [];
        $columns = [];
        foreach ($entity->state as $key => $value) {
            if ($value) {
                $columns[] = $key. ' = ' . "'" .$entity->$key. "'";
                $params[":{$key}"] = $entity->$key;
            }
        }
        $columns = implode(", ", $columns);

        $sql = 'UPDATE ' .$tableName.' SET  '. $columns. '  WHERE id =' . $entity->id;

        App::call()->db->execute($sql,$params);

        $entity->clearState();
        return $entity;

    }

    public function save($entity)
    {

        if (is_null($entity->id))
            $this->insert($entity);
        else
            $this->update($entity);
    }

    public function getLimit($from, $to)
    {
        $params = ['from'=> $from, 'to'=> $to];

        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` LIMIT :from , :to";
        return App::call()->db->queryLimit($sql,$params);
    }


    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}` WHERE id = :id";
        return App::call()->db->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM `{$tableName}`";
        return App::call()->db->queryAll($sql);
    }

}
<?php

namespace core;

use \PDO;
use core\Response;

class Database {

    public $connection;
    public $statement;

    public function __construct($config, $username = Response::DB_USER, $password = Response::DB_PASSWORD)
    {
        $dsn = 'mysql:'. http_build_query($config, '', ';');
        
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function insert($table, $fields = [])
    {
        $fieldstring = '';
        $valuestring = '';
        $values = [];
        
        foreach($fields as $field => $value) {
            $fieldstring .= '`' . $field . '`,';
            $valuestring .= '?,';
            $values[] = $value;
        }

        $fieldstring = rtrim($fieldstring, ',');;
        $valuestring = rtrim($valuestring, ',');
        $sql = "insert into {$table} ({$fieldstring}) values ({$valuestring})";
        if (!$this->query($sql, $values)) {
            return true;
        }
        return false;
    }

    public function update($table, $id, $fields = [])
    {
        $fieldstring = '';
        $values = [];
        
        foreach($fields as $field => $value) {
            $fieldstring .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }

        $fieldstring = trim($fieldstring);
        $fieldstring = rtrim($fieldstring, ',');
        $sql = "update {$table} set {$fieldstring} where id = {$id}";
        if (!$this->query($sql, $values)) {
            return true;
        }
        return false;
    }

    public function customUpdate($table, $custom_id, $id, $fields = [])
    {
        $fieldstring = '';
        $values = [];
        
        foreach($fields as $field => $value) {
            $fieldstring .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }

        $fieldstring = trim($fieldstring);
        $fieldstring = rtrim($fieldstring, ',');
        $sql = "update {$table} set {$fieldstring} where `{$custom_id}` = '{$id}'";
        if (!$this->query($sql, $values)) {
            return true;
        }
        return false;
    }

    public function doubleFieldUpdate($table, $custom_id, $id, $customField, $customValue, $fields = [])
    {
        $fieldstring = '';
        $values = [];
        
        foreach($fields as $field => $value) {
            $fieldstring .= ' ' . $field . ' = ?,';
            $values[] = $value;
        }

        $fieldstring = trim($fieldstring);
        $fieldstring = rtrim($fieldstring, ',');
        $sql = "update {$table} set {$fieldstring} where `{$custom_id}` = '{$id}' and `{$customField}` = '{$customValue}'";
        if (!$this->query($sql, $values)) {
            return true;
        }
        return false;
    }

    public function delete($table, $id)
    {
        $sql = "delete from {$table} where id = {$id}";
        if (! $this->query($sql)) {
            return true;
        }
        return false;
    }

    public function findById($table, $id)
    {
        return $this->query("select * from {$table} where id = {$id}");
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find() 
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (! $result){
            abort(Response::FORBIDEN);
        }

        return $result;
    }

    public function getOrFail()
    {
        $result = $this->get();

        if (! $result){
            abort(Response::FORBIDEN);
        }

        return $result;
    }
}
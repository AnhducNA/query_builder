<?php

namespace Anhduc\QueryBuilder\Eloquent;

use Anhduc\QueryBuilder\Connection\Connection;
use Anhduc\QueryBuilder\Query\Builder;
use Anhduc\QueryBuilder\Trait\HasAttribute;
use JsonSerializable;
use PDO;
use RuntimeException;

abstract class Model implements JsonSerializable
{
    use HasAttribute;

    protected static string $table = '';
    protected static string $primary_key = 'id';
    protected static $instance = null;
    protected array $hidden = [];
    private PDO $pdo;
    private Builder $builder;

    public function __construct()
    {
        $this->pdo = Connection::getConnection();
        $this->builder = new Builder(static::$table);
    }

    public static function __callStatic($method, $parameters)
    {
//        dd(func_get_args());
        return (new static)->{"pre" . $method}(...$parameters);
    }


    private static function createInstance()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }
    }

    private static function isSetTable()
    {
        if (!isset(static::$table)) {
            throw new RuntimeException("Table name not set");
        }
    }

    public function __call($method, $parameters)
    {
        return (new static)->{"pre" . $method}(...$parameters);
    }

    public function preselect(...$fields)
    {

        static::createInstance();
        static::isSetTable();
        static::$instance->builder->select(...$fields);
        return static::$instance;

    }


    public function prewhere($column, $operator = '=', $value = null, $boolean = 'and')
    {
        static::createInstance();
        static::isSetTable();
        static::$instance->builder->where($column, $operator, $value, $boolean);
        return static::$instance;
    }

    public static function preall($col = ['*'])
    {
        static::isSetTable();
        $columns = $col[0] === '*' ? $col[0] : static::$primary_key . ",". implode(',', $col);
        $sql = "SELECT " . $columns . " FROM " . static::$table;
        $stmt = (new static)->pdo->prepare($sql);
        $stmt->execute();
        $models = [];
        foreach($stmt->fetchAll(\PDO::FETCH_ASSOC) as $data) {
            $models[] = (new static)->createModel($data);
        }
        return $models;
    }
    public function preget($columns = ['*'])
    {
        static::isSetTable();
        if(!in_array($columns, [static::$primary_key]) && $columns[0] !== '*') {
            $columns = [...$columns,static::$primary_key];
        }
        $data = static::$instance->builder->select(...$columns)->get();
        $models = [];
        foreach($data as $value) {
            $models[] = (new static)->createModel($value);
        }
        return $models;
    }
    public static function prefirst($columns = ['*'])
    {
        static::createInstance();
        if(!in_array($columns, [static::$primary_key]) && $columns[0] !== '*') {
            $columns = [...$columns,static::$primary_key];
        }
        $data = static::$instance->builder->select(...$columns)->first();
        return (new static)->createModel($data);
    }
    public function jsonSerialize()
    {
    }

    private function createModel($data)
    {
        if (!$data) return null;
        $data = array_diff_key($data, array_flip($this->hidden));
        $model = new static();
        $model->exists = true;
        $model->attributes = $data;
        return $model;

    }
}
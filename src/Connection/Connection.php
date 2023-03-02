<?php

namespace Anhduc\QueryBuilder\Connection;

use PDO;

class Connection
{
    // PDO Object
    protected static $pdo;

    // create a new connection instance.
    public function __construct($config)
    {
        self::connect($config);
    }

    // open connection
    public static function connect($config)
    {
        self::$pdo = new PDO('mysql:host=' . $config['DB_SERVERNAME'] . ';dbname=' . $config['DB_DATABASE'], $config['DB_USERNAME'], $config['DB_PASSWORD']);
    }

    public static function getConnection()
    {
        return self::$pdo;
    }


}
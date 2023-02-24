<?php

namespace Anhduc\QueryBuilder\Connection;

class MySqlConnection
{
    // PDO Object
    protected $pdo;

    // create a new connection instance.
    public function __construct(array $config)
    {
        $this->open($config);
    }

    // destroy an exists connection instance.
    public function __destruct()
    {
        $this->close();
    }

    // open connection
    private function open(array $config)
    {
        $this->pdo = new \PDO(
            $config['DB_CONNECTION'].':host='.$config['DB_SERVERNAME'].';dbname=' . $config['DB_DATABASE'],
            $config['DB_USERNAME'],
            $config['DB_PASSWORD']
        );
    }

    // execute a sql query.
    public final function execute($sql)
    {
        return $this->pdo->exec($sql);
    }

    // send a sql query to get results.
    public final function query($sql, array $params = [])
    {
        if (! empty($params)) {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($params);
            return $sth;
        }

        return $this->pdo->query($sql);
    }

    // close connection.
    private function close()
    {
        $this->pdo = null;
    }

}
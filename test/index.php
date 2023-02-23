<?php

// include all example files.
use Anhduc\QueryBuilder\Connection\MySqlConnection;
use Anhduc\QueryBuilder\QueryBuilder\MySqlBuilder;

include 'src/QueryBuilder/SqlClauses.php';
include 'src/QueryBuilder/BaseSqlBuilder.php';
include 'src/QueryBuilder/MySqlBuilder.php';
include 'src/Connection/MySqlConnection.php';

$_SERVER['DOCUMENT_ROOT'] = "/home/anhduc/Work/htdocs/query_builder";
$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/config.ini');
// create a new mysql connection.
$connection = new MySqlConnection($config);

// create a new mysql instance.
$builder = new MySqlBuilder($connection);

// test an example.
$user = $builder
    ->select('id', 'name')
    ->from('users')
    ->all();

print_r($user);

// get a compiled select.
$sql = $builder->select('id', 'fullname')
    ->from('users')
    ->where('id', '=', 3)
    ->getCompiledSelectStatement();

print_r($sql);


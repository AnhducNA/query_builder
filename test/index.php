<?php

require 'vendor/autoload.php';

$config = ['DB_SERVERNAME' => '127.0.0.1', 'DB_PORT' => '3306', 'DB_DATABASE' => 'query_builder', 'DB_USERNAME' => 'root', 'DB_PASSWORD' => 'password'];
$connection = new \Anhduc\QueryBuilder\Connection\Connection($config);

//$builder = (new Anhduc\QueryBuilder\DB($config))->select('id', 'name')->table('users')->where('id', '=', 1)->all();
//dd($builder);

$user = \Anhduc\QueryBuilder\Models\User::where('id', '=', 1)->get();
dd($user);

// create a new mysql connection.
//
//// create a new mysql instance.
//$builder = new \Anhduc\QueryBuilder\QueryBuilder\MySqlBuilder($connection);
//
//// test an example.
//$user = $builder->select('id', 'name')->table('users')->all();

//print_r($user);
//
//// get a compiled select.
//$sql = $builder->select('id', 'name')->from('users')->where('id', '=', 3)->getCompiledSelectStatement();
//
//print_r($sql);


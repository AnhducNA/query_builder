<?php

require 'vendor/autoload.php';

$config = ['DB_SERVERNAME' => '127.0.0.1', 'DB_PORT' => '3306', 'DB_DATABASE' => 'query_builder', 'DB_USERNAME' => 'root', 'DB_PASSWORD' => 'password'];
$connection = new \Anhduc\QueryBuilder\Connection\Connection($config);

//$builder = (new Anhduc\QueryBuilder\DB())->select('id', 'name')->table('users')->where('id', '=', 1)->get();
//dd($builder);

//$user = \Anhduc\QueryBuilder\Models\User::where('id', '=', '1')->first();
//dd($user);



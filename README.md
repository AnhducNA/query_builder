## Create Query Builder is a simple, methods-chaining dependency-free library to create SQL Queries simple. Supports databases which are supported by PDO

Người thực hiện: [Lê Anh Đức](https://github.com/AnhducNA)

## Cài đặt

```
composer require anhduc/query_builder
```

## Cấu 

Sửa biến $config thích hợp trong file test/index.php

```php
$config = ['DB_SERVERNAME' => '127.0.0.1', 'DB_PORT' => '3306', 'DB_DATABASE' => 'query_builder', 'DB_USERNAME' => 'root', 'DB_PASSWORD' => 'password'];

```


## Cách sử dụng:

1. Connect database

```php
$connection = new \Anhduc\QueryBuilder\Connection\Connection($config);
```

2. Sử dụng Query Builder

Ví dụ lấy danh sách trong bảng users:

```php
$builder = (new Anhduc\QueryBuilder\DB())->select('id', 'name')->table('users')->where('id', '=', 1)->all();
```

3. Sử dụng Model:

Ví dụ lấy danh sách trong bảng users:

```php
$user = \Anhduc\QueryBuilder\Models\User::where('id', '=', '1')->first();
```
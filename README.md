## Create Query Builder is a simple, methods-chaining dependency-free library to create SQL Queries simple. Supports databases which are supported by PDO

Người thực hiện: [Lê Anh Đức](https://github.com/AnhducNA)

## Installation
## Configuration

- Create a config.ini file in root folder with content

```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=database_name
    DB_USERNAME=root
    DB_PASSWORD=password
```

and customize it

## Usage examples

1. Use Query Builder

   ```php
       <?php
           require 'vendor/autoload.php';
           use Hoangm\Query\DB;
           $user = DB::table('users')->get();
   ```
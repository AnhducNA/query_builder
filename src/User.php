<?php

namespace Anhduc\QueryBuilder;

use Anhduc\QueryBuilder\Model\Model;

class User extends Model
{
    protected static string $table = 'users';
    protected array $hidden = ['password'];

}
<?php

namespace App\Models;

use Core\Database\Model;

class Auth extends Model {
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password']; 
}
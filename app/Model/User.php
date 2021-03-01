<?php

namespace App\Model;

use App\Database\Connect;

class User extends Connect
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'img'
    ];

    public function __construct()
    {
        parent::__construct('users', $this->fillable);
    }
}

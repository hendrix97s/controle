<?php

namespace App\Model;

use App\Database\Connect;

class Teste extends Connect
{
    public function __construct()
    {
        parent::__construct('teste');
    }
}

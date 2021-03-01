<?php

namespace App\Model;

use App\Database\Connect;
use App\Helpers\Debug;

class Cost extends Connect
{
    protected $fillable = [
        'id_user',
        'type',
        'date',
        'value',
        'description'
    ];

    public function __construct()
    {
        parent::__construct('costs', $this->fillable);
    }

  
}

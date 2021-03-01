<?php
namespace App\Model;

use App\Database\Connect;

class MoneyInput extends Connect
{
    protected $fillable = [
        'id_user',
        'origem',
        'value',
        'description',
        'date'
    ];

    public function __construct()
    {
        parent::__construct('money_input', $this->fillable);
    }
}

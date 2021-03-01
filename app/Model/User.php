<?php

namespace App\Model;

use App\Database\Connect;

/**
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * Classe Model User responsavel pela interação com o banco de dados
 * 
 */
class User extends Connect
{

    //fillable utilizado para validação dos campos do database
    //utilizados no momento de inserir ou atualizar os dados no db
    protected $fillable = [
        'name',
        'email',
        'password',
        'img'
    ];

    public function __construct()
    {
        //abre conexao com DB, registra o nome da tabela e o fillable para 
        //validação
        parent::__construct('users', $this->fillable);
    }
}

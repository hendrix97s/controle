<?php

namespace App\Model;

use App\Database\Connect;

/**
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * Classe Model Cost responsavel pela interação com o banco de dados
 * 
 */
class Cost extends Connect
{
    //fillable utilizado para validação dos campos do database
    //utilizados no momento de inserir ou atualizar os dados no db
    protected $fillable = [
        'id_user',
        'type',
        'date',
        'value',
        'description'
    ];

    public function __construct()
    {
        //abre conexao com DB, registra o nome da tabela e o fillable para 
        //validação
        parent::__construct('costs', $this->fillable);
    }

  
}

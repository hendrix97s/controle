<?php

namespace App\Controller;

use App\Database\Filter;
use App\Helpers\Redirect;
use App\Model\MoneyInput;

/**
 * Classe Controle responsavel pelas operações
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * 
 */
class MoneyController
{
    private $money;

    public function __construct(){
        $this->money = new MoneyInput;
    }


    /**
     * retorna a view de acordo com o parametro
     *
     * @param   string  $route  nome da rota para retorno de view
     *
     * @return  void
     */
    public function index(string $route){
        switch ($route) {
            case '/home':
                include_once "../view/home.php";
                break;
            case '/salario':
                include_once "../view/money.php";
                break;
        }
    }

    /**
     * responsavel por cadastrar um novo salario no db
     *
     * @param   array  $request  array com os dados para cadastro
     *
     * @return  void
     */
    public function store(array $request): void{
        $this->money->store($request);
        Redirect::run('/salario');
    }

    /**
     * responsavel por pegar o registro do db referente ao id do parametro
     *
     * @param   int     $id  indice do salario solicitado
     *
     * @return  object  retorna um objeto com os dados de requisição
     */
    public function show(int $id): object{
        return $this->money->find($id);
    }

    /**
     * responsavel por pegar todos os registros de salario do db
     *
     * @return  string  retorna um objeto json
     */
    public function showAll(): string{
        $json = $this->money->all();
        return json_encode($json);
    }

    /**
     * responsavel por retornar a soma dos salarios do db agrupados por mes
     *
     * @return  string  retorna um objeto json
     */
    public function showSumAll(): string{
        $json = $this->money->sumOfMonth();
        return json_encode($json);
    }

    /**
     * deleta salario
     *
     * @param   int  $id  id do salario a ser deletado
     *
     * @return  void         
     */
    public function delete(int $id): void{
        $id = Filter::run($id);
        $this->money->where('id', '=', $id)->delete();
    }
}

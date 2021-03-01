<?php

namespace App\Database;

use App\Database\Filter;
use PDO;
use App\Helpers\Debug;


/**
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * [Connect responsavel por abrir conexao com banco de dados e fazer requisições]
 */

class Connect extends Filter
{

    // Classe Trait auxiliar a construção de instruções SQL
    // para Inserir ou atualizar dados no database
    use SqlInsert;

    protected object    $link; //recebe o objeto de conexao PDO
    protected array     $where; //recebe as condições para clausula where
    protected string    $table; //recebe o nome da tabela atraves do model
    protected string    $month; //recebe string parte de requisição para retornar os campos (MES)
    protected $fillable; //recebe os nomes dos campos da tabela

    public function __construct(string $table, array $fillable){
        $this->table = $table; //recebe nome da tabela
        $this->fillable = $fillable; //recebe os nomes dos campos da tabela
        $this->where = []; //inicia atributo where como array

        //monta dsn com as informações imputada no DOTENV
        $dsn = "$_ENV[CONN]:host=$_ENV[HOST]; dbname=$_ENV[DATABASE]";

        //instancia classe PDO para conexao com informações do DOTENV
        $pdo = new PDO($dsn, $_ENV['USER'], $_ENV['PASSWORD']);

        // seta que todo retorno de requisição deve ser um objeto
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // caso haja algum erro lança exceção

        $this->link = $pdo; //seta o atributo $link com o objeto PDO retornado
    }

    /**
     * Methodo encadeado responsavel por setar o atributo $month com parte do sql
     * para gerar os campos month (mes da data)
     *
     * @return  object  retorna objeto encadeado
     */
    public function month(): object{
        $this->month = ",MONTH(date) as 'month'";
        return $this;
    }

    /**
     * Methodo encadeado responsavel por inserir as condições no atributo where
     *
     * @param   string  $column    coluna da tabela
     * @param   string  $operator  operador condicional
     * @param   string  $value     valor a ser comparado
     *
     * @return  object retorna objeto encadeado
     */
    public function where(string $column, string $operator, string $value): object{
        $column = Filter::run($column); //filtra palavras reservadas
        $value = Filter::run($value); //filtra palavras reservadas

        //faz um push de requisição no atributo where
        array_push($this->where, ['column' => $column, 'operator' => $operator, 'value' => $value]);
        return $this; 
    }

    /**
     * Methodo responsavel por montar a clausula where de acordo com o referenciado no controller
     *
     * @return  string  retorna a clausula where
     */
    protected function mountWhere(): string{

        $countWhere = count($this->where); //conta quantas condições foram inseridas no atributo where
        $i = 0;
        $instruction = ''; //variavel que recebera a string da clausula where

        if ($countWhere > 0) {
            while ($i < $countWhere) {

                $condition =  ""
                    . $this->where[$i]['column']
                    ." ". $this->where[$i]['operator']." "
                    . "'" . $this->where[$i]['value'] . "'";

                if ($i == 0) {
                    $instruction .= " WHERE($condition";
                }
                if ($i > 0 && $i < $countWhere) {
                    $instruction .= " AND $condition";
                }
                if ($i == $countWhere - 1) {
                    $instruction .= ")";
                }
                $i++;
            }
        }

        $this->where = [];//limpa atributo para proxima requisição
        return $instruction;
    }

    /**
     * Methodo responsavel por retornar o registro da tabela referente ao parametro
     *
     * @param   int  $id  deve ser o indice da tabela
     *
     * @return  object  retorna um objeto com os dados do registro
     */
    public function find(int $id):object{
        $id = Filter::run($id); //filtra $id eliminando palavras reservadas

        $table = $this->table;

        $sql = "SELECT * FROM $table WHERE id = ?";
        $pdo = $this->link->prepare($sql);
        $pdo->bindValue(1, $id);

        if ($pdo->execute()) {
            return $pdo->fetch();
        } else {
            return (object)[];
        }
    }

    /**
     * Methodo responsavel por retornar todos os registros da tabela referenciada pelo model
     *
     * @return  array   retorna todos os registros da requisição
     */
    public function all():array{
        $condition = $this->mountWhere();//retorna a condição gerada pelo metodo encadeado
        $sql = "SELECT * FROM $this->table $condition";
        $query = $this->link->query($sql);
        return $query->fetchAll();
    }

    /**
     * Methodo responsavel por adicionar registro ao Database
     *
     * @param   array  $request  dados a ser imputado do database
     *
     * @return  void  
     */
    public function store(array $request): void{

        //gera o sql insert de acordo com o $fillable definido no model
        //INSERT INTO users (name,email,password,img) VALUES (:name,:email,:password,:img)
        $sql = $this->runConstructInsert($this->table, $this->fillable);
        $insert = $this->link->prepare($sql);

        // incorpora os valores em suas respectivas posições do sql
        foreach ($request as $key => $value) {
            // (":name", luiz felipe)
            $insert->bindValue(":$key", $value);
        }

        $insert->execute();
    }

    /**
     * Methodo responsavel por fazer a atualização dos dados de um
     * ou todos os registros
     *
     * @param   array  $request  dados para atualização de registro
     *
     * @return  void
     */
    public function update(array $request): void{
        $condition = $this->mountWhere();//retorna a condição gerada pelo metodo encadeado
        $sql = $this->runConstructUpdate($this->table,$request,$condition);
        $update = $this->link->prepare($sql);
        $update->execute($request);
    }

    /**
     * Methodo responsavel por deletar 1 ou todos os itens de uma tabela
     *
     * @return  void
     */
    public function delete():void{
        $condition = $this->mountWhere(); //retorna a condição gerada pelo metodo encadeado
        $sql = "DELETE FROM $this->table $condition";
        $delete = $this->link->query($sql);
    }

    /**
     * Methodo responsavel por requisitar ao database a soma dos valores agrupados por mes
     *
     * @return  array   rotorna um array com todas as somas dos valores agrupados por mes
     */
    public function sumOfMonth():array{
        $condition = $this->mountWhere();
        $sql = "SELECT SUM(value) as 'sum', MONTH(date) as 'month' FROM $this->table $condition GROUP BY MONTH(date)";
        $query = $this->link->query($sql);
        return $query->fetchAll();
    }
}

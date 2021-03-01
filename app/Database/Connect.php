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

    use SqlInsert;

    protected $link;
    protected $where;
    protected $table;
    protected $fillable;
    protected $month;

    public function __construct(string $table, array $fillable){
        $this->table = $table;
        $this->fillable = $fillable;

        $this->where = [];
        $dsn = "$_ENV[CONN]:host=$_ENV[HOST]; dbname=$_ENV[DATABASE]";
        $pdo = new PDO($dsn, $_ENV['USER'], $_ENV['PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->link = $pdo;
    }

    public function month(): object{
        $this->month = ",MONTH(date) as 'month'";
        return $this;
    }

    public function where(string $column, string $operator, string $value): object{
        array_push($this->where, ['column' => $column, 'operator' => $operator, 'value' => $value]);
        return $this;
    }

    protected function mountWhere(): string{

        $countWhere = count($this->where);
        $i = 0;
        $instruction = '';

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

        $this->where = [];
        return $instruction;
    }

    public function find($id):object{
        $id = Filter::run($id);

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

    public function all():array{
        $condition = $this->mountWhere();
        $sql = "SELECT * FROM $this->table $condition";
        $query = $this->link->query($sql);
        return $query->fetchAll();
    }


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

    public function update(array $request): void{
        $condition = $this->mountWhere();
        $sql = $this->runConstructUpdate($this->table,$request,$condition);
        $update = $this->link->prepare($sql);
        $update->execute($request);
    }

    public function delete():void{
        $condition = $this->mountWhere();
        $sql = "DELETE FROM $this->table $condition";
        $delete = $this->link->query($sql);
    }

    public function sumOfMonth():array{
        $condition = $this->mountWhere();
        $sql = "SELECT SUM(value) as 'sum', MONTH(date) as 'month' FROM $this->table $condition GROUP BY MONTH(date)";
        $query = $this->link->query($sql);
        return $query->fetchAll();
    }
}

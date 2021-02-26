<?php

namespace App\Database;

use App\Database\Filter;
use PDO;


/**
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * [Connect responsavel por abrir conexao com banco de dados e fazer requisições]
 */

class Connect extends Filter
{

    private $link;
    private $where;
    private $table;


    public function __construct(string $table)
    {
        $this->table = $table;
        $this->where = [];
        $dsn = "$_ENV[CONN]:host=$_ENV[HOST]; dbname=$_ENV[DATABASE]";
        $pdo = new PDO($dsn, $_ENV['USER'], $_ENV['PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        if ($_ENV['DEBUG'] == 'true') {
            /**
             * @var pdo caso haja algum erro na conexão ou requisição o pdo lança um exception
             */
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        $this->link = $pdo;
    }


    public function where(string $column, string $operator, string $value): object
    {
        array_push($this->where, ['column' => $column, 'operator' => $operator, 'value' => $value]);
        return $this;
    }

    public function find($id)
    {
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
}

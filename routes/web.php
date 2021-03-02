<?php

/**
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * Rotas
 * Arquivo responsavel por intermediar as requisições entre view e controller
 */

use App\Config\Route;
use App\Database\Filter;
use App\Helpers\Debug;
use App\Helpers\Redirect;

$route = new Route;
$url = $_SERVER['REDIRECT_URL'];

switch ($url) {
        //edita os dados do usuario
    case '/edit/profile':

        $data = [
            'name'      => Filter::run($_POST['name']),
            'email'     => Filter::run($_POST['email']),
            'password'  => Filter::run($_POST['password']),
            'img'       => $_FILES['img']
        ];
        $route->exec($url, 'update', $data);
        break;

        //cadastra um novo custo
    case '/costs/store':
        $route->exec($url, 'store', $_REQUEST);
        break;

        //cadastra um novo salario    
    case '/money/store':
        $route->exec($url, 'store', $_REQUEST);
        break;

        // retorna a view de inicio "home"
    case '/home':
        $route->exec($url, 'index', $url);
        break;
        //retorna a view salario
    case '/salario':
        $route->exec($url, 'index', $url);
        break;

        //retorna a view de custos fixos
    case '/fixos':
        $route->exec($url, 'index', $url);
        break;

        //retorna a view de custos variaveis
    case '/variaveis':
        $route->exec($url, 'index', $url);
        break;

        //retorna a soma de todos os custos
    case '/costs/all':
        echo $route->exec($url, 'showSumAll');
        break;

        //retorna o percentual dos custos sobre salario de cada mes
    case '/costs/percent':
        echo  $route->exec($url, 'showPercentAll');
        break;

        //retorna todos os custos variaveis
    case '/costs/variables':
        echo  $route->exec($url, 'showVariables');
        break;

        //retorna a soma dos custos variaveis agrupados por mes    
    case '/costs/variables/sum':
        echo  $route->exec($url, 'showSumVariables');
        break;

        //retorna todos os custos fixos
    case '/costs/fixed':
        echo  $route->exec($url, 'showFixeds');
        break;

        //retorna a soma dos custos fixo agrupados por mes
    case '/costs/fixed/sum':
        echo  $route->exec($url, 'showSumFixeds');
        break;

        //retorna a soma dos salarios agrupados por mes
    case '/salario/sum':
        echo  $route->exec($url, 'showSumAll');
        break;

        //retorna todos os salrios
    case '/money':
        echo  $route->exec($url, 'showAll');
        break;

        //deleta salario
    case '/money/delete':
        echo $_REQUEST['id'];
        $route->exec($url, 'delete', $_REQUEST['id']);
        break;

        //deleta custo
    case '/costs/delete':
        $route->exec($url, 'delete', $_REQUEST['id']);
        ($_REQUEST['type'] == 'fixed')? Redirect::run('/fixos'):Redirect::run('/variaveis');
        break;
    default:
        echo "Error 404 - Not found!";
        break;
}


<?php
/**
 * Arquivo responsavel por tratar as requisições
 * e encaminhar as solicitações do view para o controller
 */

use App\Controller\CostController;
use App\Controller\MoneyController;
use App\Controller\UserController;

$cost = new CostController;
$money = new MoneyController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    switch ($_SERVER['REDIRECT_URL']) {
        //edita os dados do usuario
        case '/edit/profile':
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'img' => $_FILES['img']
            ];

            $user = new UserController;
            $user->update($data);
            header("Location: /home");
            break;
        //cadastra um novo custo
        case '/costs/store':

            $data = [
                'id_user' => $_POST['id_user'],
                'type' => $_POST['type'],
                'date' => str_replace('/', '-', $_POST['date']),
                'value' => str_replace(',', '.', $_POST['value']),
                'description' => $_POST['description'],
            ];

            $cost->store($data);

            if ($_POST['type'] == 'variables') {
                header("Location: /variaveis");
            } else {
                header("Location: /fixos");
            }
            break;

        //cadastra um novo salario    
        case '/money/store':
            $data = [
                'id_user' => $_POST['id_user'],
                'origem' => $_POST['origem'],
                'description' => $_POST['description'],
                'value' => str_replace(',', '.', $_POST['value']),
                'date' => str_replace('/', '-', $_POST['date']),
            ];
            $money->store($data);
            header("Location: /salario");
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

    switch ($_SERVER['REDIRECT_URL']) {
        //retorna a soma de todos os custos
        case '/costs/all':
            echo $cost->showSumAll();
            break;

        //retorna o percentual dos custos sobre salario de cada mes
        case '/costs/percent':
            echo $cost->showPercentAll();
            break;

        //retorna todos os custos variaveis
        case '/costs/variables':
            echo $cost->showVariables();
            break;

        //retorna a soma dos custos variaveis agrupados por mes    
        case '/costs/variables/sum':
            echo $cost->showSumVariables();
            break;

        //retorna todos os custos fixos
        case '/costs/fixed':
            echo $cost->showFixeds();
            break;

        //retorna a soma dos custos fixo agrupados por mes
        case '/costs/fixed/sum':
            echo $cost->showSumFixeds();
            break;

        //retorna a soma dos salarios agrupados por mes
        case '/salario/sum':
            echo $money->showSumAll();
            break;

        //retorna todos os salrios
        case '/money':
            echo $money->showAll();
            break;
        
        //deleta salario
        case '/money/delete':
            $id = explode("=", $_SERVER['QUERY_STRING']);
            $money->delete($id[1]);
            break;
            
        //deleta custo
        case '/costs/delete':
            $id = explode("=", $_SERVER['QUERY_STRING']);
            $cost->delete($id[1]);
            break;
    }
}

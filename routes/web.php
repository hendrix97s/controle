<?php

use App\Controller\CostController;
use App\Controller\MoneyController;
use App\Controller\UserController;
use App\Helpers\Debug;

$cost = new CostController;
$money = new MoneyController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    switch ($_SERVER['REDIRECT_URL']) {
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
        case '/costs/all':
            echo $cost->showSumAll();
            break;


        case '/costs/percent':
            echo $cost->showPercentAll();
            break;

        case '/costs/variables':
            echo $cost->showVariables();
            break;

        case '/costs/variables/sum':
            echo $cost->showSumVariables();
            break;

        case '/costs/fixed':
            echo $cost->showFixeds();
            break;

        case '/costs/fixed/sum':
            echo $cost->showSumFixeds();
            break;

        case '/salario/sum':
            echo $money->showSumAll();
            break;

        case '/money':
            echo $money->showAll();
            break;
        case '/money/delete':
            $id = explode("=", $_SERVER['QUERY_STRING']);
            $money->delete($id[1]);
            break;
        case '/costs/delete':
            $id = explode("=", $_SERVER['QUERY_STRING']);
            $cost->delete($id[1]);
            break;
    }
}

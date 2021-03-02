<?php
/**
 * Retorna todas as rotas e seus respectivos controllers
 */
use App\Controller\CostController;
use App\Controller\MoneyController;
use App\Controller\UserController;

return $routes = [
    '/edit/profile'         => UserController::class,
    '/home'                 => MoneyController::class,
    '/salario'              => MoneyController::class,
    '/salario/sum'          => MoneyController::class,
    '/money'                => MoneyController::class,
    '/money/store'          => MoneyController::class,
    '/money/delete'         => MoneyController::class,
    '/fixos'                => CostController::class,
    '/variaveis'            => CostController::class,
    '/costs/store'          => CostController::class,
    '/costs/all'            => CostController::class,
    '/costs/all'            => CostController::class,
    '/costs/percent'        => CostController::class,
    '/costs/variables'      => CostController::class,
    '/costs/variables/sum'  => CostController::class,
    '/costs/fixed'          => CostController::class,
    '/costs/fixed/sum'      => CostController::class,
    '/costs/delete'         => CostController::class,
];

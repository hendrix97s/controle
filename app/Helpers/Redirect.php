<?php

namespace App\Helpers;

/**
 * redireciona a aplicação para a rota indormada
 */
class Redirect
{
    //executa o redirecionamento para a pagina referenciada
    public static function run(string $route):void
    {
        header("Location: $route");
    }
    
}

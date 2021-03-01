<?php

namespace App\Helpers;

/**
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * classe helper para debug
 */
class Debug
{
    /**
     * Methodo responsavel por exibir a mensafem a ser debugada
     *
     * @param   $message  qualquer tipo de variavel para debug
     *
     * @return  void 
     */
    public static function show($message):void{
        if($_ENV['DEBUG'] == 'true'){
            echo "<pre>";
            print_r($message);
            echo "</pre>";
        }
    }
}

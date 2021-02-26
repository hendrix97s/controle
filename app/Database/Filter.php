<?php

namespace App\Database;

/**
 * [Filter responsavel por filtrar o parametro para evitar sql injection]
 */

class Filter
{
    protected static function run(string $data):string{
        //remove palavras reservadas
        $data = preg_replace('/(from|select|insert|delete|where|WHERE|drop table|show tables|#|\*| |\\\\)/i', ' ',$data);
        $data = strtolower($data);//converte caracteres da string em minusculos
        $data = trim($data); //remove espaço no inicio e fim da string
        $data = strip_tags($data); //remove tags PHP e HTML da string
        $data = addslashes($data); //adciona barras invertidas nas aspas

        return $data;
    }
}

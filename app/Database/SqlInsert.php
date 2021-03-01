<?php

namespace App\Database;

/**
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * Classe Trait responsavel pela construção de instruções SQL
 * para Inserir ou atualizar dados no database
 */
trait SqlInsert 
{
    /**
     * methodo responsavel por gerar o SQL para inserção
     *
     * @param   string  $table  nome da tabela cujo sera inserido os dados
     * @param   array   $data   fillable para validação no prepare do PDO
     *
     * @return  string retorna o sql construido
     */
    private function runConstructInsert(string $table, array $data):string{

        $c = count($data);
        $index = 0;

        $colunms = '';
        $values = '';

        foreach ($data as $key) {
            if($index == 0){
                $colunms .= "($key";
                $values .= "(:$key"; 
            }

            if($index > 0 && $index < $c){
                $colunms .= ",$key";
                $values .= ",:$key";

            }

            if($index == $c -1){
                $colunms .= ")";
                $values .= ")";
            }

            $index ++;
        }

        $sql = "INSERT INTO $table ".$colunms." VALUES ".$values;
        return $sql;
    }

    /**
     * Methodo responsavel por construi a instrução SQL para atualização de dados no database
     *
     * @param   string  $table      nome da tabela cujo sera atualizado os dados
     * @param   array   $request    dados para atualização
     * @param   string  $condition  condição para atualização dos dados (ex: where id=5)
     *
     * @return  string retorna a instrução SQL construida
     */
    private function runConstructUpdate(string $table, array $request, string $condition):string{

        $c = count($request);
        $index = 0;

        $values = '';

        foreach ($request as $key => $value) {
            if($index == 0){
                $values .= "$key = :$key"; 
            }

            if($index > 0 && $index < $c){
                $values .= " ,$key = :$key";

            }

            if($index == $c -1){
                $values .= "";
            }

            $index ++;
        }

        $sql = "UPDATE $table SET ".$values.$condition;
        return $sql;
    }



    
}

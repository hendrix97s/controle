<?php

namespace App\Database;


trait SqlInsert 
{
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
        // print_r($sql);
        return $sql;
    }

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
        // print_r($sql);
        return $sql;
    }



    
}

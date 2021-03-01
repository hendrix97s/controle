<?php

namespace App\Helpers;

class UploadImage
{
    public static function run(array $data):string{
        $dir = __DIR__."/../../public/img/";
        $ext = explode('/',$data['type']) ;
        $nameImg =  'profile.'.$ext[1];
        $uploadImage = $dir.$nameImg;

        if(!move_uploaded_file($data['tmp_name'],$uploadImage)){
            echo "Falha ao fazer upload de imagem!";
        }

        return $nameImg;
    }

}

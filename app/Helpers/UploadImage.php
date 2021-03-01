<?php

namespace App\Helpers;

/**
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * Classe helper responsavel por fazer upload de imagem
 */
class UploadImage
{
    /**
     * Methodo responsavel por tratar e efetuar o upload de imagem
     *
     * @param   array   $data  dados da imagem a ser armazenada
     *
     * @return  string  retorna o nome do arquivo para ser armazenado no banco de dados
     */
    public static function run(array $data):string{
        $dir = __DIR__."/../../public/img/";//diretorio de armazenamento
        $ext = explode('/',$data['type']);//pega extenção do arquivo para concatenar no nome
        $nameImg =  'profile.'.$ext[1];//gera nome do arquivo
        $uploadImage = $dir.$nameImg;//concatena nome do arquivo com diretorio de armazenamentos

        //verifica se houve falha no upload
        if(!move_uploaded_file($data['tmp_name'],$uploadImage)){
            echo "Falha ao fazer upload de imagem!";
            exit;//para execução
        }

        return $nameImg;
    }

}

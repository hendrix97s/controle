<?php

namespace App\Controller;

use App\Helpers\UploadImage;
use App\Model\User;

class UserController
{
    private $user;
    
    public function __construct()
    {
        $this->user = new User;
    }
    /**
     * Methodo responsavel por cadastrar um novo usuario
     *
     * @param   array  $request  contem os dados para cadastro do usuario
     *
     * @return  void
     */
    public function store(array $request):void{
        $this->user->store($request);
    }

    /**
     * responsavel por retornar os dados do respectivo usuario
     *
     * @param   int  $id indice do usuario
     *
     * @return  object  retorna um objeto com os dados do respectivo usuario
     */
    public function show(int $id):object{
        return (object) $this->user->find($id);
    }


    /**
     * Methodo responsavel por efetuar a atualização de registro do usuario
     *
     * @param   array  $request  recebe os dados para atualização
     *
     * @return  void
     * 
     * @link
     */
    public function update(array $request):void{
        echo "<pre>";
        $request['img'] = UploadImage::run($request['img']);
        print_r($request);
        echo "</pre>";
        $this->user
        ->where('id','=','1')
        ->update($request);
    }

}

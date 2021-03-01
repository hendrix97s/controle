<?php

namespace App\Controller;

use App\Helpers\UploadImage;
use App\Model\Cost;
use App\Model\MoneyInput;
use App\Model\User;

class UserController
{
    private $user;
    private $cost;
    private $money;
    
    public function __construct()
    {
        $this->user = new User;
        $this->cost = new Cost;
        $this->money = new MoneyInput;
    }

    public function store(array $request){

        return $this->user->store($request);
    }

    public function show($id):object{

        return (object) $this->user->find($id);
    }

    public function showAll()
    {
    }

    public function update(array $request):object{
        echo "<pre>";
        $request['img'] = UploadImage::run($request['img']);
        print_r($request);
        echo "</pre>";
        $this->user
        ->where('id','=','1')
        ->update($request);

        return (object) [];
    }

    public function delete($id):void{

    }
}

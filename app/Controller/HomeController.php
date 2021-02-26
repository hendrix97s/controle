<?php

namespace App\Controller;

use App\Helpers\Debug;
use App\Model\Teste;

class HomeController
{
    

    public function __construct(){
    
    }

    public function index($id):object{
        try {

            $teste = new Teste();
            return $teste->where("id","=","")->find($id);
            
        } catch (\Exception $th) {
            Debug::show($th->getMessage());
        }
    }
}

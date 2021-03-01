<?php

namespace App\Controller;

use App\Model\MoneyInput;

class MoneyController
{
    private $money;
    
    public function __construct()
    {
        $this->money = new MoneyInput;
    }

    public function store(array $request){

        return $this->money->store($request);
    }

    public function show($id):object{
        return $this->money->find($id);
    }

    public function showAll():string{
        $json = $this->money->all();
        return json_encode($json);
    }

    public function showSumAll():string{
        $json = $this->money->sumOfMonth();
        return json_encode($json);
    }


    public function update($request):object{
        

        return (object) [];
    }

    public function delete($id):void{
        $this->money->where('id','=',$id)->delete();
    }
}

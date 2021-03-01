<?php

namespace App\Controller;

use App\Helpers\Debug;
use App\Model\Cost;
use App\Model\MoneyInput;

class CostController
{
    private $cost;
    private $money;
    
    public function __construct()
    {
        $this->cost = new Cost;
        $this->money = new MoneyInput;
    }

    public function store(array $request){

        return $this->cost->store($request);
    }

    public function show($id):object{

        return $this->cost->find($id);
    }

    public function showAll():string
    {
        $json = json_encode($this->cost->all());
        return $json;
    }

    public function showFixeds():string{
        $r = $this->cost->where('type','=','fixed')->month()->all();
        return json_encode($r);
    }

    public function showSumFixeds():string{
        $json = $this->cost->where('type','=','fixed')->sumOfMonth();
        return json_encode($json);
    }


    public function showSumVariables():string{
        $json = $this->cost->where('type','=','variables')->sumOfMonth();
        return json_encode($json);
    }

    public function showSumAll():string{
        $json = $this->cost->sumOfMonth();
        return json_encode($json);
    }

    public function showPercentAll():string
    {
        $cost = $this->cost->sumOfMonth();
        $money = $this->money->sumOfMonth();
        $json = [];
        
        foreach ($cost as $kc => $vc) {
            foreach ($money as $km => $vm) {
                if($vm->month == $vc->month){
                    $percent = ($vc->sum / $vm->sum) *100;
                    array_push($json, ['month'=>$vm->month, 'sum'=>$percent]);
                }
            }
        }
        return json_encode($json);
    }

    public function showVariables():string{
        $r = $this->cost->
        where('type','=','variables')
        ->all();

        return json_encode($r);
    }

    public function update($request):object{
        

        return (object) [];
    }

    public function delete($id):void{
        $this->cost->where('id','=',$id)->delete();
    }
}

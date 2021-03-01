<?php

namespace App\Controller;

use App\Model\Cost;
use App\Model\MoneyInput;
use App\Database\Filter;
/**
 *  Classe controle responsavel pelas operações de custos
 * @author Luiz Lima <luiz.lima@wapstore.com.br> 
 */
class CostController
{
    private $cost;
    private $money;
    
    public function __construct()
    {
        $this->cost = new Cost;
        $this->money = new MoneyInput;
    }

    /**
     * responsave por inserir o registro de custo no banco de dados
     *
     * @param   array  $request  dados para registro no banco de dados
     *
     * @return  void
     * 
     * @link /costs/store
     */
    public function store(array $request):void{
        $this->cost->store($request);
    }

    /**
     * responsavel por retornar um unico registro referente ao parametro
     *
     * @param   int     $id  indice do custo 
     *
     * @return  object       retorna um objeto de custo
     * 
     */
    public function show(int $id):object{
        return $this->cost->find($id);
    }

    /**
     * responsavel por retornar todos os registros de custos fixos
     *
     * @return  string  retorna um objeto json com todos os custos fixos
     * 
     * @link  /costs/fixed
     */
    public function showFixeds():string{
        $r = $this->cost->where('type','=','fixed')->month()->all();
        return json_encode($r);
    }

    /**
     * responsavel por retornar a soma de todos custos fixos agrupados por mes
     *
     * @return  string  retorna um objeto json de soma de custos fixos agrupados por mes
     * 
     * @link /costs/fixed/sum
     */
    public function showSumFixeds():string{
        $json = $this->cost->where('type','=','fixed')->sumOfMonth();
        return json_encode($json);
    }

    /**
     * retorna a soma de todos os custos variaveis agrupados por mes
     *
     * @return  string  retorna um objeto json com a soma dos custos
     * variaveis agrupados por mes
     * @link /costs/variables/sum
     */
    public function showSumVariables():string{
        $json = $this->cost->where('type','=','variables')->sumOfMonth();
        return json_encode($json);
    }

    /**
     * retorna a soma de todos os custos gerais e variaveis
     * agrupados por mes
     *
     * @return  string  retorna um objeto json com
     * @link  /salario/sum
     */
    public function showSumAll():string{
        $json = $this->cost->sumOfMonth();
        return json_encode($json);
    }

    /**
     * efetua o calculo percentual dos custos gerais 
     * sobre o salario total agrupados por mes
     *
     * @return  string  retorna um objeto json com os percentuais agru-
     * pados por mes
     * 
     * @link /costs/percent
     */
    public function showPercentAll():string{
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

    /**
     * responsavel por retornar um objeto json com todos 
     * os custos variaveis
     *
     * @return  string  retorna json de custos variaveis
     * @link /costs/variables
     */
    public function showVariables():string{
        $r = $this->cost->where('type','=','variables')->all();
        return json_encode($r);
    }

    /**
     * responsavel por deletar custo
     *
     * @param   int  $id  [$id id do custo a ser deletado]
     *
     * @return  void   
     * @link /costs/delete      
     */
    public function delete(int $id):void{

        $id = Filter::run($id);
        $this->cost->where('id','=',$id)->delete();
    }
}

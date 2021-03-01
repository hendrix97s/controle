<?php 
namespace App\Config;

/**
 * @author Luiz Lima <luiz.lima@wapstore.com.br>
 * classe responsavel por tratar as requisições
 */
class Route{
    private array $routes;

    public function __construct(){
   
        $this->routes = include_once __DIR__.'/config.php';
    }
    /**
     * monta as requisições
     *
     * @param   string  $url     rota 
     * @param   string  $method  metodo da classe que sera montada
     * @param   null            
     * @param   $data    dados a serem processados
     *
     */
    public function exec(string $url, string $method, $data = null){
        if($data == null){
           return $this->instanceClass($url)->$method();
        }else{
           return $this->instanceClass($url)->$method($data);
        }
    }
    /**
     * Instancia objeto da classe de acordo com a url 
     *
     * @param   string  $url  rota para ser verifica do array
     *
     * @return  object  retorna o objeto da classe instanciada
     */
    private function instanceClass(string $url):object{
        //verifica se a rota existe
        if(array_key_exists($url,$this->routes)){
            return new $this->routes[$url];
        }
    }
}

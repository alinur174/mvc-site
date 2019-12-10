<?php
class Router
{

    private $routes;

    public function __construct()
    {
        $routesPatch = ROOT . '/config/routes.php';
        $this->routes = include($routesPatch);
    }

    private function getUri()
    {

        if (!empty($_SERVER['REQUEST_URI'])) {
        
            return trim($_SERVER['REQUEST_URI'], '/');
         
           
        }
        
     }

    public function run()
    {
       $uri = $this->getUri();
        

       foreach($this->routes as $uriPattern => $patch){
        //    echo  "<br>$uriPattern->$patch";
            if(preg_match("~$uriPattern~", $uri)){
                
                $segments = explode('/',$patch);
                $controllerName = array_shift($segments). 'Controller';
                $controllerName = ucfirst($controllerName);
                // echo $controllerName;

                // echo '<br>';
              
                $actionName = 'action'. ucfirst(array_shift($segments));
                // echo $actionName;


                $controllerFile = ROOT . '/controllers/'. $controllerName . '.php';

                if(file_exists($controllerFile)){ include_once($controllerFile); }

                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if($result != null){ break; }
            }

       }
       
    }
}

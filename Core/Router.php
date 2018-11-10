<?php
namespace Core ;
class Router
{

//  * Associative array of routes (the routing table)
    protected $routes = [];

//  * Parameters from the matched route
    protected $params = [];


//     * Add a route to the routing table*
//     * @param string $route  The route URL
//     * @param array  $params Parameters (controller, action, etc.)
    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([a-z]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

//     * Get all the routes from the routing table
    public function getRoutes()
    {
        return $this->routes;
    }


//     * Match the route to the routes in the routing table, setting the $params
//     * property if a route is found.
    public function match($url)
    {
        // Match to the fixed URL format /controller/action
        //$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                //$params = [];

                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;
                return true;
            }
        }

        return false;
    }

//  * Get the currently matched parameters

    public function getParams()
    {
        return $this->params;
    }
    public function dispatch($url){
        $rmQ = $this->RemoveQueryVar($url) ;
        if($this->match($rmQ)){
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller ;
            if(class_exists($controller)){
                $controller_obj = new $controller($this->params) ;
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
                if(is_callable([$controller_obj,$action])){
                    $controller_obj->$action() ;
                }else{
                    echo "$action not found";
                }
            }else{
                echo "$controller not found";
            }
        }else{
            echo 'No Route matched';
        }
    }
    private function RemoveQueryVar($url){
        $parts = explode('&',$url,4);
        if(!strpos($parts[0],'=')){
            $url = $parts[0];
        }else{
            $url = '';
        }
        return $url;
    }
    private function getNamespace(){
        $namespace = 'App\Controllers\\';
        if(array_key_exists('namespace',$this->params)){
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace ;
    }

    public function convertToStudlyCaps($string){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }
    public function convertToCamelCase($string){
        return lcfirst(str_replace(' ','',ucwords(str_replace('-',' ',$string)))) ;
    }


















    //    public function test($num){
//        echo $num ;
//    }


}

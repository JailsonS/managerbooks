<?php
namespace core;

use \src\Config;

class RouterBase 
{
    public function run($routes)
    {
        # get url and type of method
        $method = Request::getMethod();
        $url = Request::getUrl();

        # default params
        $controller = Config::ERROR_CONTROLLER;
        $action = Config::DEFAULT_ACTION;
        $args = [];

        # check routes
        if(isset($routes[$method])){
            foreach($routes[$method] as $route => $callback){
                # indentify a pattern of route
                $pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $route);

                # match pattern and route
                if(preg_match('#^('.$pattern.')*$#i', $url, $matches) === 1){
                    array_shift($matches);
                    array_shift($matches);

                    # Pega todos os argumentos para associar
                    $items = [];
                    if(preg_match_all('(\{[a-z0-9]{1,}\})', $route, $m)) {
                        $items = preg_replace('(\{|\})', '', $m[0]);
                    }

                    # Faz a associação
                    $args = [];
                    foreach($matches as $key => $match) {
                        $args[$items[$key]] = $match;
                    }

                    # define controller e action
                    $callbackSplit = explode('@', $callback);
                    $controller = $callbackSplit[0];
                    
                    if(isset($callbackSplit[1])) {
                        $action = $callbackSplit[1];
                    }

                    break;
                }
            }
        }

        $controller = "\src\controllers\\$controller";
        $definedController = new $controller();
        $definedController->$action($args);

    }
}
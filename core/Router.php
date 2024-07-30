<?php

namespace core;

use core\Response;
use core\middleware\Middleware;

class Router {

    protected $routes = [];

    public function add($uri, array $controller, $method)
    {
        $controller_name = $controller[0];
        $action = $controller[1];

        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller_name,
            'action' => $action,
            'method' => $method,
            'middleware' => null
        ];


        return $this;
    }

    public function get($uri, array $controller)
    {
        return $this->add(Response::PROOT . $uri, $controller, 'GET');
    }

    public function post($uri, array $controller)
    {
        return $this->add(Response::PROOT . $uri, $controller, 'POST');

    }

    public function delete($uri, array $controller)
    {
       return $this->add(Response::PROOT . $uri, $controller, 'DELETE');

    }

    public function patch($uri, array $controller)
    {
       return $this->add(Response::PROOT . $uri, $controller, 'PATCH');

    }

    public function put($uri, array $controller)
    {
       return $this->add(Response::PROOT . $uri, $controller, $method);

    }

    public function only($key) {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;

    }

    public function route($uri, $method)
    {
        
        foreach($this->routes as $route) {

            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                
                Middleware::resolve($route['middleware']);

                $dispatch = new $route['controller']($route['controller'], $route['action']);

                return method_exists($route['controller'], $route['action']) ? call_user_func([$dispatch, $route['action']]) : null;
            
                

                // return require base_path('Http/controller/' .$route['controller']);
            }

        }

        // abort the request
        $this->abort();
    }

    public function previousUrl()
    {
        return $_SERVER["HTTP_REFERER"];
    }

    protected function abort($code = Response::NOT_FOUND)
    {
        http_response_code($code);
        require base_path("view/http_response/{$code}.php");
        
        die();

    }
}



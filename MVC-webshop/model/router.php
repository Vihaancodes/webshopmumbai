<?php


class Router {
  
    /**
     * runs the router
     *
     * @return void
     */
    public function run() {

        $uri = $_SERVER['REQUEST_URI']; 
        $uri = str_replace(HTTP_DIR, '', $uri);
        $uri = trim($uri, '/'); // HomeController/home
        $parts = explode('/', $uri); 

        $controller = $parts[0]; 
        $method = $parts[1] ?? 'home'; 
        if(empty($controller)) {
            $controller = 'HomeController';
        }

        $params = array_slice($parts, 2); // get params from parts remove first 2 from parts

        $file = ROOT . '/controller/' . $controller . '.php'; 

        include_once $file; // include the controller file

        $cont = new $controller(); 

        if(!method_exists($cont, $method)) {
            $method = 'home';
        }

        call_user_func_array([$cont, $method], $params); // call the $method on the controller with the params

    }

}
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author CMatecki
 */
Class Router {

    public static function route(Request $request) {


        $route = new Route();


        $route = $route->getByRouteName(ltrim($request->getRequestpath(), '/'));

        $path = "";
        if ($route != null) {
            $controllerName = $route[0]->getController();
            $controller_part = explode("_", $controllerName);
            $method = ($route[0]->getAction() == "") ? "indexAction" : $route[0]->getAction() . "Action";


            //   $path = $route[0]->getPath();
            $parts = explode("/", $route[0]->getArgs());
            $arguments = array();
            $i = 0;
            $currentKey;
            foreach ($parts as $key => $val) {

                if ($i % 2 == 0) {
                    $currentKey = $val;
                }


                $arguments[$currentKey] = $val;

                $i++;
            }
            $args = $arguments;

            $request->setArgs($args);
        } else {
            $controllerName = $request->getController();
            $controller_part = explode("_", $request->getController());


            $newname = explode('?', $request->getMethod());

            $method = (count($newname) > 1) ? $newname[0] . "Action" : $request->getMethod() . "Action";

            $args = $request->getArgs();
        }


        if (count($controller_part) > 1) {
            $controller = ucfirst($controller_part[0]) . '_' . ucfirst($controller_part[1]) . 'Controller';
            $controllerFileName = ucfirst($controller_part[1]) . 'Controller';
            $folder = $controller_part[0] . "/";
        } else {
            $folder = "";


            $controller = ucfirst($controllerName) . 'Controller';
            $controllerFileName = $controller;
        }



        $controllerFile = $GLOBALS['ROOTPATH'] . '/controllers/' . $path . $folder . '' . $controllerFileName . '.php';


        if (is_readable($controllerFile)) {


            $controller = new $controller;

            $controller->init();

            if (!empty($args)) {
                $controller->args = $args;
            }


            call_user_func(array($controller, $method));


            $controller->render();

            return;
        }



  /*/      header('HTTP/1.0 404 Not Found');
        include('404.html');
        exit;*/
        header('HTTP/1.0 404 Not Found');
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found."
        . "named:" . $controllerName . "<br>"
        . "method: " . $method . "<br>"
        . "filename: " . $controllerFileName . "<br>";
//        exit();

        throw new Exception('404 - ' . $request->getController() . ' --Controller not found');
    }

}

?>

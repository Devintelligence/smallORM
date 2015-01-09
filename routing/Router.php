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
        $route = $route->getByRouteName($request->getController());

        if ($route != null) {
            $controllerName = $route[0]->getController();
            $controller_part = explode("_", $controllerName);
            $method = $route[0]->getAction();

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
            $method = $request->getMethod();

            $newname = $request->getMethod();

            $newname = explode('?', $newname);

            $method = $newname[0];

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



        $controllerFile = $GLOBALS['ROOTPATH'] . '/controllers/' . $folder . '' . $controllerFileName . '.php';



        if (is_readable($controllerFile)) {

            require_once $controllerFile;
            $controller = new $controller;

            $controller->init();

            if (!empty($args)) {
                call_user_func_array(array($controller, $method), $args);
            } else {
                call_user_func(array($controller, $method));
            }

            $controller->render();

            return;
        }




        header('HTTP/1.0 404 Not Found');
        echo "<h1>404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();

        throw new Exception('404 - ' . $request->getController() . '--Controller not found');
    }

}

?>

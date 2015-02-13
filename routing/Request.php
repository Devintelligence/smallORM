<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author CMatecki
 */
Class Request {

    private $_controller;
    private $_method;
    private $_args;

    public function __construct() {

        $requestString = $_SERVER['REQUEST_URI'];

        if ($GLOBALS["BASEPATH"] != "/") {
            $controllerString = str_replace($GLOBALS["BASEPATH"], "", $requestString);
        } else {
            $controllerString = $requestString;
        }


        $first_slash = strpos($requestString, '/');

        $second_slash = strpos($requestString, '/', $first_slash);

        $controllerString = substr($requestString, $second_slash + 1);

        $parts = explode('/', $controllerString);


        if ($GLOBALS["BASEPATH"] != "/") {
            if (count($parts) > 1) {
                unset($parts[0]);
            }
        }


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



        $this->_controller = ($c = array_shift($parts)) ? $c : 'index';


        $this->_method = ($c = array_shift($parts)) ? $c : 'index';

        $this->_args = (count($arguments) > 0) ? $arguments : array();
    }

    public function getController() {

        return $this->_controller;
    }

    public function getMethod() {

        return $this->_method;
    }

    public function getArgs() {

        return $this->_args;
    }

    public function setArgs($args) {

        $this->_args = $args;
    }

}

?>

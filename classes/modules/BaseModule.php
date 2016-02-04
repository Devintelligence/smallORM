<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseModule
 *
 * @author christopher.matecki
 */
class BaseModule implements IModule {

    protected $name;
    protected $templateFolder;
    protected $smarty;
    protected $view;

    public function __construct() {

        $this->view->this = $this;
        $this->smarty = new Smarty();
        $this->smarty->caching = 0;
        $this->smarty->cache_lifetime = 120;
    }

    public function init() {
        
    }

    public function render($action) {
        if ($this->view != null) {
            foreach ($this->view as $param => $value) {
                $this->smarty->assign($param, $value);
            }
        }

        $val = $this->smarty->fetch('modules/' . $this->name . '/' . $action . '.tpl');

        
        return $val;
    }

  

//put your code here
}

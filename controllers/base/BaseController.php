<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of baseController
 *
 * @author CMatecki
 */
include $GLOBALS['ROOTPATH'] . '/rendering/renderer.php';

class BaseController {

    public $view;
    public $template;
    public $args;
    public $ignoreTemplate;
    public $parentLayout;
    public $globalTemplatePath;
    public $controller;
    public $action;

    public function __construct() {
        $this->view = new stdClass();
        $request = new Request();
        $route = new Route();
        $route = $route->getByRouteName($request->getController());
        if ($route != null) {
            $this->controller = $route[0]->getController();
            $template_name = $route[0]->getAction();
            $this->action = $route[0]->getAction();
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
            $this->args = $arguments;
        } else {
            $this->controller = $request->getController();
            $this->action = $request->getMethod();
            $newname = $request->getMethod();
            $newname = explode('?', $newname);
            $template_name = $newname[0];
            $this->args = $request->getArgs();
        }
        $folder = str_replace("Controller", "", lcfirst(get_class($this))) . "";
        $splitted = explode("_", strtolower($folder));
        if (count($splitted) > 1) {
            $this->template = $this->globalTemplatePath . "/" . $splitted[0] . "/" . $splitted[1] . "/" . $template_name;
        } else {
            $this->template = $this->globalTemplatePath . "/" . $folder . "/" . $template_name;
        }
        if ($this->ignoreTemplate == null) {
            $this->ignoreTemplate = false;
        }
    }

    public function init() {
        $this->parentLayout = "layout";
        $this->globalTemplatePath = "default";
        if (isset($_SESSION["appid"])) {
            $template = new Template();
            $template = $template->customSelectQuery("SELECT SQL_CACHE * FROM " . $template->getTable() . " WHERE applicationId=" . $_SESSION["aid"]);
            $this->application = new Application();
            $this->application = $this->application->getById($_SESSION["appid"]);
            $this->parentLayout = $this->application->getLayout();
            $this->view->metaScreenwidth = '';
            $this->globalTemplatePath = $template[0]->getPath();
        }
    }

    public function render() {
        $renderer = new Renderer();
        $renderer->setParams($this->view);
        $renderer->setIgnoreTemplate($this->ignoreTemplate);
        $renderer->setTemplate($this->template);
        $renderer->setParentLayout($this->parentLayout);
        $renderer->setGlobalTemplatePath($this->globalTemplatePath);
        $renderer->render();
    }

    public function forward($action, $args) {
        return $GLOBALS["BASEPATH"] . $this->controller . "/" . $action . "/" . $args;
    }

    public function forwardController($controller, $action, $args) {
        return $GLOBALS["BASEPATH"] . $controller . "/" . $action . "/" . $args;
    }

}

?>

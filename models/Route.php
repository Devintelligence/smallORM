<?php

/**
 * Description of Route
 *
 * @author CMatecki
 */
class Route extends BaseModel {

    protected $routeId, $name, $controller, $action, $args, $applicationId;

    function __construct() {
        parent::__construct();

        $this->setTable("route");
        $this->setPrimaryColumn("routeId");
    }

    public function getApplicationId() {
        return $this->applicationId;
    }

    public function setApplicationId($applicationId) {
        $this->applicationId = $applicationId;
    }

    public function getApplication() {
        $model = new Application();
        return $this->getForeign($model, $this->applicationId);
    }

    public function getRouteId() {
        return $this->routeId;
    }

    public function getName() {
        return $this->name;
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getArgs() {
        return $this->args;
    }

    public function setRouteId($routeId) {
        $this->routeId = $routeId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function setArgs($args) {
        $this->args = $args;
    }

    public function getByRouteName($name) {
        return $this->customSelectQuery("SELECT * FROM route WHERE name ='" . $name . "'");
    }

}

?>

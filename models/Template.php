<?php

/**
 * Description of Template
 *
 * @author christopher.matecki
 */
class Template extends BaseModel {

    protected $templateId, $name, $applicationId, $path;

    function __construct() {
        parent::__construct();

        $this->setTable("template");
        $this->setPrimaryColumn("templateId");
    }

    public function getTemplateId() {
        return $this->templateId;
    }

    public function setTemplateId($templateId) {
        $this->templateId = $templateId;
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

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    function getPath() {
        return $this->path;
    }

    function setPath($path) {
        $this->path = $path;
    }

}

<?php

/**
 * Description of Application
 *
 * @author christopher.matecki
 */
class Application extends BaseModel {

    protected $applicationId, $name, $url, $layout, $css, $language;

    function __construct() {
        parent::__construct();

        $this->setTable("application");
        $this->setPrimaryColumn("applicationId");
    }

    public function getApplicationId() {
        return $this->applicationId;
    }

    public function getName() {
        return $this->name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setApplicationId($applicationId) {
        $this->applicationId = $applicationId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function getLayout() {
        return $this->layout;
    }

    public function getCss() {
        return $this->css;
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function setCss($css) {
        $this->css = $css;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function setLanguage($language) {
        $this->language = $language;
    }
    
    public function getAbsoluteUrl()
    {
        if($this->applicationId == 1)
        {
            return "meinecoke.de/bundesliga/";
        }
    }

}

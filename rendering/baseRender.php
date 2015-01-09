<?php

/**
 * Description of baseRender
 *
 * @author CMatecki
 */
//include_once 'Smarty/Smarty.class.php';

class baseRender {

    protected $smarty;
    protected $view;
    protected $params;
    protected $template;
    protected $ignoreTemplate;
    protected $globalTemplatePath;
    protected $parentLayout;

    public function __construct() {
        $this->smarty = new Smarty();
        $this->smarty->caching = 0;
        $this->smarty->cache_lifetime = 120;
    }

    public function render() {
        if ($this->params != null) {
            foreach ($this->params as $param => $value) {
                $this->smarty->assign($param, $value);
            }
        }
        $this->smarty->assign("BASEPATH", $GLOBALS["BASEPATH"]);

        if ($this->smarty->templateExists(dirname('.') . '/templates/' . $this->globalTemplatePath . '/' . $this->template . '.tpl')) {

            if ($this->getParentLayout() != null) {
              
                echo(
                str_replace("###content###", $this->smarty->fetch($this->globalTemplatePath . '/' . $this->template . '.tpl'), $this->smarty->fetch(dirname('.') . "/layouts/" . $this->getParentLayout() . ".tpl"))
                );
            } else {
            
                $this->smarty->display($this->globalTemplatePath . '/' . $this->template . '.tpl');
            }
        } else if ($this->ignoreTemplate) {
            
        } else {
            
           // throw new SmartyException("Template not found" . $this->globalTemplatePath . '/' . $this->template);
        }
    }

    public function setTemplate($template) {
        $this->template = $template;
    }

    public function getTemplate($template) {
        return $this->template;
    }

    public function setParams($params) {

        $this->params = $params;
    }

    public function getParams($params) {
        return $this->params;
    }

    public function setIgnoreTemplate($ignore) {
        $this->ignoreTemplate = $ignore;
    }

    public function getIgnoreTemplate() {
        return $this->ignoreTemplate;
    }

    public function setParentLayout($layout) {
        $this->parentLayout = $layout;
    }

    public function getParentLayout() {
        return $this->parentLayout;
    }

    public function getGlobalTemplatePath() {
        return $this->globalTemplatePath;
    }

    public function setGlobalTemplatePath($globalTemplatePath) {
        $this->globalTemplatePath = $globalTemplatePath;
    }

}

?>

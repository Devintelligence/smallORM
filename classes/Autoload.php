<?php

/**
 * Description of Autoload
 *
 * @author CMatecki
 */
class Autoload {

    public static function load() {
        spl_autoload_register(array('Autoload', 'load_lib'));
        spl_autoload_register(array('Autoload', 'load_models'));
        spl_autoload_register(array('Autoload', 'load_classes'));
        spl_autoload_register(array('Autoload', 'load_classes_secure'));
        spl_autoload_register(array('Autoload', 'load_classes_swift'));
        spl_autoload_register(array('Autoload', 'load_helper'));
        spl_autoload_register(array('Autoload', 'load_base'));
        spl_autoload_register(array('Autoload', 'load_rendering'));
        spl_autoload_register(array('Autoload', 'load_routing'));
        spl_autoload_register(array('Autoload', 'load_controller'));

        spl_autoload_register(array('Autoload', 'load_controllerbase'));
    }

    public static function load_controllerbase($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/controllers/base/" . $class . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/controllers/base/" . $class . '.php');
        return true;
    }

    public static function load_controller($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/controllers/" . $class . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/controllers/" . $class . '.php');
        return true;
    }

    public static function load_routing($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/routing/" . $class . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/routing/" . $class . '.php');
        return true;
    }

    public static function load_rendering($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/rendering/" . $class . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/rendering/" . $class . '.php');
        return true;
    }

    public static function load_base($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/base/" . $class . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/base/" . $class . '.php');
        return true;
    }

    public static function load_classes($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/classes/" . $class . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/classes/" . $class . '.php');
        return true;
    }

    public static function load_classes_secure($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/classes/securimage/" . strtolower($class) . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/classes/securimage/" . strtolower($class) . '.php');
        return true;
    }

    public static function load_classes_swift($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/classes/swift/" . $class . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/classes/swift/" . $class . '.php');
        return true;
    }

    public static function load_helper($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/helper/" . $class . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/helper/" . $class . '.php');
        return true;
    }

    public static function load_models($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/models/" . $class . '.php'))
            return false;
        require_once( $GLOBALS['ROOTPATH'] . "/models/" . $class . '.php');
        return true;
    }

    public static function load_lib($class) {
        if (!file_exists($GLOBALS['ROOTPATH'] . "/rendering/Smarty/Smarty.class.php"))
            return false;
        require_once($GLOBALS['ROOTPATH'] . "/rendering/Smarty/Smarty.class.php");
        return true;
    }

    //put your code here
}

<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('memory_limit', '512M');
ini_set("allow_url_include", 1);

$GLOBALS['BASEPATH'] = '/'; //globalPath
$GLOBALS['ROOTPATH'] = $_SERVER["DOCUMENT_ROOT"] . "" . $GLOBALS['BASEPATH'];



require_once $GLOBALS['ROOTPATH'] . "classes/Autoload.php";


spl_autoload_register(array("Autoload", 'load'));



/*OPTIONAL START*/
if (!isset($_SESSION["aid"])) {

    $url = $_SERVER["HTTP_HOST"] . $GLOBALS['BASEPATH'];
    $helper = new ApplicationHelper();

    $application = $helper->getApplicationByUrl($url);

    $_SESSION["aid"] = $application[0]->getApplicationId();
    $_SESSION["lang"] = $application[0]->getLanguage();
} else {


    $url = $_SERVER["HTTP_HOST"] . $GLOBALS['BASEPATH'];



    $helper = new ApplicationHelper();

    $application = $helper->getApplicationByUrl($url);

    $_SESSION["aid"] = $application[0]->getApplicationId();
    $_SESSION["lang"] = $application[0]->getLanguage();
}

/*OPTIONAL END*/
$request = new Request();

Router::route($request);
?>
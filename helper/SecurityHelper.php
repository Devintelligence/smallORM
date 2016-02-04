<?php

/**
 * Description of ApplicationHelper
 *
 * @author christopher.matecki
 */
class SecurityHelper {

    static function decodePost() {
        $output = "";
        foreach ($_POST as $key => $value) {
            if (!is_array($value)) {
                $output[$key] = SecurityHelper::xss_clean($value);
            }
        }
        return $output;
    }

    static function decodeGet() {
        foreach ($_GET as $key => $value) {
            $output[$key] = SecurityHelper::xss_clean($value);
        }
        return $output;
    }

    static function xss_clean($input) {
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
        );
        $inputx = preg_replace($search, '', $input);
        $inputx = trim($inputx);
        $strip_tags = trim($inputx);
        $inputx = htmlspecialchars($inputx, ENT_QUOTES, 'UTF-8');
        return $inputx;
    }

    static function secCheck() {
        if (!isset($_SESSION["uid"])) {
            SecurityHelper::clearSessionUserdata();
            header('location:' . $GLOBALS['BASEPATH'] . '');
        }
    }
    
    static function setSessioUserData(USER $user) {
        if ($user) {
            $_SESSION["uid"] = $user->getId();
        }
    }

    static function clearSessionUserdata() {
        $_SESSION["uid"] = 0;
        session_unset();
        session_destroy();
    }
}

<?php

$host = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
if (!defined('SERVER_NAME'))
    define('SERVER_NAME', $host);


define('HOST', 'localhost');
define('USER', 'root');
define('HASH', '');
define('DATABASE', 'yourname');
?>
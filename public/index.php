<?php

define('APP_PATH', dirname(__FILE__) . '/../');
// var_dump(APP_PATH . "/conf/application.ini");
require APP_PATH.'/vendor/autoload.php';
$application = new Yaf\Application( APP_PATH . "/conf/application.ini");

$application->bootstrap()->run();
?>

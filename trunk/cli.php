<?php 
define("APPLICATION_PATH",  dirname(__FILE__));

$app = new \Yaf\Application(APPLICATION_PATH . "/conf/application.ini");
//$app->execute('callback', $avg1, $avg2);
$app->bootstrap()->execute('/daemon');


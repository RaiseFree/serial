<?php
define("APPLICATION_PATH",  dirname(__FILE__));

$app = new \Yaf\Application(APPLICATION_PATH . "/conf/application.ini");
\Yaf\Loader::import(APPLICATION_PATH.'/application/library/vendor/autoload.php');
$return = $app->getDispatcher()->dispatch(new \Yaf\Request\Simple());

//example :: php cront.php request_uri="/daemon/start"

<?php
/**
 * This file should be under the APPLICATION_PATH . "/application/"(which was defined in the config passed to Yaf_Application).
 * and named Bootstrap.php,  so the Yaf_Application can find it 
 */
class Bootstrap extends \Yaf\Bootstrap_Abstract {
    public function _initConfig(\Yaf\Dispatcher $dispatcher) {
        //echo "1st called\n";
    }

    public function _initPlugin($dispatcher) {
        //echo "2nd called\n";
    }

    public function _initComposerAutoload(\Yaf\Dispatcher $dispatcher) {
        \Yaf\Loader::import(APPLICATION_PATH.'/application/library/vendor/autoload.php');
    }
}

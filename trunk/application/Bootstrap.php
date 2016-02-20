<?php
/**
 * This file should be under the APPLICATION_PATH . "/application/"(which was defined in the config passed to Yaf_Application).
 * and named Bootstrap.php,  so the Yaf_Application can find it 
 */
class Bootstrap extends \Yaf\Bootstrap_Abstract {
    public function _initConfig(\Yaf\Dispatcher $dispatcher) {
        $config = \Yaf\Application::app()->getConfig();
        \Yaf\Registry::set("config", $config);
    }

    /**
     * @desc  
     * @param  
     * @return  
     */
    public function _initRouter(\Yaf\Dispatcher $dispatcher) 
    {
        \Yaf\Dispatcher::getInstance()->getRouter()->addRoute(
            "episodelista",
            new \Yaf\Route\Regex(
                "#^/list/(\d+)/(\d+)#",
                array('controller' => "index", 'action' => 'list'),
                array(1 => "id", 2 => "season")
            )
        );

        \Yaf\Dispatcher::getInstance()->getRouter()->addRoute(
            "episodelist",
            new \Yaf\Route\Regex(
                "#^/list/(\d+)/(\d+)/(\S+)#",
                array('controller' => "index", 'action' => 'list'),
                array(1 => "id", 2 => "season", 3 => 'order')
            )
        );

        \Yaf\Dispatcher::getInstance()->getRouter()->addRoute(
            "downloadlist",
            new \Yaf\Route\Regex(
                "#^/download/(\d+)#",
                array('controller' => "download", 'action' => 'list'),
                array(1 => "id")
            )
        );

        \Yaf\Dispatcher::getInstance()->getRouter()->addRoute(
            "downloadlist",
            new \Yaf\Route\Regex(
                "#^/download/(\d+)/(\d+)/(\S+)/(\S+)#",
                array('controller' => "download", 'action' => 'list'),
                array(1 => "id", 2 => "season" ,3 => 'format', 4 => 'type')
            )
        );
    }

    public function _initPlugin($dispatcher) {
        //echo "2nd called\n";
    }

    public function _initComposerAutoload(\Yaf\Dispatcher $dispatcher) {
        \Yaf\Loader::import(APPLICATION_PATH.'/application/library/vendor/autoload.php');
        \Yaf\Loader::import(APPLICATION_PATH.'/generated-conf/config.php');

        $twig = new TwigAdapter();
        $dispatcher->setView($twig);
    }
}

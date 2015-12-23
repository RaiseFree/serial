<?php
class IndexController extends \Yaf\Controller_Abstract 
{
    public $actions = array( "dummy" => "actions/Dummy_action.php");

    /* action method may have arguments */
    public function indexAction() {
        var_dump('index'); die();
    }
}

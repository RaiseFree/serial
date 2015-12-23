<?php
class DaemonController extends \Yaf\Controller_Abstract 
{
    public function indexAction() {
        $client = new \Goutte\Client();
        $client->setHeader("User-Agent", 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.153 Safari/537.36  115Browser/5.1(mac)');
        $crawler = $client->request('GET', 'http://www.115.com');
        //$a = $crawler->html();
        //$crawler->filter('div.media-list')->each(function($node, $i){
            //$text = $node->filter('h2')->text();
            ////$text = $node->text();
            //var_dump($text);
        //});
        //$crawler = $client->request('GET', 'http://www.zimuzu.tv/'); 
        //$crawler->filter('.fl-info')->each(function($node, $i){
            //$url = $node->filter('a')->link();
            //var_dump($url->getUri());
        //});
        die();
    }
}

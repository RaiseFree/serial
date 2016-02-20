<?php
class DaemonController extends \Yaf\Controller_Abstract 
{
    public function indexAction() {
        $sources = SourceQuery::create()->find();

        foreach ($sources as $source) {
            $url = $source->getUrl();
            if ($url == 'http://www.zimuzu.tv/resource/33110') {
                continue;
            }
            Sync::S($url);
        } 

        //$crawler = $client->request('GET', 'http://www.115.com');
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

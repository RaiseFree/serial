<?php

/**
 * Class Sync
 * @author Michael Song
 */
class Sync
{
    /**
     * @desc  
     * @param  
     * @return  
     */
    public static function S($url) 
    {
        $url = str_replace('resource', 'resource/list', $url);

        $client = new \Goutte\Client();
        $client->setHeader("User-Agent", 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.153 Safari/537.36  115Browser/5.1(mac)');

        $crawler = $client->request('GET', $url);
        $crawler->filter('div.media-tab a')->each(function($node, $i){
            $text = $node->text();
            $season = $node->attr('season');
        });
        $crawler->filter('div.media-list')->each(function($node){
            $type = $node->filter('h2')->text();
            var_dump($type);
            $node->filter('ul>li')->each(function($li){
                $title = trim($li->filter('div.fl')->text());
                var_dump($title);
                $li->filter('div.fr>a')->each(function($a){
                    $href = $a->attr('href');
                    $name = $a->text();
                    var_dump("{$name}:{$href}");
                });
                exit;
            });
        });
    }
}

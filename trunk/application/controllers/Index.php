<?php
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;

class IndexController extends \Yaf\Controller_Abstract 
{
    public $actions = array( "dummy" => "actions/Dummy_action.php");

    /* action method may have arguments */
    public function indexAction() {
        #$episodes = EpisodeQuery::create()->find();
        $serials = SerialQuery::create()->find();
        $this->_view->assign('data', $serials->toArray());
    }

    /**
     * @param int $id
     * @param int $season
     * @param string $order
     */
    public function listAction($id = 0, $season = 0, $order = 'ed2k')
    {
        $sourceId = $id;
        $query = EpisodeQuery::create();
        if (!empty($id) && !empty($season)) {
            $query->where('Episode.source_id = ? and Episode.season = ?', array($id, $season));
        }
        $data = $query->find();
        $data = $data->toArray();
        $query = DownloadQuery::create();
        $serialId = 0;
        if (!empty($id) && !empty($season)) {
            $query->where('Download.source_id = ? and Download.season = ?', array($id, $season));
            $query->groupByEpisodeId();
            $query->groupByEformat();
            $query->orderByType(Criteria::ASC);
        }
        $data1 = $query->find();
        $data1 = $data1->toarray();
        foreach ($data1 as $value) {
            $eformat = $value['Eformat'];
            $id      = $value['Id'];
            $serialId = $value['SerialId'];
        }

        $eformats = DownloadQuery::create()->getEformats();
        $souce = SerialQuery::create()->findOneById($serialId);

        $this->_view->assign('id', $sourceId);
        $this->_view->assign('data', $data);
        $this->_view->assign('season', $season);
        $this->_view->assign('order', $order);
        $this->_view->assign('eformats', $eformats);
        $this->_view->title($souce->getName());
    }

    public function addAction() 
    {
        
    }

    public function createAction() 
    {
        die();
        $posts   = $this->_request->getPost();
        $url     = $posts['url'];
        $name     = '';
        $listlink = '';

        $domain = parse_url($url);
        $domain = "{$domain['scheme']}://{$domain['host']}";

        $client = new Goutte\Client();
        $crawler = $client->request('GET', $url);
        $name = $crawler->filter('div[class="box comment-box"] > h2[class="it"]')->each(function($node){
            $name = $node->text();
            if (!empty($name)) {
                $name = str_replace(' 短评', '', $name);
            }
            return $name;
        });
        $listlink = $crawler->filter('div[class="download-tab"] > a')->each(function($node){
            $list = $node->attr('href');
            if (!empty($list)) {
                return "{$list}";
            }
            return '';
        });
        if (!empty($listlink[0])) {
            $listlink = "{$domain}{$listlink[0]}";
        }
        if (!empty($name[0])) {
            $name = $name[0];
        }
        if (!empty($name) && is_string($name) && !empty($listlink) && is_string($listlink)) {
            $serial = new Serial();
            $serial->setName($name);
            if ($serial->save()) {
                $serialId = $serial->getId();
                $source  = new Source();
                $source->setSerialId($serialId);
                $source->setUrl($listlink);
                $source->setName($posts['url']);
                $result = $source->save();
                var_dump($result); die();
            }
        }
    }
}

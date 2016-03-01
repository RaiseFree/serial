<?php
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;

class DownloadController extends \Yaf\Controller_Abstract
{
    /**
     * @desc  
     * @param  
     */
    public function indexAction() 
    {
        $this->_request->getQuery();
    }

    /**
     * @desc  
     * @param  
     */
    public function infoAction() 
    {
        $serialId = $this->_request->getQuery('serial_id', 0);
        $query = EpisodeQuery::create();
        if (!empty($serialId)) {
            $query->where('Episode.source_id = ?', $serialId);
            $query->groupBySeason();
        }
        $data = $query->find();
        $res = $data->toArray();
        $jsonData = array();
        foreach ($res as $value) {
            $jsonData[] = $value['Season'];
        }
        die(json_encode($jsonData));
    }

    /**
     * @param int $id
     * @param int $season
     * @param string $order
     */
    public function listAction($id = 0, $season = 0, $order = 'ed2k')
    {
        $sourceId = $id;
        $query = DownloadQuery::create();
        if (!empty($id) && !empty($season)) {
            $query->where('Download.source_id = ? and Download.season = ?', array($id, $season));
            $query->groupByEpisodeId();
            $query->groupByEformat();
            $query->orderByType(Criteria::ASC);
        }
        $data1 = $query->find();
        $data1 = $data1->toarray();
        $downloads = array();
        foreach ($data1 as $value) {
            $eformat = $value['Eformat'];
            !isset($downloads[$eformat]) && $downloads[$eformat] = array();
            $downloads[$eformat][] = $value;
        }

        $con = Propel::getConnection();
        if($order == 'ed2k')
            $order = 'asc';
        else
            $order = 'desc';
        $sql = "select * from (select * from serial_db.download where source_id = :sourceId and season = :season order by `type` {$order}) as a group by a.episode_id,a.eformat;";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':sourceId', $sourceId, PDO::PARAM_INT);
        $stmt->bindParam(':season', $season, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC, 'Download');
        $downloads = array();
        foreach ($res as $value) {
            $eformat = $value['eformat'];
            !isset($downloads[$eformat]) && $downloads[$eformat] = array();
            $downloads[$eformat][] = $value;
        }
        die(json_encode($downloads));
    }
}

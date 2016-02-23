<?php

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
     * @desc  
     * @param  
     */
    public function listAction($id = 0, $season = 0, $format = '', $type = '') 
    {
        $serialId = $this->_request->getQuery('serial_id', 0);
        $query = EpisodeQuery::create();
        if (!empty($serialId)) {
            $query->where('Episode.source_id = ?', $serialId);
        }
        if (!empty($season)) {
            $query->where('Episode.season = ?', $season);
        }
        if (!empty($format)) {
            $query->where('Episode.eformat = ?', $format);
        }
        if (!empty($type)) {
            $query->where('Episode.type = ?', $type);
        }
        $data = $query->find();
        $res = $data->toArray();
        $jsonData = array();
        foreach ($res as $value) {
            $jsonData[] = $value['Url'];
        }
        die(json_encode($jsonData));
    }
}

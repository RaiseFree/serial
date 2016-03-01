<?php

use Base\DownloadQuery as BaseDownloadQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'download' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class DownloadQuery extends BaseDownloadQuery
{
    private static $__ALL_EFORMART = 'all_eformats';
    public function getEformats()
    {
        $data = Util::Men()->get(self::$__ALL_EFORMART);
        if(empty($data)){
            $data = $this->select('eformat')->groupByEformat()->find();
            if($data){
                $data = $data->toArray();
                Util::Men()->set(self::$__ALL_EFORMART, $data);
            }
        }
        return $data;
    }
}

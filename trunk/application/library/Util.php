<?php
/**
 * Class Util
 * @author Michael Song
 */
class Util
{
    private static $__mem_instance = null;
    private static $__STATUS_CLASS = 1;

    public static function Men() 
    {
        if (self::$__mem_instance === null) {
            phpFastCache::setup("storage","auto");
            self::$__mem_instance = phpFastCache("memcache");
        }
        return self::$__mem_instance;
    }

    /**
     * @desc    获取状态
     */
    public static function STATUSNAME($id) 
    {
        return DicQuery::create()->getName(self::$__STATUS_CLASS, $id);
    }
    /**
     * @desc     驼峰变量切换 user_id  ===>>>   UserId
     */
    public static function HUMP($str, $ucfirst = true) 
    {
        while(($pos = strpos($str , '_'))!==false)
            $str = substr($str , 0 , $pos).ucfirst(substr($str , $pos+1));

        return $ucfirst ? ucfirst($str) : $str;
    }
}

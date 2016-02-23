<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1453003342.
 * Generated on 2016-01-17 12:02:22 by raisefree
 */
class PropelMigration_1453003342
{
    public $comment = '';

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'serial_db' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `episode`

  CHANGE `eformat` `eformat` VARCHAR(20) NOT NULL COMMENT \'HDTV|MKV\',

  CHANGE `type` `type` VARCHAR(20) NOT NULL COMMENT \'ed2k|magnet|thunder\',

  CHANGE `url` `url` VARCHAR(400) NOT NULL COMMENT \'来源地址\',

  CHANGE `url_md5` `url_md5` VARCHAR(32) NOT NULL COMMENT \'来源地址索引\';

ALTER TABLE `serial`

  CHANGE `name` `name` VARCHAR(24) NOT NULL COMMENT \'美剧名\';

ALTER TABLE `source`

  CHANGE `url` `url` VARCHAR(400) NOT NULL COMMENT \'来源地址\';

ALTER TABLE `user`

  CHANGE `name` `name` VARCHAR(255) NOT NULL COMMENT \'姓名\',

  CHANGE `password` `password` VARCHAR(255) NOT NULL COMMENT \'面膜\',

  CHANGE `email` `email` VARCHAR(255) NOT NULL COMMENT \'员工邮箱\';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'serial_db' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `episode`

  CHANGE `eformat` `eformat` VARCHAR(45) NOT NULL,

  CHANGE `type` `type` VARCHAR(20) NOT NULL,

  CHANGE `url` `url` VARCHAR(400) NOT NULL,

  CHANGE `url_md5` `url_md5` VARCHAR(32) NOT NULL;

ALTER TABLE `serial`

  CHANGE `name` `name` VARCHAR(24) NOT NULL;

ALTER TABLE `source`

  CHANGE `url` `url` VARCHAR(400) NOT NULL;

ALTER TABLE `user`

  CHANGE `name` `name` VARCHAR(255) NOT NULL,

  CHANGE `password` `password` VARCHAR(255) NOT NULL,

  CHANGE `email` `email` VARCHAR(255) NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
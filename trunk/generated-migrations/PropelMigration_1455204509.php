<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1455204509.
 * Generated on 2016-02-11 23:28:29 by raisefree
 */
class PropelMigration_1455204509
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

DROP INDEX `_episode_index` ON `episode`;

ALTER TABLE `episode`

  DROP `eformat`,

  DROP `type`,

  DROP `url`,

  DROP `url_md5`,

  DROP `is_download`,

  DROP `recode_at`;

ALTER TABLE `serial`

  CHANGE `name` `name` VARCHAR(200) NOT NULL COMMENT \'美剧名\';

ALTER TABLE `source`

  CHANGE `url` `url` VARCHAR(400) NOT NULL COMMENT \'来源地址\';

ALTER TABLE `user`

  CHANGE `name` `name` VARCHAR(255) NOT NULL COMMENT \'姓名\',

  CHANGE `password` `password` VARCHAR(255) NOT NULL COMMENT \'面膜\',

  CHANGE `email` `email` VARCHAR(255) NOT NULL COMMENT \'员工邮箱\';

CREATE TABLE `download`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `serial_id` INTEGER NOT NULL,
    `source_id` INTEGER NOT NULL,
    `season` VARCHAR(24) NOT NULL,
    `episode_id` INTEGER NOT NULL,
    `number` INTEGER NOT NULL,
    `eformat` VARCHAR(20) NOT NULL COMMENT \'HDTV|MKV\',
    `type` VARCHAR(20) NOT NULL COMMENT \'ed2k|magnet|thunder\',
    `url` TEXT(2000) NOT NULL COMMENT \'来源地址\',
    `url_md5` VARCHAR(32) NOT NULL COMMENT \'来源地址索引\',
    `is_download` INTEGER DEFAULT 0 NOT NULL COMMENT \'是否下载过\',
    `recode_at` DATETIME NOT NULL COMMENT \'最后收录时间\',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `_download_index` (`url_md5`)
) ENGINE=InnoDB;

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

DROP TABLE IF EXISTS `download`;

ALTER TABLE `episode`

  ADD `eformat` VARCHAR(20) NOT NULL AFTER `number`,

  ADD `type` VARCHAR(20) NOT NULL AFTER `eformat`,

  ADD `url` TEXT NOT NULL AFTER `type`,

  ADD `url_md5` VARCHAR(32) NOT NULL AFTER `url`,

  ADD `is_download` INTEGER DEFAULT 0 NOT NULL AFTER `url_md5`,

  ADD `recode_at` DATETIME NOT NULL AFTER `is_download`;

CREATE UNIQUE INDEX `_episode_index` ON `episode` (`url_md5`);

ALTER TABLE `serial`

  CHANGE `name` `name` VARCHAR(200) NOT NULL;

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
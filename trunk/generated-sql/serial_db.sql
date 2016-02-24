
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL COMMENT '姓名',
    `password` VARCHAR(255) NOT NULL COMMENT '面膜',
    `email` VARCHAR(255) NOT NULL COMMENT '员工邮箱',
    `login_at` DATETIME NOT NULL COMMENT '最后登录时间',
    `status` INTEGER DEFAULT 0 NOT NULL COMMENT '组状态: 1 启用 0 停用',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- serial
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `serial`;

CREATE TABLE `serial`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(200) NOT NULL COMMENT '美剧名',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- source
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `source`;

CREATE TABLE `source`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `serial_id` INTEGER NOT NULL,
    `name` VARCHAR(200) NOT NULL,
    `url` VARCHAR(400) NOT NULL COMMENT '来源地址',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`,`serial_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- episode
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `episode`;

CREATE TABLE `episode`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `serial_id` INTEGER NOT NULL,
    `source_id` INTEGER NOT NULL,
    `season` VARCHAR(24) NOT NULL,
    `number` INTEGER NOT NULL,
    `name` VARCHAR(200) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- download
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `download`;

CREATE TABLE `download`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `serial_id` INTEGER NOT NULL,
    `source_id` INTEGER NOT NULL,
    `season` VARCHAR(24) NOT NULL,
    `episode_id` INTEGER NOT NULL,
    `name` VARCHAR(200) NOT NULL,
    `size` VARCHAR(200) NOT NULL,
    `number` INTEGER NOT NULL,
    `eformat` VARCHAR(20) NOT NULL COMMENT 'HDTV|MKV',
    `type` VARCHAR(20) NOT NULL COMMENT 'ed2k|magnet|thunder',
    `url` TEXT(2000) NOT NULL COMMENT '来源地址',
    `url_md5` VARCHAR(32) NOT NULL COMMENT '来源地址索引',
    `is_download` INTEGER DEFAULT 0 NOT NULL COMMENT '是否下载过',
    `recode_at` DATETIME NOT NULL COMMENT '最后收录时间',
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `_download_index` (`url_md5`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

<?php

$query = <<< QUERY_EOD
CREATE TABLE IF NOT EXISTS `create_table_test` (
  `id`          bigint     unsigned NOT NULL              COMMENT 'ID',
  `user_id`     int(10)    unsigned NOT NULL              COMMENT 'ユーザーID',
  `state`       tinyint(1) unsigned NOT NULL DEFAULT '0'  COMMENT '状態',
  `create_time` datetime            NOT NULL              COMMENT '作成日時',
  `update_time` datetime            NOT NULL              COMMENT '更新日時',
  `delete_time` datetime                     DEFAULT NULL COMMENT '削除日時',
  PRIMARY KEY (`id`),
  UNIQUE KEY (`user_id`),
  KEY `idx_user_id` (`user_id`,`state`,`create_time`,`delete_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ユーザーパラメータ'
QUERY_EOD;


<?php
// 16 march 2011
// Bharadwaj

// This file contains the table schema. This is t be called during install.

$messages_create_table = "CREATE TABLE `messages` (
  `id` int(11) NOT NULL auto_increment,
  `content` text NOT NULL,
  `updated` date NOT NULL,
  `user` varchar(30) default NULL,
  `mood` int(11) default NULL,
  `enabled` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
)";

$settings_create_table = "CREATE TABLE `settings` (
  `id` int(3) NOT NULL auto_increment,
  `setting` varchar(20) NOT NULL,
  `value` varchar(200) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key` (`setting`)
);";

$users_create_table = "CREATE TABLE `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_name` varchar(200) NOT NULL default '',
  `user_email` varchar(220) NOT NULL default '',
  `pwd` varchar(220) NOT NULL default '',
  `ckey` varchar(220) NOT NULL default '',
  `ctime` varchar(220) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user_email` (`user_email`),
  FULLTEXT KEY `idx_search` (`user_email`,`user_name`)
)";

$default_settings_sitename = "INSERT INTO `settings` (setting) values ('sitename');";
$default_settings_tagline = "INSERT INTO `settings` (setting) values ('tagline');";
$default_settings_username = "INSERT INTO `settings` (setting) values ('username');";
$default_settings_password = "INSERT INTO `settings` (setting) values ('password');";

// Store each query as an array. It will be easy to update, in case of an upgrade.
$azstore_db_create_query = array($messages_create_table , $settings_create_table , $users_create_table, $default_settings_sitename, $default_settings_tagline, $default_settings_username, $default_settings_password);


?>
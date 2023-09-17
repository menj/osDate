/*
CREATE TABLE `__DB_PREFIX__banners` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `bannerurl` text,
  `language` varchar(255) default NULL,
  `linkurl` varchar(255) default NULL,
  `tooltip` varchar(255) default NULL,
  `size` varchar(20) default NULL,
  `startdate` int(11) NOT NULL default '0',
  `expdate` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  `enabled` char(1) NOT NULL default 'Y',
  PRIMARY KEY  (`id`),
  KEY `language` (`language`),
  KEY `startdate` (`startdate`),
  KEY `expdate` (`expdate`),
  KEY `linkurl` (`linkurl`)
)
*/
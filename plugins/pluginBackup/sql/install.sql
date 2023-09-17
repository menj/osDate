CREATE TABLE `__DB_PREFIX__pluginBackup_backup` (
  `id` int(11) NOT NULL auto_increment,
  `hash` text NOT NULL,
  `uid` int(11) NOT NULL default '0',
  `ts` int(11) NOT NULL default '0',
  `size` int(11) NOT NULL default '0',
  `deleted` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;

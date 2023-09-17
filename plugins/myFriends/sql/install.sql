CREATE TABLE `__DB_PREFIX__myFriends_friends` (
  `id` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0',
  `friend` int(11) NOT NULL default '0',
  `conf` text NOT NULL,
  `ts` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;

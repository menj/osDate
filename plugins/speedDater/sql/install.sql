CREATE TABLE `__DB_PREFIX__speedDater_speeddater` (
  `id` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0',
  `friend` int(11) NOT NULL default '0',
  `ts` int(11) NOT NULL default '0',
  `sent` smallint(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ;
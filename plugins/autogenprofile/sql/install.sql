CREATE TABLE `__DB_PREFIX__autogenprofile_autogenprofile` (
  `username` text NOT NULL,
  `fid` int(11) NOT NULL default '0'
) ;

CREATE TABLE `__DB_PREFIX__autogenprofile_forms` (
  `id` int(11) NOT NULL auto_increment,
  `form` text NOT NULL,
  `ts` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
)  ;
CREATE TABLE `__DB_PREFIX__adultQuest_answers` (
  `aid` int(11) NOT NULL auto_increment,
  `qid` int(11) NOT NULL default '0',
  `answer` text,
  `pid` int(11) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`aid`)
) ;

CREATE TABLE `__DB_PREFIX__adultQuest_pages` (
  `pid` int(11) NOT NULL auto_increment,
  `tname` text NOT NULL,
  `ord` text NOT NULL,
  `qnumber` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pid`)
) AUTO_INCREMENT=6 ;


INSERT INTO `__DB_PREFIX__adultQuest_pages` VALUES (1, 'sexualactivities.tpl', '1', 7);
INSERT INTO `__DB_PREFIX__adultQuest_pages` VALUES (2, 'sexualinterests.tpl', '2', 7);
INSERT INTO `__DB_PREFIX__adultQuest_pages` VALUES (3, 'fantasies.tpl', '3', 9);
INSERT INTO `__DB_PREFIX__adultQuest_pages` VALUES (4, 'sexualaccesories.tpl', '4', 9);
INSERT INTO `__DB_PREFIX__adultQuest_pages` VALUES (5, 'physicalstuff.tpl', '5', 15);
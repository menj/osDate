CREATE TABLE `__DB_PREFIX__advhotornot` (
  `ratingid` int(11) NOT NULL default '0'
);

INSERT INTO `__DB_PREFIX__advhotornot` VALUES (1);

CREATE TABLE `__DB_PREFIX__advhotornot_ratings` (
  `uid` int(11) NOT NULL default '0',
  `rating` int(11) NOT NULL default '0',
  `bestof` int(11) NOT NULL default '0',
  PRIMARY KEY (`uid`)
) ;
CREATE TABLE `micro_blog` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL ,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(20) DEFAULT 0,
   PRIMARY KEY (`ID`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+02:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `NoticeNotice`;
CREATE TABLE `NoticeNotice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned DEFAULT NULL,
  `text` varchar(255) NOT NULL,
  `dateTimeInserted` datetime NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `RelationshipBetweenUserAndTag`;
CREATE TABLE `RelationshipBetweenUserAndTag` (
  `UsersUsers` int(10) unsigned NOT NULL,
  `TagTag` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UsersUsers`,`TagTag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `TagTag`;
CREATE TABLE `TagTag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `UsersAddress`;
CREATE TABLE `UsersAddress` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `UsersSex`;
CREATE TABLE `UsersSex` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `UsersSex` (`id`, `name`, `deleted`) VALUES
(2,	'woman',	0),
(1,	'man',	0);

DROP TABLE IF EXISTS `UsersUsers`;
CREATE TABLE `UsersUsers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `sex` int(10) unsigned NOT NULL,
  `address` int(10) unsigned NOT NULL,
  `mail` varchar(50) NOT NULL,
  `phone` char(13) NOT NULL,
  `countView` int(10) unsigned NOT NULL,
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dateTimeInserted` datetime NOT NULL,
  `dateTimeUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `address` (`address`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
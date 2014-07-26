-- Adminer 3.6.4 MySQL dump

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

INSERT INTO `NoticeNotice` (`id`, `user`, `text`, `dateTimeInserted`, `deleted`) VALUES
(71,	2,	'moje dalsi poznamka',	'2014-06-20 06:24:37',	1),
(68,	2,	'dynamic notice222',	'2014-06-10 06:48:09',	0),
(69,	2,	'dynamic notice4',	'2014-06-10 06:48:09',	1),
(72,	2,	'tod to uz vyjde',	'2014-06-20 06:25:32',	1),
(73,	4,	'todle je notice hledani',	'2014-07-04 06:42:05',	0),
(74,	2,	'asdfasdf',	'2014-07-23 06:57:15',	1);

DROP TABLE IF EXISTS `RelationshipBetweenUserAndTag`;
CREATE TABLE `RelationshipBetweenUserAndTag` (
  `UsersUsers` int(10) unsigned NOT NULL,
  `TagTag` int(10) unsigned NOT NULL,
  PRIMARY KEY (`UsersUsers`,`TagTag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `RelationshipBetweenUserAndTag` (`UsersUsers`, `TagTag`) VALUES
(2,	1),
(2,	3),
(4,	4);

DROP TABLE IF EXISTS `TagTag`;
CREATE TABLE `TagTag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `TagTag` (`id`, `name`, `deleted`) VALUES
(1,	'friend',	0),
(2,	'enemy',	0),
(3,	'neco',	1),
(4,	'adam',	0),
(5,	'petr',	0),
(6,	'adam',	0),
(7,	'petr',	0);

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
  `mail` varchar(50) NOT NULL,
  `phone` char(13) NOT NULL,
  `countView` int(10) unsigned NOT NULL,
  `hide` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `dateTimeInserted` datetime NOT NULL,
  `dateTimeUpdated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `UsersUsers` (`id`, `name`, `surname`, `sex`, `mail`, `phone`, `countView`, `hide`, `dateTimeInserted`, `dateTimeUpdated`) VALUES
(2,	'John',	'Doe',	1,	'john@doe.com',	'666666666',	208,	0,	'2013-03-28 19:08:58',	'2014-07-24 06:53:14'),
(4,	'Adam',	'Suba',	1,	'as@xline.cz',	'777777777',	8,	0,	'2014-07-04 06:41:46',	'2014-07-04 06:45:21');

-- 2014-07-24 15:00:49

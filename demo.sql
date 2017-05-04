-- Adminer 3.6.4 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+00:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `owner` int(10) unsigned DEFAULT NULL,
  `ownerEntityName` varchar(255) DEFAULT NULL,
  `text` varchar(255) NOT NULL,
  `dateTimeInserted` datetime NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `relationship_between_user_and_tag`;
CREATE TABLE `relationship_between_user_and_tag` (
  `user` int(10) unsigned NOT NULL,
  `tag` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user`,`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `sex`;
CREATE TABLE `sex` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `sex` (`id`, `name`, `deleted`) VALUES
(1,	'man',	0),
(2,	'woman',	0);

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `tag` (`id`, `name`, `deleted`) VALUES
(1,	't1',	0),
(2,	't2',	0),
(3,	't3',	0);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `sex` int(10) unsigned NOT NULL,
  `timeBorn` time DEFAULT NULL,
  `contact` int(10) unsigned DEFAULT NULL,
  `countView` int(10) unsigned NOT NULL,
  `data` varchar(255) DEFAULT NULL,
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dateTimeInserted` datetime NOT NULL,
  `dateTimeUpdated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `address` (`contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `name`, `surname`, `sex`, `timeBorn`, `contact`, `countView`, `data`, `hide`, `dateTimeInserted`, `dateTimeUpdated`) VALUES
(1,	'Johne',	'Doe',	1,	'09:16:30',	1,	1,	'a:2:{s:8:\"settings\";s:2:\"S2\";s:9:\"settings2\";s:2:\"S2\";}',	0,	'2015-12-29 13:15:57',	'2017-04-29 06:33:04');

DROP TABLE IF EXISTS `user_contact`;
CREATE TABLE `user_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` int(10) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `user_contact` (`id`, `address`, `email`, `phone`) VALUES
(1,	1,	'john@doe.com',	'777 777 777');

DROP TABLE IF EXISTS `user_contact_address`;
CREATE TABLE `user_contact_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact` int(10) unsigned DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `address` (`contact`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `user_contact_address` (`id`, `contact`, `street`, `city`, `zip`) VALUES
(1,	NULL,	'3500 West Olive Avenue',	'Burbank 2',	'CA 91505-5512');

-- 2017-04-29 04:33:36

-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `instakey` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `image`, `instakey`) VALUES
(1,	'bibhash',	'e6e061838856bf47e1de730719fb2609',	'bibhash.bluethink@gmail.com',	'1558511244.locaton-map.png',	''),
(2,	'pankaj',	'81ec8e45a2b2d6c8f6aaf0ee40689c08',	'pankaj@gmail.com',	'1558512785.p1.png',	'6637727570.087d5af.5f6a1136e456484a893ee59c01c02cec');

-- 2019-05-24 13:40:16

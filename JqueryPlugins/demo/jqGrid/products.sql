-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 03 月 08 日 07:29
-- 服务器版本: 5.5.19
-- PHP 版本: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `lrfbeyond_demo`
--

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(10) NOT NULL,
  `title` varchar(60) NOT NULL,
  `size` varchar(30) NOT NULL,
  `os` varchar(50) NOT NULL,
  `charge` varchar(50) DEFAULT NULL,
  `screen` varchar(50) DEFAULT NULL,
  `design` varchar(50) DEFAULT NULL,
  `price` int(10) NOT NULL,
  `addtime` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `products`
--

INSERT INTO `products` (`id`, `sn`, `title`, `size`, `os`, `charge`, `screen`, `design`, `price`, `addtime`, `deleted`) VALUES
(1, '1001', '苹果iPhone 4S（16GB）', '3.5英寸 960x640像素 ', 'iOS 5.0', '1420mAh', '电容屏，多点触控 ', '直板', 5150, '2012-02-24 11:27:49', 0),
(2, '1002', '三星I9100 GALAXY SII（16GB）', '4.3英寸 800x480像素 ', 'Android OS 2.3 ', '1650mAh ', '电容屏，多点触控 ', '直板 ', 3790, '2012-02-24 11:29:04', 0),
(3, '1003', 'HTC G11（Incredible S）', '4英寸 800x480像素', 'Android OS 2.2 ', '1450mAh', '电容屏，多点触控 ', '直板', 2232, '2012-02-24 11:32:01', 0),
(4, '1004', '魅族M9（8GB）', '3.5英寸 960x640像素', 'Android OS 2.3 ', '1370mAh', '电容屏，多点触控 ', '直板', 1729, '2012-02-24 11:33:11', 0),
(5, '1005', '小米M1（MIUI）', '4英寸 854x480像素', 'MIUI+原生Android', '1930mAh', '电容屏，多点触控', '直板', 1999, '2012-02-24 11:40:23', 0),
(6, '1006', '诺基亚C5-03', '3.2英寸 640x360像素 ', 'Symbian S60V5', '1000mAh', '电阻屏，单点触控 ', '直板', 1164, '2012-02-24 11:42:25', 0),
(7, '1007', '摩托罗拉XT910（DROID RAZR）', '4.3英寸 960x540像素 ', 'Android OS 2.3 ', '1780mAh', '电容屏，多点触控', '直板', 3700, '2012-02-24 11:45:28', 0),
(8, '1008', '诺基亚N8', '3.5英寸 640x360像素 ', 'Symbian^3 ', '1200mAh', '电容屏，多点触控', '直板', 2302, '2012-02-24 11:46:21', 0),
(9, '1009', '华为U8860 Honor（荣耀）', '4英寸 854x480像素', 'Android OS 2.3', '1930mAh', '电容屏，多点触控', '直板', 1889, '2012-02-24 11:48:43', 0),
(10, '1010', '三星W999', '3.5英寸 800x480像', 'Android OS 2.3 ', '1500mAh ', '电容屏，多点触控', '翻盖 ', 12340, '2012-02-24 11:54:17', 0),
(11, '1011', '酷派N900+', '3.2英寸 480x320像 ', 'Windows CE 6.0 ', '1500mAh ', '电容屏，多点触控', '直板 ', 6180, '2012-02-24 11:54:21', 0),
(12, '1012', '黑莓9800（Torch）', '3.2英寸 480x360像素', 'BlackBerry OS 6', '1300mAh', '电容屏，多点触控', '滑盖', 4900, '2012-02-24 11:55:51', 0),
(13, '1013', '富士通IS12T（联通版）', '3.7英寸 480x854像素', 'Windows phone 7.5', '2150mAh ', '电容屏，多点触控', '直板', 4800, '2012-02-24 11:55:54', 0);

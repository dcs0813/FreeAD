-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2011 年 12 月 20 日 08:22
-- 伺服器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `freead`
--

-- --------------------------------------------------------

--
-- 表的結構 `freead_member`
--

CREATE TABLE IF NOT EXISTS `freead_member` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `m_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `m_level` int(11) NOT NULL DEFAULT '3',
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `payment` int(20) NOT NULL DEFAULT '0',
  `expire` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `initTime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`m_id`),
  UNIQUE KEY `m_username` (`m_username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=0;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2011 年 12 月 22 日 00:55
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
-- 表的結構 `freead_ad`
--

CREATE TABLE IF NOT EXISTS `freead_ad` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) NOT NULL,
  `a_position` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `a_title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `a_content` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `a_picture` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `a_link` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=0;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

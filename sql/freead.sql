-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2012 年 01 月 08 日 19:16
-- 伺服器版本: 5.5.16
-- PHP 版本: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
  `trial_expire` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`a_id`),
  KEY `m_id` (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=33 ;

--
-- 轉存資料表中的資料 `freead_ad`
--

INSERT INTO `freead_ad` (`a_id`, `m_id`, `a_position`, `a_title`, `a_content`, `a_picture`, `a_link`, `a_phone`, `trial_expire`, `is_delete`) VALUES
(29, 4, 'r0c0', '林書豪推特上自爆將加盟火箭', '台裔球星林書豪在推特上宣佈將加盟火箭，很興奮成為休士頓球隊的一員 ....。 ', 'images0.jpg', 'http://www.kimo.com.tw', '12345678', '', 0),
(31, 0, 'r0c1', '林書豪推特上自爆將加盟火箭', '台裔球星林書豪在推特上宣佈將加盟火箭，很興奮成為休士頓球隊的一員 ....。', 'images1.jpg', 'http://www.kimo.com.tw', '1234567', '1/10/2012 5:28:25 PM', 1),
(32, 0, 'r1c1', '內政部送修土地五法 不動產實價登錄 不作為課稅依據', '居住與土地正義是馬英九總統這次大選主打政見之一，上周二，他要求立法部門在本會期通過攸關土地改採市價徵收、不動產實價登錄等的「土地五法」。目前內政部與國民黨團已達成共識 ......。', 'images2.jpg', 'http://www.kimo.com.tw', '1234657', '1/10/2012 5:28:25 PM', 0);

-- --------------------------------------------------------

--
-- 表的結構 `freead_expire`
--

CREATE TABLE IF NOT EXISTS `freead_expire` (
  `m_level` int(11) NOT NULL,
  `expire_secs` int(11) NOT NULL DEFAULT '172800',
  PRIMARY KEY (`m_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 轉存資料表中的資料 `freead_expire`
--

INSERT INTO `freead_expire` (`m_level`, `expire_secs`) VALUES
(3, 172800);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=6 ;

--
-- 轉存資料表中的資料 `freead_member`
--

INSERT INTO `freead_member` (`m_id`, `m_username`, `m_password`, `m_level`, `name`, `phone`, `payment`, `expire`, `initTime`, `is_delete`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin', '111', 0, '12/24/2011 1:14:00 AM', '12/24/2011 1:14:00 AM', 0),
(4, 'TedPang', 'b0abb5f0d3700c0f7989a457f553bba1', 2, 'TedPang', '11111', 11111, '01/12/2012 5:28:25 PM', '1/2/2012 5:28:25 PM', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

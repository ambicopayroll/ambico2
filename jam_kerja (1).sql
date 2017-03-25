-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2017 at 05:35 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fin_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `jam_kerja`
--

CREATE TABLE IF NOT EXISTS `jam_kerja` (
  `jk_id` int(11) NOT NULL DEFAULT '0',
  `jk_name` varchar(100) NOT NULL DEFAULT '',
  `jk_kode` varchar(10) NOT NULL DEFAULT '',
  `use_set` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Yes/No',
  `jk_bcin` time NOT NULL DEFAULT '00:00:00',
  `jk_cin` smallint(6) NOT NULL DEFAULT '0',
  `jk_ecin` smallint(6) NOT NULL DEFAULT '0',
  `jk_tol_late` smallint(6) NOT NULL DEFAULT '0',
  `jk_use_ist` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Yes/No',
  `jk_ist1` time NOT NULL DEFAULT '00:00:00',
  `jk_ist2` time NOT NULL DEFAULT '00:00:00',
  `jk_tol_early` smallint(6) NOT NULL DEFAULT '0',
  `jk_bcout` smallint(6) NOT NULL DEFAULT '0',
  `jk_cout` smallint(6) NOT NULL DEFAULT '0',
  `jk_ecout` time NOT NULL DEFAULT '00:00:00',
  `use_eot` tinyint(4) NOT NULL DEFAULT '0',
  `min_eot` smallint(6) NOT NULL DEFAULT '0',
  `max_eot` smallint(6) NOT NULL DEFAULT '0',
  `reduce_eot` smallint(6) NOT NULL DEFAULT '0',
  `jk_durasi` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Efektif, 2: Aktual',
  `jk_countas` float NOT NULL DEFAULT '0',
  `jk_min_countas` smallint(6) NOT NULL DEFAULT '0',
  `jk_ket` varchar(100) DEFAULT '',
  PRIMARY KEY (`jk_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam_kerja`
--

INSERT INTO `jam_kerja` (`jk_id`, `jk_name`, `jk_kode`, `use_set`, `jk_bcin`, `jk_cin`, `jk_ecin`, `jk_tol_late`, `jk_use_ist`, `jk_ist1`, `jk_ist2`, `jk_tol_early`, `jk_bcout`, `jk_cout`, `jk_ecout`, `use_eot`, `min_eot`, `max_eot`, `reduce_eot`, `jk_durasi`, `jk_countas`, `jk_min_countas`, `jk_ket`) VALUES
(3, '6A', '6A', 0, '05:00:00', 60, 0, 15, -1, '10:00:00', '11:00:00', 15, 0, 60, '15:00:00', 0, 0, 0, 0, 1, 1, 240, '6 hari kerja - shift I'),
(1, '5A', '5A', 0, '05:00:00', 60, 0, 15, -1, '10:00:00', '11:00:00', 15, 0, 60, '16:00:00', 0, 0, 0, 0, 1, 1, 240, '5 hari kerja - shift I'),
(2, '5B', '5B', 0, '14:00:00', 60, 0, 15, -1, '19:00:00', '20:00:00', 15, 0, 60, '01:00:00', 0, 0, 0, 0, 1, 1, 240, '5 hari kerja - shift II'),
(5, 'Proses I & II SenJum Shift 1', 'P1n2SJ_S1', 0, '05:00:00', 60, 0, 15, -1, '11:15:00', '12:15:00', 15, 0, 60, '15:00:00', 0, 0, 0, 0, 1, 1, 240, ''),
(4, '6B', '6B', 0, '13:00:00', 60, 0, 15, -1, '18:00:00', '19:00:00', 15, 0, 60, '23:00:00', 0, 0, 0, 0, 1, 1, 240, '6 hari kerja - shift II'),
(6, '6C', '6C', 0, '21:00:00', 60, 0, 15, -1, '02:00:00', '03:00:00', 15, 0, 60, '07:00:00', 0, 0, 0, 0, 1, 1, 240, '6 hari kerja - shift III'),
(7, '5S', '5S', 0, '06:15:00', 60, 0, 15, -1, '11:15:00', '12:15:00', 15, 0, 60, '17:15:00', 0, 0, 0, 0, 1, 1, 240, 'Staf'),
(8, 'Proses I & II Sab Shift 1', 'P1n2S_S1', 0, '05:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '12:00:00', 0, 0, 0, 0, 1, 1, 240, ''),
(9, 'Proses I & II SenJum Shift 2', 'P1n2SJ_S2', 0, '13:00:00', 60, 0, 15, -1, '18:00:00', '19:00:00', 15, 0, 60, '23:00:00', 0, 0, 0, 0, 1, 1, 240, ''),
(10, 'Proses I & II Sab Shift 2', 'P1n2S_S2', 0, '10:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '17:00:00', 0, 0, 0, 0, 1, 1, 240, ''),
(11, 'S16A', 'S16A', 0, '05:00:00', 60, 0, 15, -1, '11:15:00', '12:15:00', 15, 0, 60, '15:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 1, 6 HK, Senin - Jumat, 06 - 14'),
(12, 'S16B', 'S16B', 0, '05:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '12:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 1, 6 HK, Sabtu, 06 - 11'),
(13, 'S16C', 'S16C', 0, '06:00:00', 60, 0, 15, -1, '11:15:00', '12:15:00', 15, 0, 60, '16:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 1, 6 HK, Senin - Jumat, 07 - 15'),
(14, 'S16D', 'S16D', 0, '06:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '13:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 1, 6 HK, Sabtu, 07 - 12'),
(15, 'S16E', 'S16E', 0, '07:00:00', 60, 0, 15, -1, '11:15:00', '12:15:00', 15, 0, 60, '17:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 1, 6 HK, Senin - Sabtu, 08 - 16'),
(16, 'S16F', 'S16F', 0, '06:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '16:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 1, 6 HK, Senin - Sabtu, 07 - 15'),
(17, 'S15A', 'S15A', 0, '05:00:00', 60, 0, 15, -1, '11:15:00', '12:15:00', 15, 0, 60, '16:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift I, 5 HK, Senin - Kamis, Senin - Jumat, 06 - 15'),
(18, 'S15B', 'S15B', 0, '06:00:00', 60, 0, 15, -1, '11:15:00', '12:15:00', 15, 0, 60, '17:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift I, 5 HK, Senin - Jumat, 07 - 16'),
(19, 'S15C', 'S15C', 0, '06:15:00', 60, 0, 15, -1, '11:15:00', '12:15:00', 15, 0, 60, '17:15:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 1, 5 HK, Senin - Jumat, 07:15 - 16:15'),
(20, 'S15D', 'S15D', 0, '08:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '19:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 1, 5 HK, Senin - Jumat, 09 - 18'),
(21, 'S15E', 'S15E', 0, '09:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '20:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 1, 5 HK, Senin - Jumat, 10 - 19'),
(22, 'S26A', 'S26A', 0, '13:00:00', 60, 0, 15, -1, '18:00:00', '19:00:00', 15, 0, 60, '23:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 2, 6 HK, Senin - Jumat, 14 - 22'),
(23, 'S26B', 'S26B', 0, '10:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '17:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 2, 6 HK, Sabtu, 11 - 16'),
(24, 'S26C', 'S26C', 0, '14:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '00:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 2, 6 HK, Senin - Sabtu, 15 - 23'),
(25, 'S36A', 'S36A', 0, '21:00:00', 60, 0, 15, -1, '02:00:00', '03:00:00', 15, 0, 60, '07:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 3, 6 HK, Senin - Kamis, 22 - 06'),
(26, 'S36B', 'S36B', 0, '21:00:00', 60, 0, 15, -1, '02:00:00', '03:00:00', 15, 0, 60, '06:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 3, 6 HK, Jumat, 22 - 05'),
(27, 'S36C', 'S36C', 0, '21:00:00', 60, 0, 15, -1, '02:00:00', '03:00:00', 15, 0, 60, '07:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 3, 6 HK, Jumat, 22 - 06'),
(28, 'S36D', 'S36D', 0, '15:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '22:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 3, 6 HK, Sabtu, 16 - 21'),
(29, 'S36E', 'S36E', 0, '21:00:00', 60, 0, 15, -1, '02:00:00', '03:00:00', 15, 0, 60, '06:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 3, 6 HK, Min, 22 - 05'),
(30, 'S36F', 'S36F', 0, '21:00:00', 60, 0, 15, -1, '02:00:00', '03:00:00', 15, 0, 60, '07:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 3, 6 HK, Min, 22 - 06'),
(31, 'S36G', 'S36G', 0, '22:00:00', 60, 0, 15, 0, '00:00:00', '00:00:00', 15, 0, 60, '08:00:00', 0, 0, 0, 0, 1, 1, 240, 'Shift 3, 6 HK, Senin - Sabtu, 23 - 07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

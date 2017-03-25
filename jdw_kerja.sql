-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2017 at 06:44 AM
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
-- Table structure for table `jdw_kerja_d`
--

CREATE TABLE IF NOT EXISTS `jdw_kerja_d` (
  `jdw_kerja_m_id` int(11) NOT NULL DEFAULT '0',
  `jdw_kerja_d_idx` smallint(6) NOT NULL DEFAULT '0' COMMENT '1:minggu; 2:senin; dst',
  `jk_id` int(11) NOT NULL DEFAULT '0',
  `jdw_kerja_d_hari` varchar(50) DEFAULT NULL,
  `jdw_kerja_d_libur` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`jdw_kerja_m_id`,`jdw_kerja_d_idx`,`jk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `jdw_kerja_d`
--

INSERT INTO `jdw_kerja_d` (`jdw_kerja_m_id`, `jdw_kerja_d_idx`, `jk_id`, `jdw_kerja_d_hari`, `jdw_kerja_d_libur`) VALUES
(1, 1, 1, 'Senin', 0),
(1, 2, 1, 'Selasa', 0),
(1, 3, 1, 'Rabu', 0),
(1, 4, 1, 'Kamis', 0),
(1, 5, 1, 'Jumat', 0),
(1, 6, 1, 'Sabtu', -1),
(1, 7, 1, 'Minggu', -1),
(1, 999, 1, 'Libur Umum', -1),
(2, 1, 2, 'Senin', 0),
(2, 2, 2, 'Selasa', 0),
(2, 3, 2, 'Rabu', 0),
(2, 4, 2, 'Kamis', 0),
(2, 5, 2, 'Jumat', 0),
(2, 6, 2, 'Sabtu', -1),
(2, 7, 2, 'Minggu', -1),
(2, 999, 2, 'Libur Umum', -1),
(3, 1, 3, 'Senin', 0),
(3, 2, 3, 'Selasa', 0),
(3, 3, 3, 'Rabu', 0),
(3, 4, 3, 'Kamis', 0),
(3, 5, 3, 'Jumat', 0),
(3, 6, 3, 'Sabtu', 0),
(3, 7, 3, 'Minggu', -1),
(3, 999, 3, 'Libur Umum', -1),
(4, 1, 4, 'Senin', 0),
(4, 2, 4, 'Selasa', 0),
(4, 3, 4, 'Rabu', 0),
(4, 4, 4, 'Kamis', 0),
(4, 5, 4, 'Jumat', 0),
(4, 6, 4, 'Sabtu', 0),
(4, 7, 4, 'Minggu', -1),
(4, 999, 4, 'Libur Umum', -1),
(5, 1, 5, 'Senin', 0),
(5, 2, 5, 'Selasa', 0),
(5, 3, 5, 'Rabu', 0),
(5, 4, 5, 'Kamis', 0),
(5, 5, 5, 'Jumat', 0),
(5, 6, 8, 'Sabtu', 0),
(5, 7, 0, 'Minggu', -1),
(5, 999, 0, 'Libur Umum', -1),
(6, 1, 6, 'Senin', 0),
(6, 2, 6, 'Selasa', 0),
(6, 3, 6, 'Rabu', 0),
(6, 4, 6, 'Kamis', 0),
(6, 5, 6, 'Jumat', 0),
(6, 6, 6, 'Sabtu', 0),
(6, 7, 6, 'Minggu', -1),
(6, 999, 6, 'Libur Umum', -1),
(7, 1, 7, 'Senin', 0),
(7, 2, 7, 'Selasa', 0),
(7, 3, 7, 'Rabu', 0),
(7, 4, 7, 'Kamis', 0),
(7, 5, 7, 'Jumat', 0),
(7, 6, 7, 'Sabtu', -1),
(7, 7, 7, 'Minggu', -1),
(7, 999, 7, 'Libur Umum', -1),
(8, 1, 9, 'Senin', 0),
(8, 2, 9, 'Selasa', 0),
(8, 3, 9, 'Rabu', 0),
(8, 4, 9, 'Kamis', 0),
(8, 5, 9, 'Jumat', 0),
(8, 6, 10, 'Sabtu', 0),
(8, 7, 0, 'Minggu', -1),
(8, 999, 0, 'Libur Umum', -1),
(9, 1, 11, 'Senin', 0),
(9, 2, 11, 'Selasa', 0),
(9, 3, 11, 'Rabu', 0),
(9, 4, 11, 'Kamis', 0),
(9, 5, 11, 'Jumat', 0),
(9, 6, 12, 'Sabtu', 0),
(9, 7, 11, 'Minggu', -1),
(9, 999, 11, 'Libur Umum', -1),
(10, 1, 13, 'Senin', 0),
(10, 2, 13, 'Selasa', 0),
(10, 3, 13, 'Rabu', 0),
(10, 4, 13, 'Kamis', 0),
(10, 5, 13, 'Jumat', 0),
(10, 6, 14, 'Sabtu', 0),
(10, 7, 13, 'Minggu', -1),
(10, 999, 13, 'Libur Umum', -1),
(11, 1, 15, 'Senin', 0),
(11, 2, 15, 'Selasa', 0),
(11, 3, 15, 'Rabu', 0),
(11, 4, 15, 'Kamis', 0),
(11, 5, 15, 'Jumat', 0),
(11, 6, 15, 'Sabtu', 0),
(11, 7, 15, 'Minggu', -1),
(11, 999, 15, 'Libur Umum', -1),
(12, 1, 16, 'Senin', 0),
(12, 2, 16, 'Selasa', 0),
(12, 3, 16, 'Rabu', 0),
(12, 4, 16, 'Kamis', 0),
(12, 5, 16, 'Jumat', 0),
(12, 6, 16, 'Sabtu', 0),
(12, 7, 16, 'Minggu', -1),
(12, 999, 16, 'Libur Umum', -1),
(13, 1, 22, 'Senin', 0),
(13, 2, 22, 'Selasa', 0),
(13, 3, 22, 'Rabu', 0),
(13, 4, 22, 'Kamis', 0),
(13, 5, 22, 'Jumat', 0),
(13, 6, 23, 'Sabtu', 0),
(13, 7, 22, 'Minggu', -1),
(13, 999, 22, 'Libur Umum', -1),
(14, 1, 24, 'Senin', 0),
(14, 2, 24, 'Selasa', 0),
(14, 3, 24, 'Rabu', 0),
(14, 4, 24, 'Kamis', 0),
(14, 5, 24, 'Jumat', 0),
(14, 6, 24, 'Sabtu', 0),
(14, 7, 24, 'Minggu', -1),
(14, 999, 24, 'Libur Umum', -1),
(15, 1, 31, 'Senin', 0),
(15, 2, 31, 'Selasa', 0),
(15, 3, 31, 'Rabu', 0),
(15, 4, 31, 'Kamis', 0),
(15, 5, 31, 'Jumat', 0),
(15, 6, 31, 'Sabtu', 0),
(15, 7, 31, 'Minggu', -1),
(15, 999, 31, 'Libur Umum', -1),
(16, 1, 25, 'Senin', 0),
(16, 2, 25, 'Selasa', 0),
(16, 3, 25, 'Rabu', 0),
(16, 4, 25, 'Kamis', 0),
(16, 5, 26, 'Jumat', 0),
(16, 6, 25, 'Sabtu', -1),
(16, 7, 29, 'Minggu', 0),
(16, 999, 25, 'Libur Umum', -1),
(17, 1, 25, 'Senin', 0),
(17, 2, 25, 'Selasa', 0),
(17, 3, 25, 'Rabu', 0),
(17, 4, 25, 'Kamis', 0),
(17, 5, 26, 'Jumat', 0),
(17, 6, 28, 'Sabtu', 0),
(17, 7, 25, 'Minggu', -1),
(17, 999, 25, 'Libur Umum', -1),
(18, 1, 25, 'Senin', 0),
(18, 2, 25, 'Selasa', 0),
(18, 3, 25, 'Rabu', 0),
(18, 4, 25, 'Kamis', 0),
(18, 5, 27, 'Jumat', 0),
(18, 6, 28, 'Sabtu', 0),
(18, 7, 25, 'Minggu', -1),
(18, 999, 25, 'Libur Umum', -1),
(19, 1, 25, 'Senin', 0),
(19, 2, 25, 'Selasa', 0),
(19, 3, 25, 'Rabu', 0),
(19, 4, 25, 'Kamis', 0),
(19, 5, 27, 'Jumat', 0),
(19, 6, 25, 'Sabtu', -1),
(19, 7, 30, 'Minggu', 0),
(19, 999, 25, 'Libur Umum', -1);

-- --------------------------------------------------------

--
-- Table structure for table `jdw_kerja_m`
--

CREATE TABLE IF NOT EXISTS `jdw_kerja_m` (
  `jdw_kerja_m_id` int(11) NOT NULL DEFAULT '0',
  `jdw_kerja_m_kode` varchar(5) DEFAULT NULL,
  `jdw_kerja_m_name` varchar(100) DEFAULT NULL,
  `jdw_kerja_m_keterangan` varchar(255) DEFAULT NULL,
  `jdw_kerja_m_periode` smallint(6) DEFAULT '0',
  `jdw_kerja_m_mulai` date DEFAULT NULL,
  `jdw_kerja_m_type` tinyint(3) DEFAULT '0' COMMENT '0: Normal; 1: Pola; 2: Auto',
  `use_sama` tinyint(3) DEFAULT '-1' COMMENT 'Jam kerja setiap hari sama / tidak',
  PRIMARY KEY (`jdw_kerja_m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `jdw_kerja_m`
--

INSERT INTO `jdw_kerja_m` (`jdw_kerja_m_id`, `jdw_kerja_m_kode`, `jdw_kerja_m_name`, `jdw_kerja_m_keterangan`, `jdw_kerja_m_periode`, `jdw_kerja_m_mulai`, `jdw_kerja_m_type`, `use_sama`) VALUES
(1, '5A', '5A', '5 hari kerja - shift I', 7, '2016-05-30', 0, -1),
(2, '5B', '5B', '5 hari kerja - shift II', 7, '2016-05-30', 0, -1),
(3, '6A', '6A', '6 hari kerja - shift I', 7, '2016-05-30', 0, -1),
(4, '6B', '6B', '6 hari kerja - shift II', 7, '2016-05-30', 0, -1),
(5, 'P12S1', 'Proses I & II Shift 1', '', 7, '2016-05-30', 0, -1),
(6, '6C', '6C', '6 hari kerja - shift III', 7, '2016-05-30', 0, -1),
(7, '5S', '5S', '5 hari kerja - staf', 7, '2016-05-30', 0, -1),
(8, 'P12S2', 'Proses I & II Shift 2', '', 7, '2016-05-30', 0, -1),
(9, 'J16AB', 'J16AB', '', 7, '2016-05-30', 0, -1),
(10, 'J16CD', 'J16CD', '', 7, '2016-05-30', 0, -1),
(11, 'J16E', 'J16E', '', 7, '2016-05-30', 0, -1),
(12, 'J16F', 'J16F', '', 7, '2016-05-30', 0, -1),
(13, 'J26AB', 'J26AB', '', 7, '2016-05-30', 0, -1),
(14, 'J26C', 'J26C', '', 7, '2016-05-30', 0, -1),
(15, 'J3G', 'J3G', '', 7, '2016-05-30', 0, -1),
(16, 'J3ABE', 'J3ABE', '', 7, '2016-05-30', 0, -1),
(17, 'J3ABD', 'J3ABD', '', 7, '2016-05-30', 0, -1),
(18, 'J3ACD', 'J3ACD', '', 7, '2016-05-30', 0, -1),
(19, 'J3ACF', 'J3ACF', '', 7, '2016-05-30', 0, -1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jdw_kerja_d`
--
ALTER TABLE `jdw_kerja_d`
  ADD CONSTRAINT `jdw_kerja_d_ibfk_1` FOREIGN KEY (`jdw_kerja_m_id`) REFERENCES `jdw_kerja_m` (`jdw_kerja_m_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

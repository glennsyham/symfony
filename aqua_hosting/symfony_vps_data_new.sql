-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2016 at 09:49 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony_vps`
--

--
-- Dumping data for table `vps_os`
--

INSERT INTO `vps_os` (`id`, `name`, `server_id`, `platform_id`, `sort_order`) VALUES
(1, 'Linux Centos 5.x 64 Bit', 1, 1, 4),
(2, 'Windows 2008 R2 64 Bit Datacenter', 2, 2, 1),
(6, 'Linux Ubuntu 10.10 64 Bit', 1, 1, 10),
(7, 'Linux Centos 6.x 64 Bit', 1, 1, 2),
(8, 'Linux Debian 6.x 64 Bit', 1, 1, 6),
(9, 'Linux Centos 5.x 32 Bit', 1, 1, 5),
(10, 'Linux Centos 6.x 32 Bit', 1, 1, 3),
(11, 'Linux Debian 6.x 32 Bit', 1, 1, 7),
(12, 'Linux Ubuntu 10.10 32 Bit', 1, 1, 11),
(13, 'Linux Ubuntu 12.04 64 Bit', 1, 1, 8),
(14, 'Linux Ubuntu 12.04 32 Bit', 1, 1, 9),
(15, 'Linux Ubuntu 10.04 64 Bit', 1, 1, 12),
(16, 'Linux Ubuntu 10.04 32 Bit', 1, 1, 13),
(17, 'Windows 2012 64 Bit Datacenter', 3, 2, 1);

--
-- Dumping data for table `remote_backup`
--

INSERT INTO `remote_backup` (`id`, `r_name`, `description`, `price`, `sort_order`) VALUES
(1, 'R1Soft Remote Backup 20Gb', 'R1Soft Remote Backup 20Gb', '10.00', 1),
(2, 'R1Soft Remote Backup 50Gb', 'R1Soft Remote Backup 50Gb', '25.00', 2),
(3, 'R1Soft Remote Backup 100Gb', 'R1Soft Remote Backup 100Gb', '40.00', 3),
(4, 'R1Soft Remote Backup 150Gb', 'R1Soft Remote Backup 150Gb', '50.00', 4),
(5, 'R1Soft Remote Backup 200Gb', 'R1Soft Remote Backup 200Gb', '65.00', 5),
(6, 'R1Soft Remote Backup 250Gb', 'R1Soft Remote Backup 250Gb', '80.00', 6),
(7, 'R1Soft Remote Backup 500Gb', 'R1Soft Remote Backup 500Gb', '150.00', 7);

--
-- Dumping data for table `vps_cpanel`
--

INSERT INTO `vps_cpanel` (`id`, `vps_cpanel_desc`, `vps_cpanel_price`) VALUES
(1, 'cPanel/WHM Unlimited', '14.00'),
(2, 'cPanel/WHM Unlimited + WHMCS', '28.00'),
(3, 'cPanel/WHM Unlimited + WHMCS(Hosting Automation)', '28.00'),
(4, 'Enkompass by cPanel(license only, client install)', '0.00'),
(5, 'Plesk 10 Domains', '4.00'),
(6, 'Plesk 10 Domains+PowerPack', '9.00'),
(7, 'Plesk 10 Domains+PowerPack(includes MSSQL)', '9.00'),
(8, 'Plesk 100 Domains', '7.00'),
(9, 'Plesk 100 Domains+PowerPack', '12.00'),
(10, 'Plesk 100 Domains+PowerPack(includes MSSQL)', '12.00'),
(11, 'Plesk 30 Domains', '5.00'),
(12, 'Plesk 30 Domains+PowerPack', '10.00'),
(13, 'Plesk 30 Domains+PowerPack(includes MSSQL)', '10.00'),
(14, 'Plesk 300 Domains', '9.00'),
(15, 'Plesk 300 Domains+PowerPack', '14.00'),
(16, 'Plesk 300 Domains+PowerPack(includes MSSQL)', '14.00'),
(17, 'Plesk Unlimited Domains', '10.00'),
(18, 'Plesk Unlimited Domains+PowerPack', '15.00'),
(19, 'Plesk Unlimited Domains+PowerPack(includes MSSQL)', '15.00'),
(20, 'Plesk Unlimited+SiteBuilder+Billing 1000', '10.00'),
(21, 'Plesk Unlimited+SiteBuilder+Billing 1000+PowerPack', '15.00'),
(22, 'Plesk Unlimited+SiteBuilder+Billing 1000+PowerPack(includes MSSQL)', '16.00'),
(23, 'Plesk Unlimited+SiteBuilder+Billing 1000+PowerPackPlesk Unlimited+SiteBuild', '15.00');



--
-- Dumping data for table `vps_database`
--

INSERT INTO `vps_database` (`id`, `platform`, `desc`, `price`, `sort_order`) VALUES
(1, 1, 'MySQL for Linux', '0.00', 1),
(2, 1, 'MariaDB for Linux', '0.00', 1),
(3, 1, 'MongoDB for Linux', '0.00', 1),
(4, 1, 'PostgreSQL for Linux', '0.00', 1),
(5, 2, 'MySQL for Windows', '0.00', 1),
(6, 2, 'MSSQL 2008 R2 Web Edition', '5.00', 1),
(7, 2, 'MSSQL 2008 R2 Standard Edition', '10.00', 1),
(8, 2, 'MSSQL 2008 R2 Enterprise Edition', '15.00', 1);

--
-- Dumping data for table `vps_packages`
--

INSERT INTO `vps_packages` (`id`, `type`, `desc`, `unit`, `price`) VALUES
(1, 'cpu', 'cpu unit price', 1, '3.00'),
(2, 'hd', 'hd unit price', 1, '3.00'),
(3, 'ip', 'ip unit price', 1, '2.00'),
(4, 'ram', 'ram unit price', 1, '3.00');

--
-- Dumping data for table `vps_cpanel_conn`
--

INSERT INTO `vps_cpanel_conn` (`id`, `vpscpanel_id`, `vpsos_id`) VALUES
(1, 1, 1),
(2, 1, 7),
(3, 1, 9),
(4, 1, 10),
(5, 2, 1),
(6, 2, 7),
(7, 2, 9),
(8, 3, 10),
(9, 4, 2),
(10, 4, 17),
(11, 5, 1),
(12, 5, 2),
(13, 5, 7),
(14, 5, 11),
(15, 5, 10),
(16, 5, 6),
(17, 5, 15),
(18, 5, 16),
(19, 5, 17),
(20, 6, 1),
(21, 6, 15),
(22, 6, 6),
(23, 6, 16),
(24, 6, 7),
(25, 7, 2),
(26, 7, 10),
(27, 7, 17),
(28, 8, 1),
(29, 8, 2),
(30, 8, 6),
(31, 8, 7),
(32, 8, 8),
(33, 8, 9),
(34, 8, 10),
(35, 8, 11),
(36, 8, 17),
(37, 9, 1),
(38, 9, 6),
(39, 9, 7),
(40, 9, 8),
(41, 9, 9),
(42, 9, 10),
(43, 10, 2),
(44, 10, 17),
(45, 11, 1),
(46, 11, 2),
(47, 11, 6),
(48, 11, 7),
(49, 11, 8),
(50, 11, 9),
(51, 11, 10),
(52, 11, 11),
(53, 11, 17),
(54, 12, 1),
(55, 12, 6),
(56, 12, 7),
(57, 12, 8),
(58, 12, 9),
(59, 12, 10),
(60, 13, 2),
(61, 13, 17),
(62, 14, 1),
(63, 14, 2),
(64, 14, 6),
(65, 14, 7),
(66, 14, 8),
(67, 14, 9),
(68, 14, 10),
(69, 14, 17),
(70, 15, 1),
(71, 15, 6),
(72, 15, 7),
(73, 15, 8),
(74, 15, 9),
(75, 15, 10),
(76, 16, 2),
(77, 16, 17),
(78, 17, 1),
(79, 17, 2),
(80, 17, 6),
(81, 17, 7),
(82, 17, 8),
(83, 17, 9),
(84, 17, 10),
(85, 17, 17),
(86, 18, 1),
(87, 18, 6),
(88, 18, 7),
(89, 18, 8),
(90, 18, 9),
(91, 18, 10),
(92, 19, 2),
(93, 19, 17),
(94, 20, 1),
(95, 20, 2),
(96, 20, 6),
(97, 20, 7),
(98, 20, 8),
(99, 20, 9),
(100, 20, 10),
(101, 20, 17),
(102, 21, 1),
(103, 21, 7),
(104, 21, 8),
(105, 21, 9),
(106, 21, 10),
(107, 22, 2),
(108, 22, 17),
(109, 23, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

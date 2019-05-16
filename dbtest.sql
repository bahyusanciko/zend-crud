-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2019 at 12:11 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `kd_admin` int(50) NOT NULL,
  `username_admin` varchar(50) NOT NULL,
  `password_admin` varchar(256) NOT NULL,
  `nama_admin` varchar(100) DEFAULT NULL,
  `email_admin` varchar(50) DEFAULT NULL,
  `no_hp_admin` varchar(50) DEFAULT NULL,
  `img_admin` varchar(256) DEFAULT NULL,
  `level_admin` int(11) DEFAULT NULL,
  `create_date_admin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`kd_admin`, `username_admin`, `password_admin`, `nama_admin`, `email_admin`, `no_hp_admin`, `img_admin`, `level_admin`, `create_date_admin`) VALUES
(1, 'admin', '$2y$10$/QU9h5JnAxk/KqHkXg6Q0u5LsPLu1pHHdHGnD/WtlKyGRak5amLjm', 'aku ', 'b@gmail.com', '89682261128', 'assets/dist/img/default.png', 2, '0000-00-00 00:00:00'),
(17, 'bahyu', '$2y$10$g.Tg3eAcI8F7jOdo0k2CluwhUPKRDWB74rLimW3OFm/zRsddfdqPW', 'mereka', 'a@gmail.com', '564564564', 'assets/dist/img/default.png', 1, '2019-05-06 08:30:11'),
(27, 'saya', '$2y$10$GXYGAOrLOBjsBT/MhqQz3eSykWgsGxyjQhjR8MLugolm.U50MmRpK', 'sayadasdas', 's@gmail.com', '5644', 'assets/dist/img/default.png', 1, '2019-05-13 04:49:34'),
(31, 'tes', '$2y$10$6ZuY6XWzkCb0VgywFpo4v.kbSKE1s3qxTegEt7p5vU0YS25xFu5yy', 'test', 'abc@gmai.com', '0877', 'assets/dist/img/default.png', 1, '2019-05-13 11:45:42'),
(32, 'dasdsa', '$2y$10$feOjfoeVftAC0i3mv2EFAum70cIT/LTpVPWh7vMwPq05ZOLB7crHS', 'dasdas', 'dasdas@gmail.com', 'asdasddas', 'assets/dist/img/default.png', 1, '2019-05-14 03:42:38'),
(33, 'das', '$2y$10$XuOgIOGb3nEC1Fl6xocyP.0LYh04Eq8tM64xTuCXGCswzHNnAIzMW', 'das', 'das@gmail.com', 'adsdas', 'assets/dist/img/default.png', 1, '2019-05-14 04:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `kd_department` int(11) NOT NULL,
  `nama_department` varchar(100) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`kd_department`, `nama_department`) VALUES
(1, 'IT'),
(2, 'Sales'),
(3, 'Finance'),
(4, 'Adminstartor'),
(6, 'GA'),
(40, 'HRD'),
(41, 'Procrutment');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `kd_jabatan` int(11) NOT NULL,
  `kd_department` int(11) DEFAULT NULL,
  `nama_jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`kd_jabatan`, `kd_department`, `nama_jabatan`) VALUES
(1, 1, 'IT Manager'),
(2, 1, 'IT Software'),
(3, 1, 'IT Analis'),
(4, 1, 'IT System'),
(5, 2, 'Telemarketing'),
(6, 1, 'IT QA'),
(7, 3, 'Akunting'),
(10, 40, 'Recrutment'),
(11, 41, 'Internal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`kd_admin`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`kd_department`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`kd_jabatan`),
  ADD KEY `kd_department` (`kd_department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `kd_admin` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `kd_department` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `kd_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

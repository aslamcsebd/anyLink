-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2020 at 12:07 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `any_link`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(50) NOT NULL,
  `adminId` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminId`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `item_url`
--

CREATE TABLE `item_url` (
  `id` int(100) NOT NULL,
  `itemName` varchar(191) NOT NULL,
  `description` varchar(191) NOT NULL,
  `visiteLink` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_url`
--

INSERT INTO `item_url` (`id`, `itemName`, `description`, `visiteLink`) VALUES
(105, 'Facebook', 'Facebook website', 'https://www.facebook.com/'),
(106, 'Instagram', 'Instagram website', 'https://www.instagram.com/'),
(107, 'Twitter', 'Twitter website', 'https://twitter.com/explore'),
(108, 'Skype', 'Skype website', 'https://www.skype.com/en/'),
(109, 'Linkedin', 'Linkedin website', 'https://www.linkedin.com/home'),
(110, 'Freelancer', 'Freelancer website', 'https://www.freelancer.com/?w=f&ngsw-bypass='),
(111, 'Fiverr', 'Fiverr website', 'https://www.fiverr.com/'),
(112, 'Upwork', 'Upwork website', 'https://www.upwork.com/'),
(113, 'Youtube', 'Youtube website', 'https://www.youtube.com/'),
(114, 'Github', 'Github website', 'https://github.com/'),
(115, 'NHK world', 'NHK world TV', 'https://www3.nhk.or.jp/nhkworld/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_url`
--
ALTER TABLE `item_url`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_url`
--
ALTER TABLE `item_url`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

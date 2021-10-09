-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2021 at 02:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anylink`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` tinyint(50) NOT NULL COMMENT '0=Unpublish, 1=Publish',
  `name` varchar(100) NOT NULL,
  `description` varchar(191) NOT NULL,
  `url` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `userId`, `status`, `name`, `description`, `url`) VALUES
(2, 1, 0, 'Instagram', 'Instagram website', 'https://www.instagram.com/'),
(3, 1, 0, 'Twitter', 'Twitter website', 'https://twitter.com/explore'),
(4, 1, 0, 'Skype', 'Skype website', 'https://www.skype.com/en/'),
(5, 1, 0, 'Linkedin', 'Linkedin website', 'https://www.linkedin.com/home'),
(6, 1, 0, 'Freelancer', 'Freelancer website', 'https://www.freelancer.com/?w=f&ngsw-bypass='),
(7, 1, 0, 'Fiverr', 'Fiverr website', 'https://www.fiverr.com/'),
(8, 1, 0, 'Upwork', 'Upwork website', 'https://www.upwork.com/'),
(9, 1, 0, 'Youtube', 'Youtube website', 'https://www.youtube.com/'),
(10, 1, 0, 'Github', 'Github website', 'https://github.com/'),
(11, 1, 0, 'NHK world', 'NHK world TV', 'https://www3.nhk.or.jp/nhkworld/');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `email`, `password`) VALUES
(1, 'Aslam', 'aslamcsebd@gmail.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

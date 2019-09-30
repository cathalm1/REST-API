-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2019 at 01:17 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ReadingList`
--

-- --------------------------------------------------------

--
-- Table structure for table `ReadingList`
--

CREATE TABLE `ReadingList` (
  `id` int(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ReadingList`
--

INSERT INTO `ReadingList` (`id`, `date`, `name`, `url`, `description`) VALUES
(1, '2019-05-01 10:45:26', 'Maynooth University', 'www.MaynoothUniversity.ie', 'Computer Science in Maynooth'),
(2, '2019-05-01 10:45:29', 'Discover Ireland', 'www.DiscoverIreland.ie', 'Information for tourists visiting Ireland'),
(5, '2019-05-01 11:13:31', 'Twitter News', 'https://twitter.com/twitternews?lang=en', 'Breaking news from around the world.'),
(6, '2019-05-01 11:16:08', 'Prims Algorthim', 'https://en.wikipedia.org/wiki/Prim%27s_algorithm', 'An algorthim that can be used to find minimum spanning tree. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ReadingList`
--
ALTER TABLE `ReadingList`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ReadingList`
--
ALTER TABLE `ReadingList`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

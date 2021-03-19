-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 05:34 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intertransfer`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `coursename` text NOT NULL,
  `faculty` varchar(150) NOT NULL,
  `cluster_point` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `coursename`, `faculty`, `cluster_point`) VALUES
(1, 'agricultural economics', 'faes', 25.23),
(2, 'environmental science', 'faes', 27.4),
(3, 'soil science', 'faes', 30.72),
(4, 'agricultural education', 'faes', 24.21),
(5, 'agriculture and natural resources', 'faes', 29.85),
(6, 'mass media and communication', 'fahu', 23.27),
(7, 'tourism', 'fahu', 26.13),
(8, 'eco-tourism', 'fahu', 25.2),
(9, 'international relations', 'fahu', 25.8),
(10, 'biology and chemistry', 'fared', 20.23),
(11, 'english and literature', 'fared', 39.26),
(12, 'geography and pysics', 'fared', 21.27),
(13, 'history and religion', 'fared', 23.43),
(14, 'maths and physics', 'fared', 35.03),
(15, 'commerce', 'fbust', 26.45),
(16, 'economics and statistics', 'fbust', 41.03),
(17, 'procurement and logistics', 'fbust', 42.03),
(18, 'business management', 'fbust', 25.03),
(19, 'computer_science', 'fset', 35.03),
(20, 'applied computer science', 'fset', 32.03),
(21, 'nursing', 'fset', 33.03),
(22, 'biochemistty', 'fset', 41.03),
(23, 'biomedicine', 'fset', 25.73),
(24, 'food science', 'fset', 27.69);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`) VALUES
(1, 'faes'),
(2, 'fahu'),
(3, 'fared'),
(4, 'fbust'),
(5, 'fset');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `regno` varchar(13) NOT NULL,
  `f_name` varchar(15) NOT NULL,
  `s_name` varchar(15) NOT NULL,
  `course` int(11) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `cluster_points` float NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`regno`, `f_name`, `s_name`, `course`, `faculty`, `cluster_points`, `password`) VALUES
('eb1/26243/16', 'steven', 'ondieki', 19, 'fset', 35.44, '0000'),
('eb1/26243/17', 'test', 'user', 20, 'fset', 31.99, '0000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

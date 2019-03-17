-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2019 at 05:50 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videohut`
--

-- --------------------------------------------------------

--
-- Table structure for table `moviecollection`
--

CREATE TABLE `moviecollection` (
  `movie_id` int(5) NOT NULL,
  `moviePoster` varchar(50) NOT NULL,
  `movieTitle` varchar(25) NOT NULL,
  `year` int(4) NOT NULL,
  `genre` varchar(10) NOT NULL,
  `language` varchar(10) NOT NULL,
  `movieCertificate` char(125) DEFAULT NULL,
  `rating` int(1) NOT NULL,
  `qtyAvailable` int(1) NOT NULL DEFAULT '5',
  `qtyRented` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moviecollection`
--

INSERT INTO `moviecollection` (`movie_id`, `moviePoster`, `movieTitle`, `year`, `genre`, `language`, `movieCertificate`, `rating`, `qtyAvailable`, `qtyRented`) VALUES
(100, 'images/westminster.jpg', 'My Uni', 1997, 'Humor', 'English', '-', 4, 5, 0),
(101, 'images/bladerunner.jpg', 'Blade Runner', 2018, 'Adventure', 'French', '-', 2, 0, 5),
(102, 'images/harry.jpg', 'Harry Potter', 2004, 'Adventure', 'English', '-', 5, 3, 2),
(103, 'images/holmes.jpg', 'Holmes Watson', 1997, 'Humor', 'English', '-', 4, 5, 0),
(104, 'images/cinderella.jpg', 'Cinderella', 2018, 'Adventure', 'Sinhala', '-', 3, 5, 0),
(105, 'images/nun.jpg', 'Nun', 2014, 'Horror', 'English', '-', 4, 5, 0),
(106, 'images/ravana.jpg', 'Narnia', 2004, 'Classic', 'French', '-', 3, 5, 0),
(107, 'images/uni.jpg', 'High School Musical', 2006, 'Humor', 'English', '-', 4, 4, 1),
(108, 'images/cinderella2.jpg', 'Cinderella Two', 2018, 'Adventure', 'Sinhala', '-', 3, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rental`
--

CREATE TABLE `rental` (
  `rental_id` int(5) NOT NULL,
  `users_id` int(5) NOT NULL,
  `videoCopy_id` int(5) NOT NULL,
  `movie_id` int(5) NOT NULL,
  `burrowedDate` date NOT NULL,
  `expectedReturnDate` date NOT NULL,
  `isReturned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental`
--

INSERT INTO `rental` (`rental_id`, `users_id`, `videoCopy_id`, `movie_id`, `burrowedDate`, `expectedReturnDate`, `isReturned`) VALUES
(49, 3, 1012, 101, '2018-04-01', '2018-11-22', 1),
(51, 3, 1011, 101, '2018-11-01', '2018-11-08', 1),
(52, 2, 1012, 101, '2018-11-01', '2018-11-08', 0),
(55, 2, 1014, 101, '2018-05-01', '2018-05-22', 0),
(56, 3, 1013, 101, '2018-08-01', '2018-08-22', 0),
(57, 2, 1021, 102, '2018-08-01', '2018-08-22', 0),
(58, 2, 1011, 101, '2018-11-01', '2018-11-08', 0),
(59, 2, 1015, 101, '2018-11-01', '2018-11-08', 0),
(77, 2, 1022, 102, '2019-01-02', '2019-01-09', 1),
(79, 2, 1011, 107, '2019-01-02', '2019-01-09', 1),
(90, 2, 1033, 103, '2019-01-02', '2019-01-09', 1),
(91, 2, 1015, 101, '2019-01-03', '2019-01-10', 1),
(106, 2, 1023, 102, '2019-01-03', '2019-01-10', 0),
(107, 2, 1052, 105, '2019-01-03', '2019-01-10', 1),
(113, 2, 1041, 104, '2019-01-03', '2019-01-10', 1),
(123, 2, 1062, 106, '2019-01-03', '2019-01-10', 1),
(126, 3, 1051, 105, '2019-01-04', '2019-01-11', 1),
(127, 2, 1023, 107, '2019-01-04', '2019-01-11', 0),
(129, 2, 1023, 108, '2019-01-04', '2019-01-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstName` char(100) NOT NULL,
  `lastName` char(100) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `DOB` date DEFAULT NULL,
  `phoneNumber` int(10) NOT NULL,
  `address` char(35) NOT NULL,
  `country` varchar(15) NOT NULL,
  `state` varchar(15) NOT NULL,
  `zip` varchar(5) DEFAULT NULL,
  `isMember` tinyint(1) DEFAULT '1',
  `isAdmin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `username`, `password`, `firstName`, `lastName`, `email`, `DOB`, `phoneNumber`, `address`, `country`, `state`, `zip`, `isMember`, `isAdmin`) VALUES
(1, 'admin', '123', 'Adminstrator', '', 'admin@gmail.com', '2018-12-01', 9888888, '45', '', '', '', 0, 1),
(2, 'Oshadhi', '123', 'Oshadhi', 'Vanodhya', 'oshadhi.2015078@iit.ac.lk', '2016-06-01', 996868858, 'No/56,', 'Sri Lanka', 'Western', '10120', 1, 0),
(3, 'Thara', '123', 'Tharukie', 'Ayodhya', 'tharukie@gf.com', '2014-06-10', 996868858, 'No/56, Rajagiriya', 'Sri Lanka', 'Western', NULL, 1, 0),
(68, 'sara', '123', 'Sara', 'Mia', 'oshadhi.vanodhya@outlook.com', '1997-01-09', 3333333, '1234 Main Street', 'Sri Lanka', 'Western', '78', 1, 0),
(69, 'Mia', '123', 'Mia', 'Khalifa', 'w1583175@westminster.ac.uk', '2019-01-01', 454545, '1234 Main Street', 'India', 'Central', '43', 1, 0),
(70, 'Mia1', '123', 'Mia', 'Khalifa', 'w1583175@westminster.ac.uk', '2019-01-01', 454545, '1234 Main Street', 'India', 'Central', '43', 1, 0),
(71, 'Oshim', '123', 'osdf', 'Khalifa', 'w1583175@westminster.ac.uk', '2019-01-01', 454545, '1234 Main Street', 'India', 'Central', '43', 1, 0),
(72, 'shazna', '123', 'Shaz', 'Na', 'shazna@gmail.com', '1996-01-12', 909090, '52, rg', 'Sri Lanka', 'Western', '45', 0, 0),
(73, 'shaznav', '123', 'Shazv', 'Na', 'shazna@gmail.com', '1996-01-12', 909090, '52, rg', 'Sri Lanka', 'Western', '45', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `videocopy`
--

CREATE TABLE `videocopy` (
  `videoCopy_id` int(5) NOT NULL,
  `movie_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videocopy`
--

INSERT INTO `videocopy` (`videoCopy_id`, `movie_id`) VALUES
(1011, 101),
(1012, 101),
(1013, 101),
(1014, 101),
(1015, 101),
(1021, 102),
(1022, 102),
(1023, 102),
(1024, 102),
(1025, 102),
(1031, 103),
(1032, 103),
(1033, 103),
(1034, 103),
(1035, 103),
(1041, 104),
(1042, 104),
(1043, 104),
(1044, 104),
(1045, 104),
(1051, 105),
(1052, 105),
(1053, 105),
(1054, 105),
(1055, 105),
(1061, 106),
(1062, 106),
(1063, 106),
(1064, 106),
(1065, 106);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `moviecollection`
--
ALTER TABLE `moviecollection`
  ADD PRIMARY KEY (`movie_id`),
  ADD UNIQUE KEY `movie_id` (`movie_id`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`rental_id`) USING BTREE,
  ADD UNIQUE KEY `rental_id` (`rental_id`),
  ADD UNIQUE KEY `videoCopy_id` (`videoCopy_id`,`movie_id`,`isReturned`),
  ADD KEY `users_id` (`users_id`) USING BTREE,
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `users_id` (`users_id`);

--
-- Indexes for table `videocopy`
--
ALTER TABLE `videocopy`
  ADD PRIMARY KEY (`videoCopy_id`),
  ADD UNIQUE KEY `videoCopy_id` (`videoCopy_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `moviecollection`
--
ALTER TABLE `moviecollection`
  MODIFY `movie_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
  MODIFY `rental_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `videocopy`
--
ALTER TABLE `videocopy`
  MODIFY `videoCopy_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1066;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `rental_ibfk_10` FOREIGN KEY (`movie_id`) REFERENCES `moviecollection` (`movie_id`),
  ADD CONSTRAINT `rental_ibfk_3` FOREIGN KEY (`videoCopy_id`) REFERENCES `videocopy` (`videoCopy_id`);

--
-- Constraints for table `videocopy`
--
ALTER TABLE `videocopy`
  ADD CONSTRAINT `videocopy_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `moviecollection` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

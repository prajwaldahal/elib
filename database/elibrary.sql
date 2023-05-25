-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221207.ce5ce76a8d
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 25, 2023 at 10:20 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin123', 'root@123');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `aid` int(11) NOT NULL,
  `isbnno` varchar(13) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`aid`, `isbnno`, `name`) VALUES
(22, '9781234567123', 'James F.kuronse'),
(23, '9787815541', 'joseph albhari'),
(24, '9781234562', 'prajwal');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `coverpic` varchar(20) NOT NULL,
  `file` varchar(120) NOT NULL,
  `BookName` varchar(70) DEFAULT NULL,
  `publisher` varchar(70) DEFAULT NULL,
  `isbnNo` varchar(13) NOT NULL,
  `Rent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`coverpic`, `file`, `BookName`, `publisher`, `isbnNo`, `Rent`) VALUES
('1685001763.png', 'https://cloudfiles.to/0mU5B5e0eX3', 'Intrusion Presentation Slide', 'kcmit', '9781234562', 120),
('1685001429.png', 'https://cloudfiles.to/qrY12c3ZyS1', 'Computer networking', 'pearson', '9781234567123', 1000),
('1685001636.png', 'https://cloudfiles.to/jThiJcXZq7B', 'c# in a nutshell', 'orielly', '9787815541', 500);

-- --------------------------------------------------------

--
-- Table structure for table `rentedbook`
--

CREATE TABLE `rentedbook` (
  `Isbnno` varchar(13) DEFAULT NULL,
  `userName` varchar(20) DEFAULT NULL,
  `rentedDate` date DEFAULT NULL,
  `upto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rentedbook`
--

INSERT INTO `rentedbook` (`Isbnno`, `userName`, `rentedDate`, `upto`) VALUES
('9781234562', 'perfectboy', '2023-05-25', '2023-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id` varchar(35) NOT NULL,
  `pid` varchar(50) NOT NULL,
  `isbnno` varchar(13) NOT NULL,
  `username` varchar(20) NOT NULL,
  `totalPrice` int(11) NOT NULL DEFAULT 0,
  `upto` date NOT NULL DEFAULT '1990-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id`, `pid`, `isbnno`, `username`, `totalPrice`, `upto`) VALUES
('perfectboy1234562', '97812345621685002734', '9781234562', 'perfectboy', 24, '2023-05-31'),
('perfectboy1234567', '97812345671231685002457', '9781234567123', 'perfectboy', 0, '1990-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserName` varchar(20) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `Password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserName`, `Name`, `Address`, `Password`) VALUES
('perfectboy', 'subhanjal giri', 'butwal', '1234'),
('roshan@123', 'roshan sunwar', 'kathmandu', 'roshan123');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`username`, `password`) VALUES
('root', 'admin'),
('prajwal', 'root');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `isbnno` (`isbnno`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbnNo`);

--
-- Indexes for table `rentedbook`
--
ALTER TABLE `rentedbook`
  ADD KEY `Isbnno` (`Isbnno`),
  ADD KEY `userName` (`userName`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel1` (`isbnno`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`isbnno`) REFERENCES `book` (`isbnNo`);

--
-- Constraints for table `rentedbook`
--
ALTER TABLE `rentedbook`
  ADD CONSTRAINT `rentedbook_ibfk_1` FOREIGN KEY (`Isbnno`) REFERENCES `book` (`isbnNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rentedbook_ibfk_2` FOREIGN KEY (`userName`) REFERENCES `user` (`UserName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `temp`
--
ALTER TABLE `temp`
  ADD CONSTRAINT `rel1` FOREIGN KEY (`isbnno`) REFERENCES `book` (`isbnNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `temp_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`UserName`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

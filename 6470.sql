-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2021 at 02:05 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `6470`
--

-- --------------------------------------------------------

--
-- Table structure for table `6470exerciseusers`
--

CREATE TABLE `6470exerciseusers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` char(255) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `6470exerciseusers`
--

INSERT INTO `6470exerciseusers` (`id`, `username`, `password_hash`, `phone`) VALUES
(3, 'Cygnetthotels1', '$2y$10$.HvByweQs/DIPI678eKfjOHIteLB6gqg2cocQdhjZD9gm1zKbfine', '9911911848'),
(4, 'paul123', '$2y$10$rrDsDKQKMnrGAZkN6rQL9OpcESYYij1czPSAkZNM65wlQBgBTq8AC', '8448171046'),
(5, 'lalmohan', '$2y$10$RUKgCDFxU9cv4in/YHKl8e4UbtpVWwDdv4oiVg5ceaA64smTEftGe', '8448171046');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `6470exerciseusers`
--
ALTER TABLE `6470exerciseusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `6470exerciseusers`
--
ALTER TABLE `6470exerciseusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

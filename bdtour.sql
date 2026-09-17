-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 17, 2026 at 02:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdtour`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `package_id` int(11) NOT NULL,
  `travel_date` date NOT NULL,
  `status` enum('Pending','Confirmed','Cancelled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `username`, `package_id`, `travel_date`, `status`) VALUES
(1, 'mondol', 1, '2026-09-13', 'Cancelled'),
(3, 'mondol', 1, '2026-09-14', 'Cancelled'),
(4, 'mondol', 3, '2026-09-15', 'Cancelled'),
(5, 'mondol', 15, '2026-09-14', 'Cancelled'),
(6, 'mondol', 3, '2026-09-17', 'Confirmed'),
(7, 'mondol', 20, '2026-09-18', 'Confirmed'),
(8, 'rejowan', 24, '2026-09-25', 'Confirmed'),
(9, 'rejowan', 16, '2026-09-23', 'Cancelled'),
(10, 'rejowan', 3, '2026-09-23', 'Confirmed'),
(11, 'rejowan', 16, '2026-09-10', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `packagename` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `itinerary` text NOT NULL,
  `availability` enum('Available','Unavailable') DEFAULT 'Available',
  `approval_status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `packagename`, `price`, `duration`, `image_path`, `itinerary`, `availability`, `approval_status`) VALUES
(1, 'Sajek Tour', 9500, '3 Days 2 Nights', 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/09/bd/d1/fc/sajek.jpg?w=1200&h=1200&s=1', 'Day 1: Arrival...', 'Available', 'Approved'),
(3, 'Dhaka', 1200, '4', 'uploads/1788946189_asd.png', 'Hi', 'Available', 'Approved'),
(15, 'Dhaka', 1500, '4', 'uploads/1789058888_submit2.png', 'asd', 'Available', 'Approved'),
(16, 'Dhaka', 1700, '4', 'uploads/1789058972_submit2.png', 'asd', 'Available', 'Approved'),
(24, 'AIUB', 10, '1', 'uploads/1789332000_Raspberry Pi Foundation.jpeg', 'ADS', 'Available', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `division` varchar(50) DEFAULT NULL,
  `road_street` text DEFAULT NULL,
  `post_code` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `country`, `division`, `road_street`, `post_code`, `username`, `password`, `role`) VALUES
(1, 'Frank', 'Mondol', 'Male', 'admin@bdtour.com', '01711000001', 'Bangladesh', 'Dhaka', 'Banani Road 11', '1213', 'frank', '123', 'admin'),
(2, 'Heaven', 'Mondol', 'Male', 'sales@bdtour.com', '01711000422', 'Bangladesh', 'Sylhet', 'Zindabazar', '3100', 'heaven', '123', 'sales'),
(3, 'Mondol', 'Mondol', 'Male', 'customer@gmail.com', '01711000003', 'Bangladesh', 'Chittagong', 'GEC Circle', '4000', 'mondol', '123', 'customer'),
(4, 'Rejowan', 'Shadid', 'Male', 'abc.aiub@gmail.com', '01711000456', 'Nepal', 'Dhaka', 'asd', '1212', 'shadid', '123', 'sales'),
(5, 'Shadid', 'Shadid', 'Male', 'shadid.aiub@gmail.com', '01711000002', 'Bangladesh', 'Dhaka', 'asd', '1212', 'rejowan', '123', 'customer'),
(6, 'Preeti', 'Preeti', 'Female', 'frank.heaven.aiub@gmail.com', '01711000002', 'Bangladesh', 'Dhaka', 'asd', 'asd', 'preeti', '123', 'customer'),
(7, 'Rejowan', 'Shadid', 'Male', 'rejowanalshadid39@gmail.com', '01711111111', 'Bangladesh', 'Dhaka', '11', '11', 'shad', '123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
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
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

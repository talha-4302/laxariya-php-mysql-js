-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 04:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hbw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`username`, `password`) VALUES
('talha', 'talha123');

-- --------------------------------------------------------

--
-- Table structure for table `booking_info`
--

CREATE TABLE `booking_info` (
  `room_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `booking_info`
--

INSERT INTO `booking_info` (`room_id`, `username`) VALUES
(101, 'talha'),
(106, 'jamal123'),
(104, 'talha'),
(102, 'talha'),
(103, 'talha');

-- --------------------------------------------------------

--
-- Table structure for table `room_info`
--

CREATE TABLE `room_info` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_desc` text NOT NULL,
  `room_price` int(11) NOT NULL,
  `room_catagory` varchar(100) NOT NULL,
  `room_condition` varchar(40) NOT NULL,
  `room_image` varchar(2000) NOT NULL,
  `room_status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room_info`
--

INSERT INTO `room_info` (`room_id`, `room_name`, `room_desc`, `room_price`, `room_catagory`, `room_condition`, `room_image`, `room_status`) VALUES
(102, 'Executive Cityscape Room\r\n', 'Experience urban elegance and modern comfort in the heart of the city.\r\n\r\n', 199, 'Executive', 'NON-AC', '\"assets/room-2.jpg\"\r\n', 'Booked'),
(103, 'Family Garden Retreat\r\n', 'Spacious and inviting, perfect for creating cherished memories with loved ones.\r\n\r\n', 299, 'Family', 'AC', '\"assets/room-3.jpg\"', 'Booked'),
(104, 'Family Garden Retreat', 'Spacious and inviting, perfect for creating cherished memories with loved ones.\r\n\r\n', 299, 'Family', 'NON-AC', '\"assets/room-3.jpg\"', 'Booked'),
(105, 'Executive Cityscape Room\r\n', 'Experience urban elegance and modern comfort in the heart of the city.\r\n\r\n', 199, 'Executive', 'NON-AC', '\"assets/room-2.jpg\"\r\n', 'Unbooked'),
(106, 'Sunset View', 'Enjoy the sunset from the balcony & spend a memorable evening.', 200, 'Super Deluxe', 'AC', '\"assets/room-1.jpg\"', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `nid` varchar(200) NOT NULL,
  `age` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `username`, `password`, `name`, `email`, `phone`, `address`, `nid`, `age`) VALUES
(1, 'talha', 'talha123', 'Muhammad Talha', 'talha15-4302@diu.edu.bd', '01863118395', 'Maymensingh', '1111', '24'),
(11, 'jamal123', 'jamalabc', 'Muhammad Jamal', 'jamal16-4302@diu.edu.bd', '0191222110', 'Rajshahi', '991001222111', '45'),
(30, 'jamil234', 'jamil123', 'Jamil Sadat', 'b@gmail.com', '01863118395', 'Sylhet', '11100001111', '19'),
(31, 'anis1234', 'abc', 'Anis Islam', 'anis1234@gmail.com', '0191212110113', 'Sylhet', '1011001', '39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `room_info`
--
ALTER TABLE `room_info`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `room_info`
--
ALTER TABLE `room_info`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

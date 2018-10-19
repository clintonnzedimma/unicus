-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2018 at 11:43 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recozee`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room_bookings`
--

CREATE TABLE `hotel_room_bookings` (
  `id` int(255) NOT NULL,
  `arrival` varchar(255) NOT NULL,
  `departure` varchar(255) NOT NULL,
  `number_of_persons` int(255) NOT NULL,
  `extra_details` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cost` int(255) NOT NULL,
  `slip_voucher` varchar(255) NOT NULL,
  `slip_pin` varchar(255) NOT NULL,
  `time_of_booking` varchar(255) NOT NULL,
  `date_of_booking` varchar(255) NOT NULL,
  `date_of_process` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `room_id` int(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel_room_bookings`
--

INSERT INTO `hotel_room_bookings` (`id`, `arrival`, `departure`, `number_of_persons`, `extra_details`, `full_name`, `email`, `cost`, `slip_voucher`, `slip_pin`, `time_of_booking`, `date_of_booking`, `date_of_process`, `status`, `room_id`, `phone`) VALUES
(1, '2018-09-15', '2018-09-19', 3, 'none', 'Jack Sydney', 'jack@test.com', 10000, 'C3E87-5B9AD', '7225', '22:55', '2018-09-13', '', '', 1, '07026231012');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotel_room_bookings`
--
ALTER TABLE `hotel_room_bookings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotel_room_bookings`
--
ALTER TABLE `hotel_room_bookings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

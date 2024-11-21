-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 16, 2018 at 05:30 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toditoraja`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_topic` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `venue` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `short_details` varchar(255) NOT NULL,
  `full_details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `events` (`event_topic`, `image`, `venue`, `date`, `time`, `short_details`, `full_details`) VALUES
('Toraja Cultural Festival', 'https://th.bing.com/th/id/OIP.3oZaVCQoFtkNf7TDkeLahwHaE6?w=292&h=193&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Rantepao', '2024-11-05', '08:00:00', 'Celebrate Toraja culture', 'Experience traditional dances, music, and rituals of Toraja.'),
('Ma’Nene Ritual', 'https://th.bing.com/th/id/OIP.0dSrUXTIQAEiOE_qM-POVAHaEK?w=271&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Baruppu', '2024-12-10', '09:00:00', 'Honoring the Ancestors', 'A unique ancestral ritual where families clean and dress the mummified remains.'),
('Toraja Poetry Slam', 'https://th.bing.com/th/id/OIP.BhgGvlkNaKLPp9fKhMM5VQHaE7?w=226&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Makale', '2025-09-25', '18:00:00', 'Showcase of local poets', 'Open mic poetry competition for Torajan artists.'),
('Toraja Craft Fair', 'https://th.bing.com/th/id/OIP.TK0spRPaxp5WckaQgxts3wHaEl?w=276&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 'Rantepao', '2025-10-05', '10:00:00', 'Handicraft exhibition', 'Showcasing Toraja’s finest handicrafts.');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`) VALUES
(3, 'assets/img/1282be579df4c8d45861b715d7cb818c.jpg'),
(4, 'assets/img/61a4288a79b1ddb39e4a62f14b361744.jpg'),
(5, 'assets/img/a6b8705ac3ad304a92ffdd5ad7b33253.jpg'),
(6, 'assets/img/09eab40045315449141e6c40e47a8393.png'),
(7, 'assets/img/daa87a8335af717e27dd749a655aec8a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `phone` text NOT NULL,
  `people` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `checkin`, `checkout`, `phone`, `people`, `email`, `room`) VALUES
(3, 'Kelvin', '2024-12-16', '2024-12-26', '0976245430', 2, 'kelvin@gmail.com', 'Hotel Tentrem');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` varchar(255) NOT NULL,
  `rooms` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` text NOT NULL,
  `details` text NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `rooms`, `type`, `price`, `details`, `photo`) VALUES
(15, 'Victoria Falls Hotel', 20, 'Executive', '550.000', 'it is a self contained room with room service', 'images/38a42bea45f24cbe580972a30694fe4a.jpg'),
(16, 'Chita Samfya Lodge', 15, 'Regular', '450.000', 'it is a self contained room with room service', 'images/e434cecc6cfa3b049462b124681bd0b8.jpg'),
(17, 'Inter-Continental Hotel', 24, 'Executive', '650.000', 'it is a self contained room with room service.', 'images/2ff14dfea91787d539b7509427338e97.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tourism`
--

CREATE TABLE `tourism` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `photo1` text NOT NULL,
  `photo2` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `price` varchar(255) NOT NULL,
  `reservations` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

<<<<<<< HEAD
-- Dumping data for table `tourism`
--

INSERT INTO `tourism` (`id`, `title`, `photo`, `photo1`, `photo2`, `location`, `details`, `date`, `time`, `price`, `reservations`) VALUES
(4, 'Gua Lemo', 'images/0527836c3fa98cb0b57ef19e5d26ff08.png', 'images/0527836c3fa98cb0b57ef19e5d26ff08.png', 'images/0527836c3fa98cb0b57ef19e5d26ff08.png', 'Makale Utara', 'gua lemo indah', '2024-10-28', '07:00:00', '100', 95);

=======
>>>>>>> 3118a6c7dae9c8eebb86da2a6d956034bacfc69a
-- --------------------------------------------------------

--
-- Table structure for table `tour_reserves`
--

CREATE TABLE `tour_reserves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour_id` int(11) NOT NULL,
  `reservations` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `tour_reserves`
--

INSERT INTO `tour_reserves` (`id`, `tour_id`, `reservations`, `cus_name`, `email`, `phone`) VALUES
(2, 4, 'Gua Lemo', 'Kelvin', 'kelvinoktabrian@gmail.com', '0987654321');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(80) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(1, 'admin', 'admin@admin.com', 'admin123', '2024-12-13 23:12:51', '0000-00-00 00:00:00', 'editor,admin');

-- COMMIT;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 01:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_topic` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `image` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `venue` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `short_details` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `full_details` text CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_topic`, `image`, `venue`, `date`, `time`, `short_details`, `full_details`) VALUES
(92, 'Toraja International Festival', '../images/403fee16ad8046bf4c3dd237abfbc115.jpg', 'Alun-Alun Rantepao', '2024-12-01', '19:00:00', 'Perayaan  budaya international', 'Sebuah perayaan budaya megah yang menampilkan musik tradisional, tarian, dan seni, menarik wisatawan internasional untuk menikmati kekayaan warisan Toraja.'),
(93, 'Toraja Highland Festival', '../images/d28a6449b070e47fed4ac2a61146cfe3.jpeg', 'Lapangan Bakti Rantepao', '2024-12-11', '10:10:00', 'Festival seni dan musik', 'Acara tahunan yang menampilkan kuliner lokal, pertunjukan meriah, dan inovasi modern yang berpadu dengan adat tradisional.'),
(94, 'Magical Toraja Event', '../images/db50b44146213d03e3354b50fc2336a8.jpg', 'Toraja Utara', '2025-01-15', '10:00:00', 'Atraksi Budaya Magis', 'Festival memukau yang merayakan mistisisme Toraja melalui cerita rakyat, instalasi seni, dan upacara tradisional.'),
(96, 'Lovely December', '../images/4afe7929822924f09e295901411392a9.jpg', 'Tana Toraja', '2025-03-19', '08:00:00', 'Perayaan akhir tahun', 'Perayaan akhir tahun yang diwarnai dengan parade budaya, pertunjukan seni, dan bazar khas daerah.'),
(98, 'Toraja Coffee Festival', '../images/84aaf2ff9306ac88996ccfc4de53b4fc.jpeg', 'Toraja Utara', '2025-04-12', '10:00:00', 'Festival Kopi Toraja', 'Ajang yang didedikasikan untuk mempromosikan kopi lokal, pameran kuliner, dan edukasi tentang proses pembuatan kopi Toraja.'),
(99, 'Karnaval Toraja', '../images/ff1ddf1d1dd187ee0337fb6d551b3a87.jpeg', 'Buntu Burake', '2025-05-05', '07:00:00', 'Karnaval budaya meriah', 'Karnaval budaya yang meriah dengan kostum tradisional, musik, dan tarian yang memukau para pengunjung.'),
(100, 'Toraja & Beyond Festival', '../images/3956403bac537d673c020992d3ec277a.jpeg', 'Toraja', '2025-06-07', '12:00:00', 'Promosi wisata regional', 'Pameran seni dan budaya yang menampilkan seni tradisional, kerajinan, dan pertunjukan tari khas Toraja.'),
(101, 'Toraja Weaving Showcase', '../images/1779a1a94205cd48c44a91fa7cead3da.jpeg', 'Sa’dan', '2025-06-20', '10:00:00', 'Teknik tenun tradisional', 'Demontrasi proses tenun toraja yang rumit.'),
(102, 'Siguntu Art Festival', '../images/0ba851ed1242353e3170ceb505882212.jpeg', 'Rantepao', '2025-07-15', '08:30:00', 'Perayaan seni Toraja', 'Pertunjukan seni langsung, lokakarya, dan pameran.'),
(103, 'Toraja Youth Day', '../images/3231d9878d4f7dbcfd8ceedfc5e64602.jpg', 'Makale', '2025-08-10', '09:00:00', 'Acara pemuda di Toraja', 'Lokakarya, pertunjukan, dan kegiatan untuk pemuda Toraja.'),
(104, 'Londa Music Night', '../images/e7028bebaf12516d2d8bb6fd58c28685.jpeg', 'Londa', '2025-09-09', '19:00:00', 'Malam musik tradisional', 'Pertunjukan musik tradisional di gua Londa yang terkenal.'),
(105, 'Festival Layang-Layang Nasional', '../images/8647da69fd151f568740e7a42240c44b.jpeg', 'Toraja', '2025-09-25', '18:00:00', 'Kompetisi layang-layang nasional', 'Kompetisi layang-layang tingkat nasional dengan desain unik yang mempromosikan kreativitas dan budaya Toraja.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

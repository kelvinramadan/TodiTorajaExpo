-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 10:34 AM
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
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `rooms` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` text NOT NULL,
  `details` text NOT NULL,
  `photo` text NOT NULL,
  `facility1` varchar(255) NOT NULL,
  `facility2` varchar(255) NOT NULL,
  `facility3` varchar(255) NOT NULL,
  `facility4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `rooms`, `type`, `price`, `details`, `photo`, `facility1`, `facility2`, `facility3`, `facility4`) VALUES
(16, 'Melia Hotel Makassar', 11, 'Deluxe', '719000', 'Melia Hotel Makassar adalah hotel kota bintang 4 yang modern dan bergaya yang berlokasi strategis di pusat perbelanjaan kota dan kawasan bisnis komersial.', 'images/7dcf7092a1763ec8213bed8a7955ba52.jpeg', 'images/fe047f34150a08d1799d149e749a00e7.jpg', 'images/0b5d9eaffc7cd8a3e8ddd5e2b5b88939.jpg', 'images/e1eebd29905b1f87451c5b3b1dc17369.jpeg', 'images/3fd25bbd36a1d0d53b2e768c9e22a283.jpg'),
(17, 'The Rinra Hotel', 24, 'Executive', '1200000', 'The Rinra adalah hotel bintang lima yang terletak di pusat kota Makassar, menawarkan kemewahan dan kenyamanan dengan pemandangan laut yang menakjubkan.', 'images/1e9b4730fe6aaf090934ca248f462f75.jpg', 'images/de92a43a1cf7e4d75d11074a85e66c63.jpg', 'images/ec0a1eaf7c0b36f6143fc5e5842e9407.jpg', 'images/8162c3445b334f737811cc3d1c1c8311.jpg', 'images/bef3607495e9b83830d1cc696dac010f.jpg'),
(18, 'KHAS Hotel Makassar', 4, 'Regular', '518000', 'KHAS Makassar Hotel memiliki taman, lounge bersama, teras, dan restoran di Makassar. Hotel bintang 3 ini menawarkan layanan kamar dan ATM.', 'images/9e27dee549cf6ea483bfe6b3c992f93c.jpg', 'images/8d16033dfc6ce5849323c5ae53bfc9ef.jpg', 'images/ae5dfcb8be6238e9316fa28c8f954053.png', 'images/b668368c5cee4e8fa4e1e677f471cbca.jpeg', 'images/b12f93d47e952984fa14d49a7ddc74aa.jpg'),
(19, 'Claro Hotel Makassar', 9, 'Deluxe', '789000', 'Berlokasi di jantung kawasan bisnis Makassar yang berkembang pesat menawarkan 585 akomodasi dengan perabotan yang indah dan keramahan yang tak tertandingi.', 'images/ab2bc0da708609bded028e7ad7783f0a.jpeg', 'images/76626ae7b4e8dc681fb43948befc2f7b.jpg', 'images/c8bd32ba579c4b23a9d8e111b1aef9a6.jpg', 'images/025c5cecc63fba966b320c440d59b894.jpg', 'images/c08740476ee289f9b4c6361cf3dd3f90.jpeg'),
(20, 'AryaDuta Hotel', 1, 'Deluxe', '803000', 'Terletak di tepi Pantai Losari, Hotel Aryaduta Makassar menawarkan pusat kebugaran dan kamar-kamar dengan TV kabel layar datar.', 'images/e0abe97e1e25691f86618116852949cd.jpg', 'images/263d16e302f62d8e9cd47e6ca2a4a3d4.jpeg', 'images/fa4ac5df6edf97e490c01a7695a2d5f1.jpeg', 'images/e04126974d6f30f61c8b0e96da55d15a.jpg', 'images/9e99461d710542a2246b12981e88b3aa.jpg'),
(21, 'Continent Hotel', 2, 'Executive', '677500', 'Terkenal dengan lingkungannya yang ramah keluarga dan dekat dengan restoran dan atraksi terbaik, Continent Centrepoint memudahkan Anda menikmati yang terbaik dari Makassar.', 'images/b45f3415a5759924d42d47f4ec71ee3f.jpeg', 'images/5e19811989c01b145969869bcef70229.jpeg', 'images/ac794a3bc129c81c22097249470c97a7.jpg', 'images/56fdd3875b1e4f975676a41b32fcb927.jpg', 'images/0aba69405d33f1d6d36bfe42564a793e.jpg'),
(23, 'Toraja Misiliana Hotel', 6, 'Regular', '567000', 'Toraja Misiliana Hotel terletak di Rantepao, hotel ini menawarkan akomodasi dengan fasilitas modern dan suasana tradisional Toraja.', 'images/9944d87ac5065fdef7e43d74150121dd.jpeg', 'images/9932fc791eec4b7012e97af598efa012.jpg', 'images/5d4807129add33df541add7e61042c66.jpeg', 'images/5fa542938c3de0d6cc8d223d25e44201.jpg', 'images/87e521d155132bbbbd445366188ea0f6.jpeg'),
(25, 'Luta Resort Toraja', 2, 'Executive', '999000', 'Luta Resort Toraja adalah resort bintang 4 yang berlokasi di pusat kota Rantepao, menawarkan pemandangan indah sungai dan pegunungan dengan fasilitas modern dan kenyamanan yang memikat.', 'images/fdc4c61b7df63bb984ecafead1040e32.jpg', 'images/d3db0c2ecc382edd209214e2d2e2576b.jpg', 'images/2c79608ba84c84b3ababbdfeceaad550.jpeg', 'images/1247ca9ccf3bbcc448b60762228ae344.jpeg', 'images/d32a346e76dd79f734023ae761bd872a.jpeg'),
(26, 'Toraja Heritage Hotel', 7, 'Regular', '5720000', 'Toraja Heritage Hotel adalah hotel bintang 4 yang memadukan arsitektur tradisional Tongkonan dengan fasilitas modern, memberikan pengalaman budaya Toraja yang autentik di tengah lingkungan yang asri.', 'images/e9d631f43ffe4cfa098e98d341297394.jpeg', 'images/15ebe881c680daa2be899a4fb4ac6b1e.jpg', 'images/7d3bdab09ae4f789f63ece052449c262.jpeg', 'images/d21720d8255694d318dbd319c544791c.jpeg', 'images/cd8ad48f76ca40b6d2e357c257bb4e88.jpg'),
(27, 'Hotel Marante Toraja', 9, 'Regular', '598000', 'Hotel Marante Toraja adalah hotel bintang 3 yang menawarkan kenyamanan modern dengan suasana pegunungan yang tenang dan pemandangan alam yang memukau.', 'images/700d2889204270ce0c4d67c2fb48a12c.jpeg', 'images/c47f9e2f3bcdc7ec966c329f896cca5e.jpg', 'images/0788e7ff9235d6d8138909e73da98476.jpeg', 'images/43de908b8087ec84dd7f728c3c1b36ab.jpeg', 'images/26c245138c2fd3dd27fa620179bad16e.jpeg'),
(28, 'Rantepao Lodge', 10, 'Regular', '750000', 'Rantepao Lodge adalah hotel bintang 3 yang terletak di lokasi strategis dengan desain modern dan layanan ramah untuk pengalaman menginap yang menyenangkan.', 'images/039759341933bd53a69ef395410caf51.jpeg', 'images/7a4809f6b3bae5684d83aa324c7e3aec.jpg', 'images/3511d71558d9cfe568857b3df80e0655.jpg', 'images/d4d1f2a3e077cb263062f3e08abcf3e2.jpeg', 'images/43af753bc6223c390b589b4f9e6870a4.jpg'),
(29, 'Sahid Toraja', 3, 'Deluxe', '909000', 'Sahid Toraja adalah hotel bintang 3 yang terletak di perbukitan Toraja, menyediakan akomodasi nyaman dengan pemandangan pegunungan yang indah.', 'images/3b6066cea6c4df459e84a7f489199f24.jpg', 'images/96a57b6391ad521cb6c34a24d485185f.jpeg', 'images/6c620e819ecbbcfab98ae83888cb4c37.jpg', 'images/69ea2d21168e4210d2b3789037fe2c03.jpg', 'images/d63a68735dfb6b81cb62ce5a4043ff43.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

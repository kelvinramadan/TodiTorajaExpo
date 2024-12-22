-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 06:38 AM
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
-- Table structure for table `tourism`
--

CREATE TABLE `tourism` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `photo1` text NOT NULL,
  `photo2` text NOT NULL,
  `photo3` text NOT NULL,
  `photo4` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `details2` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `price` varchar(255) NOT NULL,
  `reservations` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `tourism`
--

INSERT INTO `tourism` (`id`, `title`, `photo`, `photo1`, `photo2`, `photo3`, `photo4`, `location`, `details`, `details2`, `date`, `time`, `price`, `reservations`) VALUES
(4, 'Gua Lemo', 'images/a77a7b2dcb94629e5ba312c1db335e3c.jpeg', 'images/62af75af5b7f5750dff480ac535f6164.jpeg', 'images/d416c4d2e7b2c0cf19eb53fefd5215ac.jpeg', 'images/2144c6f5b0ffe2ad911f175de4164136.jpeg', 'images/e25519273ebe54efa26a2f31b616c90d.jpeg', 'Makale Utara', 'Kuburan batu Toraja', 'Situs pemakaman tradisional dengan gua batu besar, dihiasi patung Tau-Tau sebagai simbol leluhur dan tradisi Toraja.', '2024-10-28', '07:00:00', '10000', 95),
(5, 'Kete Kesu', 'images/4869979b4460a6c216118c28e63b5d27.jpeg', 'images/c49ab21885944fdd648488bfac93eec7.jpeg', 'images/fb5f269d962501ad8df0606243cde0bd.jpeg', 'images/3b5c0df743b8cdf8640782f9ffe739a2.jpeg', 'images/5fc08915dcc856e63cddd5635a0e732a.jpeg', 'Rantepao', 'Desa adat Toraja', 'Sebuah desa tradisional yang terkenal dengan Tongkonan kuno, lumbung padi, dan ukiran kayu khas, mencerminkan warisan budaya Toraja.', '2024-11-05', '08:00:00', '20000', 53),
(6, 'Batutumonga', 'images/5f1c4e0f9eb3477df0a5c58a893cc66d.jpeg', 'images/3543431c99c31049bc08c97424899da1.jpeg', 'images/9ca729d0dfa81c43de1a5722df299b36.jpg', 'images/c1e1403d97d889ae655f459ae25f89eb.jpeg', 'images/466eb506c194af73bda1291c473cec80.jpeg', 'Toraja Utara', 'Panorama dataran tinggi', 'Destinasi di dataran tinggi dengan pemandangan sawah bertingkat dan lembah yang memesona, cocok untuk menikmati suasana Toraja.', '2024-11-15', '05:30:00', '15000', 120),
(8, 'Tongkonan Pallawa', 'images/4edc38dfc526b519ddb851d472d2294d.jpeg', 'images/97e89876a45afbbbd0278bcf0642aa65.jpeg', 'images/b6513af08512d54794cd635504cf69e7.jpeg', 'images/eb638ac3c792d54c580a88cbb6067de9.jpeg', 'images/d932a356e97f420b5898865b727e4cc5.jpeg', 'Sa’dan', 'Rumah adat Toraja', 'Kompleks Tongkonan yang dihiasi ukiran tradisional dan atap melengkung, menjadi simbol kebesaran budaya Toraja.', '2024-12-10', '10:00:00', '18000', 70),
(9, 'Bori Parinding', 'images/42209a4e5fa335b1773d85ad96ba6c66.jpeg', 'images/11c46dbc3de23d3e72b6ccff6e85f6ac.jpeg', 'images/03a20db54aac3cd05c04a984bdb3b4d0.jpeg', 'images/5e0428f3ae6e4b024152286a396d8d5e.jpeg', 'images/0141e4759133f8117afe34c7a9b3cfb5.jpeg', 'Rantepao', 'Situs megalitik kuno', 'Tempat bersejarah yang menyimpan batu megalitik besar sebagai tanda penghormatan bagi leluhur, unik dan sakral.', '2025-01-15', '08:00:00', '20000', 90),
(10, 'Pango-Pango', 'images/48a8ed633a28540dfa1e3188ef9ce39f.jpeg', 'images/1c7d9b9a2e72b4b582d21d4feb7408b6.jpeg', 'images/49cb711f76a821acac6be830c461fe17.jpeg', '', 'images/37861a17a35349f6147f344099e8e98b.jpeg', 'Makale', 'Perbukitan panorama Toraja', 'Tempat wisata alam di ketinggian yang menawarkan udara segar dan pemandangan Toraja yang indah dari atas bukit.', '2025-02-20', '10:00:00', '100', 110),
(11, 'Toraja Coffee Plantation', 'images/10066cba07dae2013477789fbfbb6f2e.jpeg', 'images/0a33d1488f52eb4730c7f0a7146a8103.jpeg', 'images/abd78037f166c875dcd5d001088501e0.jpeg', 'images/6662895619787fc9e2692d5d512a1527.jpeg', 'images/7a798697c893caeedc592adbdad1698b.jpeg', 'Toraja Utara', 'Kebun kopi Toraja', 'Area perkebunan kopi lokal yang terkenal dengan kualitas tinggi, menawarkan pengalaman edukasi tentang proses pengolahan kopi.', '2025-03-05', '09:00:00', '120', 60),
(12, 'Sesean Mountain', 'images/95a3079eefc927f0eb660f8fd48b1419.jpeg', 'images/f11693e7b82d172d3aeb9e714cca1f27.jpeg', 'images/b2c3bcfe363e10b73bea0faea0d7f7e5.jpeg', 'images/9cf8ba2a0f33ea455bc44d0817eee8af.jpeg', 'images/c49bd5b451bbbcd9c884cedee259d520.jpeg', 'Sesean Suloara', 'Gunung tertinggi di Toraja', 'Gunung yang menawarkan jalur pendakian menarik, dengan pemandangan alam luar biasa dan udara sejuk khas pegunungan.', '2025-03-25', '06:00:00', '250', 30),
(13, 'Buntu Burake', 'images/892e6636ec95482edbbc918a8b67452d.jpg', 'images/6c7251b1b777c05e3b0cbd4f42150914.jpeg', 'images/1876453d26e31c7531d4713921a680b8.jpeg', 'images/162ed59b73663938ed2c434b7fe557c7.jpeg', 'images/e8426e87eacb5cef273a12a96ad9b1b8.jpeg', 'Makale', 'Patung Yesus raksasa', 'Tempat wisata ikonik dengan patung Yesus besar yang berdiri megah, menjadi simbol religius dan daya tarik utama.', '2025-04-15', '07:00:00', '25000', 100),
(14, 'Lemo Stone Graves', 'images/0ecd983b8c4ab9a327b5b8f3358a4adc.jpeg', 'images/135108853e0244f4aea5aeeed29b7d0f.jpeg', 'images/ba39a9dfa3c1fc74a22784369db4e01d.jpeg', 'images/3807e795ade59d541d933e31a883ecc7.jpeg', 'images/4625df2640cfe85a76d39e98dd37e5bf.jpeg', 'Makale Utara', 'Makam batu kuno', 'Pemakaman unik dengan lubang-lubang pada dinding batu, tempat Tau-Tau dan leluhur Toraja disemayamkan.', '2025-05-01', '09:00:00', '15500', 85),
(15, 'Rambu Solo', 'images/154c4cb40843a5b7d160c835ef2c1f2f.jpeg', 'images/1eda9da0820050930f2155ed22e44a71.jpeg', 'images/24999f33b3f947b777da00635564d1bd.jpeg', 'images/659761e94c9b38802bbe8a50933dd287.jpeg', 'images/05a0b2d55ad662a032961b40f2be7155.jpeg', 'Sangalla', 'Upacara Pemakaman di Toraja', 'Upacara pemakaman tradisional yang kaya akan budaya, melibatkan prosesi unik dan penghormatan kepada leluhur khas Toraja.', '2025-05-20', '08:30:00', '50000', 65),
(16, 'Sarambu Waterfall', 'images/81c851162d5b3b5e138fef8a748bf3d2.jpeg', 'images/1a539fa116aa81cebcdda975dea70caa.jpeg', 'images/c43115280ab297ec196a8daf54b18452.jpeg', 'images/6aba99ad4cd7583403e5257a580711ad.jpeg', 'images/c1c8cf705fcaefc885e359e07c49a0b2.jpeg', 'Batupapan', 'Air terjun alami di Toraja', 'Air terjun alami yang memukau, dikelilingi oleh hutan hijau dan suasana segar khas Toraja.', '2025-06-05', '17:30:00', '9000', 110);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tourism`
--
ALTER TABLE `tourism`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tourism`
--
ALTER TABLE `tourism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

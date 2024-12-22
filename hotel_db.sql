-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 03:46 PM
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
(108, 'lagi', '/images/55a1e73e2df8b63c384a4b3842012894.jpg', 'lagi', '2024-12-22', '02:13:00', 'kaiaidaaa', 'wklqmdipwqjd'),
(109, 'nene kesu', '/images/f4e24b2c6c144148aaf882dd28e5d030.jpg', 'Rantepao', '2024-12-22', '03:31:00', 'mefwjwd', 'kn;dknldksd'),
(110, 'youtday', 'd190ba96e0044a98d6c0b6351c5944a9.jfif', 'aa', '2024-12-22', '21:14:00', 'aaa', 'ygtycy');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
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
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `phone` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `room` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `checkin`, `checkout`, `phone`, `email`, `total_price`, `room`) VALUES
(19, 'rodir', '2024-12-16', '2024-12-20', '34342', 'ejadueued@kwi', 4800000.00, 'The Rinra Hotel'),
(29, 'kelvin', '2024-12-22', '2024-12-24', '54463', 'kelvin@ramadan', 1438000.00, 'Melia Hotel Makassar');

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
  `facility1` varchar(255) DEFAULT NULL,
  `facility2` varchar(255) DEFAULT NULL,
  `facility3` varchar(255) DEFAULT NULL,
  `facility4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `rooms`, `type`, `price`, `details`, `photo`, `facility1`, `facility2`, `facility3`, `facility4`) VALUES
(16, 'Melia Hotel Makassar', 0, 'Deluxe', '719000', 'Melia Makassar adalah hotel kota bintang 4 yang modern dan bergaya yang berlokasi strategis di pusat perbelanjaan kota dan kawasan bisnis komersial.', 'images/53708efbb8721460b903b68f6fadf24e.jpg', 'images\\facility_images\\1MeliaHotelMakassar\\1.png', 'images\\facility_images\\1MeliaHotelMakassar\\2.png', 'images\\facility_images\\1MeliaHotelMakassar\\3.png', 'images\\facility_images\\1MeliaHotelMakassar\\4.png'),
(52, 'hotel pasar', 10, 'Executive', '1000000', 'biyv8yftfyuy', 'images/16bba84fe9e1890882e871b97c053164.jpg', 'images/8666d4c38b73509599cc7b4c84e5c41e.jpg', 'images/79f00b577af1aec6d36479d42b607e37.jpg', 'images/a27f2c0645a04c3e91a332c5742aee97.jpg', 'images/4d2f6e60d2e395050e0d1ed7f8c7331f.jpg');

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
(5, 'Kete Kesu', 'images/e87c624a7d518c183d9c6aeac0553dcf.jpg', 'images/35e150b185f6d57a806e6c0851fe47ca.jpg', 'images/6b4ab7733f07a57a1f345dd4e94dddb4.jpg', 'images/1ef236617af9547272fe6b1b8ea5f849.jpg', 'images/9dd2b91f6e3b2847c1df1dd29491c074.jpg', 'Rantepao', 'Kete Kesu adalah salah satu desa adat yang banyak menyimpan cerita dan sejarah Tana Toraja, dari mulai rumah adat serta makam kuno', 'Kete Kesu terletak di Kampung Bonoran Kelurahan Tikunna Malenong, Kecamatan Sanggalangi, Toraja Utara, Sulawesi Selatan. Desa ini memang terkenal dengan pemakaman adat Toraja dimana jenazah diletakan di tebing dan gua yang berada di belakang desa ini. Di sini juga ada beberapa makam yang dianggap sudah modern, yaitu makam yang menggunakan bangunan seperti rumah dan terdapat foto anggota keluarga yang sudah dimakamkan di dalamnya.\\r\\n\\r\\nSelain makam adat, wisatawan juga dapat melihat rumah tradisional Toraja yaitu Tongkonan dengan tanduk kerbau yang tinggi menjulang serta terdapat lumbung di seberangnya. Jika kalian tengah berkunjung ke Kete Kesu, jangan lupa membeli buah tangan yang tersedia di pusat UMKM disepanjang jalan menuju ke makam adat.', '2024-11-05', '08:00:00', '20000', 0),
(24, 'tesaja', 'images/270b2de80890e471383a68a17943b9c4.jpg', 'images/0b1591ca340ce415a74ca432b809f08f.jpg', 'images/50f622df433f7bd579f0d1b27d56389d.jpg', 'images/b317b501abc9eebe8f0817a048494d70.jpg', 'images/4b6d3ac780b2c0ae0b9d6fe20e099a2c.jpg', 'tesaja', 'aaaaaa', 'aaaaa', '2024-12-22', '02:18:00', '40000', 723),
(25, 'utut', 'images/0e2ed4f533d8ad7990f797f11e821ad8.jpg', 'images/72877598b15bcca27d0b4a32c05c5441.jpg', 'images/0131f133b269b402b63f6cadbf748894.jpg', 'images/66a6f3aa7e644bbd317b0742870831a6.jpg', 'images/b40ed2b22814a4650d46192dc8d06b82.jpg', 'utut', 'aaaa', 'aaaaaa', '2024-12-22', '02:33:00', '40000', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tour_reserves`
--

CREATE TABLE `tour_reserves` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `reservations` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `payment_status` enum('pending','completed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_general_ci;

--
-- Dumping data for table `tour_reserves`
--

INSERT INTO `tour_reserves` (`id`, `tour_id`, `reservations`, `cus_name`, `email`, `phone`, `payment_status`) VALUES
(25, 5, 100, 'kelvin', 'kelvin@ramadan', '871389893712', 'pending'),
(26, 24, 4, 'kelvin', 'kelvin@ramadan', '99797', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone`, `email`, `password`, `created_at`) VALUES
(1, 'kelvin', '8888', 'kelvin@ramadan', '$2y$10$hl.DzBs0ZWDMxP//wjKvgOlJMvi7aqINcI1k9qAQpDoTts1lkMywi', '2024-12-21 19:50:20'),
(2, 'alma', '877328', 'alma@gmail.com', '$2y$10$nJj6TcbDnXgqus49LTQc0.U6EJqWAmgupK7lZx16PmcI3jevh0D5K', '2024-12-22 09:33:32'),
(3, 'bevy', '928929', 'bevy@gmail.com', '$2y$10$.WKzI9ZAOzwK6o77/2teGObLAYwE4UyTudtQvMbdRs4v3kLBkbcii', '2024-12-22 09:42:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourism`
--
ALTER TABLE `tourism`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_reserves`
--
ALTER TABLE `tour_reserves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tourism`
--
ALTER TABLE `tourism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tour_reserves`
--
ALTER TABLE `tour_reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `event_topic` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `venue` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `short_details` varchar(255) NOT NULL,
  `full_details` text NOT NULL,
  `past_event` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

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
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `phone` text NOT NULL,
  `people` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `checkin`, `checkout`, `phone`, `people`, `email`, `room`) VALUES
(3, 'Tul', '2017-12-16', '2017-12-26', '0976245430', 2, 'tembothulani@gmail.com', 'Inter-Continental Hotel');

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
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `rooms`, `type`, `price`, `details`, `photo`) VALUES
(15, 'Victoria Falls Hotel', 20, 'Executive', '550', '  it is a self contained room with room service', 'images/38a42bea45f24cbe580972a30694fe4a.jpg'),
(16, 'Chita Samfya Lodge', 15, 'Regular', '450', 'it is a self contained room with room service', 'images/e434cecc6cfa3b049462b124681bd0b8.jpg'),
(17, 'Inter-Continental Hotel', 24, 'Executive', '650', 'it is a self contained room with room service.', 'images/2ff14dfea91787d539b7509427338e97.jpg');

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
  `location` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `price` varchar(255) NOT NULL,
  `reservations` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `tourism`
--

INSERT INTO `tourism` (`id`, `title`, `photo`,`photo1`,`photo2`, `location`, `details`, `date`, `time`, `price`, `reservations`) VALUES
(4, 'Gua Lemo', 'images/0527836c3fa98cb0b57ef19e5d26ff08.png', 'images/0527836c3fa98cb0b57ef19e5d26ff08.png', 'images/0527836c3fa98cb0b57ef19e5d26ff08.png', 'Makale Utara', 'gua lemo indah', '2024-10-28', '07:00:00', '100', 95);

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
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `tour_reserves`
--

INSERT INTO `tour_reserves` (`id`, `tour_id`, `reservations`, `cus_name`, `email`, `phone`) VALUES
(2, 4, 'Gua Lemo', 'Kelvin', 'kelvinoktabrian@gmail.com', '0987654321');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(80) NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(1, 'Thulani Tembo', 'tembothulani@gmail.com', '$2y$10$KKRlG5O2UA0aIY/7YBBzs.5IsqAB38pr8dr0eM2OmXtaB/lv0vG8S', '2017-08-25 14:20:37', '2017-12-13 23:50:22', 'admin, editor'),
(2, 'Theresa Nayame', 'theresanayame@gmail.com', '$2y$10$NuwKjycWxGZ9qOqXzLOoEeB1R1O5H5bEiRS2ChFiqa7.jg8x9BlAK', '2017-11-11 00:11:15', '2017-12-11 01:36:21', 'editor,admin'),
(3, 'admin', 'admin@admin.com', 'admin123', '2017-12-13 23:12:51', '0000-00-00 00:00:00', 'editor,admin');

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tourism`
--
ALTER TABLE `tourism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tour_reserves`
--
ALTER TABLE `tour_reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

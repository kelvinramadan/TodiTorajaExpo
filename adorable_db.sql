-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 06:37 PM
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
-- Database: `adorable_db`
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
(94, 'Magical Toraja Event', '/images/40cc43cdcfbab42f5f8ca37bbe3bab32.jpg', 'Toraja Utara', '2025-01-15', '10:00:00', 'Atraksi Budaya Magis', 'Festival memukau yang merayakan mistisisme Toraja melalui cerita rakyat, instalasi seni, dan upacara tradisional.'),
(96, 'Lovely December', '/images/920c88600fdb066267640840c0fdac49.jpeg', 'Tana Toraja', '2025-03-19', '08:00:00', 'Perayaan akhir tahun', 'Perayaan akhir tahun yang diwarnai dengan parade budaya, pertunjukan seni, dan bazar khas daerah.'),
(100, 'Toraja & Beyond Festival', '/images/23b72c3a7369a594ed0826c12e2c9ae8.jpeg', 'Toraja', '2025-06-07', '12:00:00', 'Promosi wisata regional', 'Pameran seni dan budaya yang menampilkan seni tradisional, kerajinan, dan pertunjukan tari khas Toraja.'),
(102, 'Siguntu Art Festival', '/images/b77a77131312760301204d2fcfc3d659.jpg', 'Rantepao', '2025-07-15', '08:30:00', 'Perayaan seni Toraja', 'Pertunjukan seni langsung, lokakarya, dan pameran.'),
(103, 'Toraja Youth Day', '/images/031155ac04fe5ea9bdff6e444cf063f0.jpeg', 'Makale', '2025-08-10', '09:00:00', 'Acara pemuda di Toraja', 'Lokakarya, pertunjukan, dan kegiatan untuk pemuda Toraja.'),
(104, 'Londa Music Night', '/images/38191c65c9f48baf2ecd29bd01239607.jpg', 'Londa', '2025-09-09', '19:00:00', 'Malam musik tradisional', 'Pertunjukan musik tradisional di gua Londa yang terkenal.');

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
(16, 'Melia Hotel Makassar', 7, 'Deluxe', '719000', 'Melia Hotel Makassar adalah hotel kota bintang 4 yang modern dan bergaya yang berlokasi strategis di pusat perbelanjaan kota dan kawasan bisnis komersial.', 'images/7dcf7092a1763ec8213bed8a7955ba52.jpeg', 'images/fe047f34150a08d1799d149e749a00e7.jpg', 'images/0b5d9eaffc7cd8a3e8ddd5e2b5b88939.jpg', 'images/e1eebd29905b1f87451c5b3b1dc17369.jpeg', 'images/3fd25bbd36a1d0d53b2e768c9e22a283.jpg'),
(17, 'The Rinra Hotel', 23, 'Executive', '1200000', 'The Rinra adalah hotel bintang lima yang terletak di pusat kota Makassar, menawarkan kemewahan dan kenyamanan dengan pemandangan laut yang menakjubkan.', 'images/1e9b4730fe6aaf090934ca248f462f75.jpg', 'images/de92a43a1cf7e4d75d11074a85e66c63.jpg', 'images/ec0a1eaf7c0b36f6143fc5e5842e9407.jpg', 'images/8162c3445b334f737811cc3d1c1c8311.jpg', 'images/bef3607495e9b83830d1cc696dac010f.jpg'),
(18, 'KHAS Hotel Makassar', 4, 'Regular', '518000', 'KHAS Makassar Hotel memiliki taman, lounge bersama, teras, dan restoran di Makassar. Hotel bintang 3 ini menawarkan layanan kamar dan ATM.', 'images/9e27dee549cf6ea483bfe6b3c992f93c.jpg', 'images/8d16033dfc6ce5849323c5ae53bfc9ef.jpg', 'images/ae5dfcb8be6238e9316fa28c8f954053.png', 'images/b668368c5cee4e8fa4e1e677f471cbca.jpeg', 'images/b12f93d47e952984fa14d49a7ddc74aa.jpg'),
(19, 'Claro Hotel Makassar', 9, 'Deluxe', '789000', 'Berlokasi di jantung kawasan bisnis Makassar yang berkembang pesat menawarkan 585 akomodasi dengan perabotan yang indah dan keramahan yang tak tertandingi.', 'images/ab2bc0da708609bded028e7ad7783f0a.jpeg', 'images/76626ae7b4e8dc681fb43948befc2f7b.jpg', 'images/c8bd32ba579c4b23a9d8e111b1aef9a6.jpg', 'images/025c5cecc63fba966b320c440d59b894.jpg', 'images/c08740476ee289f9b4c6361cf3dd3f90.jpeg'),
(20, 'AryaDuta Hotel', 1, 'Deluxe', '803000', 'Terletak di tepi Pantai Losari, Hotel Aryaduta Makassar menawarkan pusat kebugaran dan kamar-kamar dengan TV kabel layar datar.', 'images/e0abe97e1e25691f86618116852949cd.jpg', 'images/263d16e302f62d8e9cd47e6ca2a4a3d4.jpeg', 'images/fa4ac5df6edf97e490c01a7695a2d5f1.jpeg', 'images/e04126974d6f30f61c8b0e96da55d15a.jpg', 'images/9e99461d710542a2246b12981e88b3aa.jpg'),
(21, 'Continent Hotel', 2, 'Executive', '677500', 'Terkenal dengan lingkungannya yang ramah keluarga dan dekat dengan restoran dan atraksi terbaik, Continent Centrepoint memudahkan Anda menikmati yang terbaik dari Makassar.', 'images/b45f3415a5759924d42d47f4ec71ee3f.jpeg', 'images/5e19811989c01b145969869bcef70229.jpeg', 'images/ac794a3bc129c81c22097249470c97a7.jpg', 'images/56fdd3875b1e4f975676a41b32fcb927.jpg', 'images/0aba69405d33f1d6d36bfe42564a793e.jpg'),
(23, 'Toraja Misiliana Hotel', 6, 'Regular', '567000', 'Toraja Misiliana Hotel terletak di Rantepao, hotel ini menawarkan akomodasi dengan fasilitas modern dan suasana tradisional Toraja.', 'images/9944d87ac5065fdef7e43d74150121dd.jpeg', 'images/9932fc791eec4b7012e97af598efa012.jpg', 'images/5d4807129add33df541add7e61042c66.jpeg', 'images/5fa542938c3de0d6cc8d223d25e44201.jpg', 'images/87e521d155132bbbbd445366188ea0f6.jpeg'),
(25, 'Luta Resort Toraja', 2, 'Executive', '999000', 'Luta Resort Toraja adalah resort bintang 4 yang berlokasi di pusat kota Rantepao, menawarkan pemandangan indah sungai dan pegunungan dengan fasilitas modern dan kenyamanan yang memikat.', 'images/fdc4c61b7df63bb984ecafead1040e32.jpg', 'images/d3db0c2ecc382edd209214e2d2e2576b.jpg', 'images/2c79608ba84c84b3ababbdfeceaad550.jpeg', 'images/1247ca9ccf3bbcc448b60762228ae344.jpeg', 'images/d32a346e76dd79f734023ae761bd872a.jpeg'),
(26, 'Toraja Heritage Hotel', 6, 'Regular', '5720000', 'Toraja Heritage Hotel adalah hotel bintang 4 yang memadukan arsitektur tradisional Tongkonan dengan fasilitas modern, memberikan pengalaman budaya Toraja yang autentik di tengah lingkungan yang asri.', 'images/e9d631f43ffe4cfa098e98d341297394.jpeg', 'images/15ebe881c680daa2be899a4fb4ac6b1e.jpg', 'images/7d3bdab09ae4f789f63ece052449c262.jpeg', 'images/d21720d8255694d318dbd319c544791c.jpeg', 'images/cd8ad48f76ca40b6d2e357c257bb4e88.jpg'),
(27, 'Hotel Marante Toraja', 9, 'Regular', '598000', 'Hotel Marante Toraja adalah hotel bintang 3 yang menawarkan kenyamanan modern dengan suasana pegunungan yang tenang dan pemandangan alam yang memukau.', 'images/700d2889204270ce0c4d67c2fb48a12c.jpeg', 'images/c47f9e2f3bcdc7ec966c329f896cca5e.jpg', 'images/0788e7ff9235d6d8138909e73da98476.jpeg', 'images/43de908b8087ec84dd7f728c3c1b36ab.jpeg', 'images/26c245138c2fd3dd27fa620179bad16e.jpeg'),
(28, 'Rantepao Lodge', 10, 'Regular', '750000', 'Rantepao Lodge adalah hotel bintang 3 yang terletak di lokasi strategis dengan desain modern dan layanan ramah untuk pengalaman menginap yang menyenangkan.', 'images/039759341933bd53a69ef395410caf51.jpeg', 'images/7a4809f6b3bae5684d83aa324c7e3aec.jpg', 'images/3511d71558d9cfe568857b3df80e0655.jpg', 'images/d4d1f2a3e077cb263062f3e08abcf3e2.jpeg', 'images/43af753bc6223c390b589b4f9e6870a4.jpg'),
(29, 'Sahid Toraja', 1, 'Deluxe', '909000', 'Sahid Toraja adalah hotel bintang 3 yang terletak di perbukitan Toraja, menyediakan akomodasi nyaman dengan pemandangan pegunungan yang indah.', 'images/3b6066cea6c4df459e84a7f489199f24.jpg', 'images/96a57b6391ad521cb6c34a24d485185f.jpeg', 'images/6c620e819ecbbcfab98ae83888cb4c37.jpg', 'images/69ea2d21168e4210d2b3789037fe2c03.jpg', 'images/d63a68735dfb6b81cb62ce5a4043ff43.jpeg'),
(51, 'hotel baru', 7, 'Executive', '719000', 'djewinxur uincuer jicronpirk irocyru jioeiwok keourutjt.', 'images/6c5a3692fef08bfeb07bec82c6b0386c.jpg', 'images/9a0d1c26a886e01eeab28f09429266a3.jpeg', 'images/df2ba8dc450a1050321b8f7f6df9431e.jpg', 'images/17b6cba30a3c2219ddb601e37c3db0d3.jpg', 'images/be9e27c82dd873971e9ceb88f2defaa9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `room_reserves`
--

CREATE TABLE `room_reserves` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `payment_status` enum('unpaid','paid') DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_reserves`
--

INSERT INTO `room_reserves` (`id`, `room_id`, `user_id`, `checkin_date`, `checkout_date`, `booking_date`, `total_price`, `status`, `payment_status`, `created_at`) VALUES
(5, 16, 1, '2024-12-25', '2025-01-01', '2024-12-25 10:39:12', 5033000.00, 'pending', 'unpaid', '2024-12-25 16:39:12'),
(8, 26, 5, '2024-12-26', '2024-12-31', '2024-12-25 11:30:59', 28600000.00, 'pending', 'unpaid', '2024-12-25 17:30:59');

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
(4, 'Gua Lemo', 'images/d2bdc45e7f30ab8752c7774df0dbaea7.jpg', 'images/62af75af5b7f5750dff480ac535f6164.jpeg', 'images/d416c4d2e7b2c0cf19eb53fefd5215ac.jpeg', 'images/2144c6f5b0ffe2ad911f175de4164136.jpeg', 'images/e25519273ebe54efa26a2f31b616c90d.jpeg', 'Makale Utara', 'Kuburan batu Toraja', 'Gua Lemo adalah salah satu situs pemakaman batu yang ikonik di Toraja, yang memadukan tradisi leluhur dan keindahan alam. Tebing batu besar yang menjulang tinggi dipenuhi oleh lubang-lubang makam yang telah digunakan selama berabad-abad. Setiap lubang ini diisi oleh jasad dan dihiasi patung kayu tau-tau, yang mewakili sosok dari orang yang dimakamkan.\\r\\n\\r\\nLokasi ini memberikan suasana sakral yang menyatu dengan alam sekitar. Pemandangan tebing batu yang megah dikelilingi pepohonan hijau menciptakan atmosfer yang tenang dan menenangkan. Banyak wisatawan yang datang untuk merasakan keajaiban budaya dan keunikan arsitektur pemakaman ini.\\r\\n\\r\\nSelain sebagai tempat pemakaman, Gua Lemo juga menjadi saksi sejarah panjang masyarakat Toraja. Tempat ini sering menjadi lokasi upacara adat yang melibatkan doa-doa dan penghormatan kepada leluhur. Tradisi ini masih hidup hingga kini, memperlihatkan betapa eratnya masyarakat Toraja dengan nilai-nilai spiritual mereka.\\r\\n\\r\\nBagi para pengunjung, Gua Lemo menawarkan pengalaman yang tak terlupakan. Menyaksikan ukiran batu dan patung tau-tau yang menggambarkan ekspresi manusia memberikan kesan mendalam akan hubungan yang kuat antara kehidupan dan kematian dalam budaya Toraja. Hal ini menjadikan Gua Lemo sebagai destinasi wajib bagi siapa saja yang ingin memahami warisan budaya Toraja.\\r\\n\\r\\nTidak hanya itu, akses menuju lokasi ini juga cukup mudah, dengan jalur yang dikelilingi oleh pemandangan alam yang indah. Pengunjung bisa menikmati perjalanan yang menyenangkan sambil mempelajari keunikan budaya lokal, menjadikan Gua Lemo lebih dari sekadar destinasi wisata, tetapi juga pengalaman edukasi yang mendalam.', '2024-10-28', '07:00:00', '10000', 75),
(5, 'Kete Kesu', 'images/ae6fc8c44145eae90d294cc904b16238.jpg', 'images/c49ab21885944fdd648488bfac93eec7.jpeg', 'images/fb5f269d962501ad8df0606243cde0bd.jpeg', 'images/3b5c0df743b8cdf8640782f9ffe739a2.jpeg', 'images/5fc08915dcc856e63cddd5635a0e732a.jpeg', 'Rantepao', 'Desa adat Toraja', 'Kete Kesu adalah sebuah desa adat yang telah menjadi ikon pariwisata Toraja, menggambarkan kehidupan tradisional yang masih terjaga dengan baik. Desa ini terkenal dengan rumah adat Tongkonan yang megah, dihiasi ukiran-ukiran artistik dengan warna-warna cerah. Selain itu, deretan lumbung padi yang khas menambah daya tarik visualnya.\\\\r\\\\n\\\\r\\\\nDesa ini bukan hanya sekadar tempat tinggal, tetapi juga pusat budaya masyarakat Toraja. Kete Kesu sering dijadikan lokasi untuk berbagai upacara adat, seperti Rambu Solo dan Rambu Tuka. Pengunjung dapat menyaksikan secara langsung bagaimana masyarakat setempat menjalankan tradisi mereka dengan penuh penghormatan terhadap leluhur.\\\\r\\\\n\\\\r\\\\nDi belakang desa ini terdapat area pemakaman unik di tebing batu, yang menjadi daya tarik tambahan. Tebing ini dipenuhi dengan peti mati kayu dan patung tau-tau yang melambangkan orang-orang yang telah meninggal. Keberadaan situs ini menciptakan suasana mistis yang memikat para wisatawan.\\\\r\\\\n\\\\r\\\\nBagi pecinta seni dan sejarah, Kete Kesu adalah tempat yang ideal untuk mempelajari keahlian ukiran tradisional Toraja. Desa ini juga menjadi pusat produksi berbagai kerajinan tangan seperti kain tenun, anyaman, dan patung kayu yang bisa dijadikan oleh-oleh.\\\\r\\\\n\\\\r\\\\nPengunjung yang datang ke Kete Kesu akan merasa seolah-olah kembali ke masa lalu, melihat bagaimana tradisi dan kehidupan masyarakat Toraja terjaga dengan baik. Dengan pemandangan alam yang indah dan keramahan penduduk lokal, desa ini menjadi destinasi yang tak boleh dilewatkan.', '2024-11-05', '08:00:00', '20000', 21),
(6, 'Batutumonga', 'images/014478dab8ec9613a02ad0688684954d.jpg', 'images/3543431c99c31049bc08c97424899da1.jpeg', 'images/9ca729d0dfa81c43de1a5722df299b36.jpg', 'images/c1e1403d97d889ae655f459ae25f89eb.jpeg', 'images/466eb506c194af73bda1291c473cec80.jpeg', 'Toraja Utara', 'Panorama dataran tinggi', 'Batutumonga adalah surga tersembunyi di dataran tinggi Toraja yang menawarkan pemandangan spektakuler dari lembah dan pegunungan. Terletak di lereng Gunung Sesean, tempat ini menjadi destinasi favorit bagi para pelancong yang mencari ketenangan dan keindahan alam. Kabut tipis yang menyelimuti area ini pada pagi hari menciptakan suasana magis dan menenangkan.\\\\r\\\\n\\\\r\\\\nBatutumonga juga terkenal sebagai tempat terbaik untuk menikmati panorama sawah yang bertingkat-tingkat, dipadukan dengan desa-desa kecil yang tersebar di lembah. Banyak wisatawan yang memanfaatkan lokasi ini untuk trekking, menikmati udara segar, dan menjelajahi keindahan alam yang jarang ditemukan di tempat lain.\\\\r\\\\n\\\\r\\\\nSelain keindahan alamnya, Batutumonga juga merupakan pintu masuk ke kehidupan masyarakat Toraja yang autentik. Pengunjung dapat menyaksikan langsung kehidupan sehari-hari penduduk setempat, termasuk proses bertani dan ritual adat. Hal ini memberikan pengalaman budaya yang kaya dan mendalam.\\\\r\\\\n\\\\r\\\\nTidak hanya itu, Batutumonga adalah tempat yang ideal untuk para fotografer, dengan banyak spot yang menawarkan pemandangan memukau. Mulai dari matahari terbit yang menawan hingga suasana pedesaan yang damai, setiap sudutnya mampu menginspirasi siapa saja yang datang.\\\\r\\\\n\\\\r\\\\nDengan kombinasi keindahan alam, ketenangan, dan kekayaan budaya, Batutumonga menjadi salah satu destinasi yang wajib dikunjungi bagi siapa saja yang ingin merasakan pesona Toraja yang sejati.', '2024-11-15', '05:30:00', '15000', 120),
(8, 'Tongkonan Pallawa', 'images/bd3818735c7d5e2ea5b48bd266cca344.jpg', 'images/97e89876a45afbbbd0278bcf0642aa65.jpeg', 'images/b6513af08512d54794cd635504cf69e7.jpeg', 'images/eb638ac3c792d54c580a88cbb6067de9.jpeg', 'images/d932a356e97f420b5898865b727e4cc5.jpeg', 'Sa’dan', 'Rumah adat Toraja', 'Tongkonan Pallawa adalah salah satu rumah adat tertua dan paling ikonik di Toraja. Terletak di sebuah bukit kecil yang dikelilingi oleh pepohonan bambu, kompleks ini menampilkan deretan rumah Tongkonan dengan desain tradisional yang mencolok. Atapnya yang melengkung seperti tanduk kerbau dan ukiran-ukiran warna-warni mencerminkan seni dan filosofi masyarakat Toraja.\\r\\n\\r\\nTongkonan Pallawa bukan hanya tempat tinggal, tetapi juga pusat kehidupan sosial dan spiritual. Rumah ini digunakan untuk berbagai upacara adat, termasuk pertemuan keluarga besar dan ritual penghormatan kepada leluhur. Pengunjung yang datang ke sini dapat belajar tentang nilai-nilai kekeluargaan yang kuat di dalam budaya Toraja.\\r\\n\\r\\nSelain itu, kompleks ini juga dilengkapi dengan lumbung padi tradisional yang berfungsi sebagai simbol kesejahteraan dan kemakmuran. Lumbung-lumbung ini dihiasi ukiran unik yang memiliki makna spiritual dan estetika tinggi.\\r\\n\\r\\nDi Tongkonan Pallawa, wisatawan juga dapat mendengar cerita-cerita menarik dari pemandu lokal tentang sejarah dan fungsi rumah adat ini. Hal ini memberikan wawasan yang lebih dalam mengenai kehidupan masyarakat Toraja.\\r\\n\\r\\nDengan keindahan arsitektur dan nilai budaya yang terkandung di dalamnya, Tongkonan Pallawa menjadi salah satu situs yang tak boleh dilewatkan oleh siapa pun yang ingin memahami warisan Toraja.', '2024-12-10', '10:00:00', '18000', 70),
(9, 'Bori Parinding', 'images/42209a4e5fa335b1773d85ad96ba6c66.jpeg', 'images/11c46dbc3de23d3e72b6ccff6e85f6ac.jpeg', 'images/03a20db54aac3cd05c04a984bdb3b4d0.jpeg', 'images/5e0428f3ae6e4b024152286a396d8d5e.jpeg', 'images/0141e4759133f8117afe34c7a9b3cfb5.jpeg', 'Rantepao', 'Situs megalitik kuno', 'Bori Parinding adalah salah satu situs megalitik yang paling terkenal di Toraja, mencerminkan tradisi pemakaman yang unik dan mendalam. Situs ini dipenuhi dengan batu-batu besar yang berdiri tegak, yang dikenal sebagai menhir. Menhir ini didirikan sebagai penghormatan kepada leluhur dan menjadi simbol status sosial dalam masyarakat Toraja.\r\n\r\nBori Parinding tidak hanya berfungsi sebagai area pemakaman, tetapi juga sebagai tempat untuk upacara adat Rambu Solo. Upacara ini melibatkan serangkaian ritual yang penuh makna, termasuk persembahan hewan kurban dan prosesi keluarga besar. Pengunjung dapat menyaksikan langsung betapa kayanya tradisi Toraja yang diwariskan dari generasi ke generasi.\r\n\r\nSelain menhir, situs ini juga memiliki liang batu yang digunakan sebagai tempat persemayaman jenazah. Liang-liang ini dipahat dengan tangan di tebing batu, menunjukkan keahlian luar biasa dari para leluhur. Pemandangan ini menciptakan suasana yang sakral dan penuh penghormatan.\r\n\r\nBori Parinding juga dikelilingi oleh pemandangan alam yang indah, dengan pepohonan hijau dan udara segar. Lokasi ini menawarkan kesempatan bagi wisatawan untuk merenung dan merasakan kedekatan dengan alam serta budaya setempat.\r\n\r\nDengan nilai historis, spiritual, dan keindahan alam yang dimilikinya, Bori Parinding menjadi salah satu destinasi wisata yang memberikan pengalaman unik dan mendalam bagi siapa saja yang mengunjunginya.\r\n\r\n', '2025-01-15', '08:00:00', '20000', 80),
(10, 'Pango-Pango', 'images/48a8ed633a28540dfa1e3188ef9ce39f.jpeg', 'images/1c7d9b9a2e72b4b582d21d4feb7408b6.jpeg', 'images/49cb711f76a821acac6be830c461fe17.jpeg', '', 'images/37861a17a35349f6147f344099e8e98b.jpeg', 'Makale', 'Perbukitan panorama Toraja', 'Pango-Pango adalah destinasi wisata di Toraja yang dikenal dengan keindahan pemandangan alamnya dari ketinggian. Terletak di atas bukit, Pango-Pango menawarkan panorama 360 derajat yang mencakup hamparan pegunungan, lembah, dan awan yang seolah berada dalam jangkauan tangan. Tempat ini menjadi pilihan sempurna untuk menikmati matahari terbit atau terbenam dalam suasana yang damai dan menyegarkan.\r\n\r\nBagi pecinta alam, Pango-Pango juga menawarkan berbagai aktivitas seperti trekking dan berkemah. Jalur pendakian yang tersedia memungkinkan pengunjung menikmati keindahan flora dan fauna lokal sepanjang perjalanan. Udara segar dan pemandangan yang memukau membuat setiap langkah terasa menyenangkan dan penuh pengalaman.\r\n\r\nSelain itu, Pango-Pango sering menjadi tempat untuk menggelar acara-acara tradisional dan festival budaya. Wisatawan dapat menyaksikan berbagai tarian adat, musik tradisional, dan kuliner khas Toraja di lokasi ini. Hal ini memberikan dimensi tambahan bagi mereka yang ingin mengenal budaya Toraja lebih dalam.\r\n\r\nPango-Pango juga menyediakan fasilitas wisata yang ramah keluarga, seperti area bermain anak-anak dan gazebo untuk bersantai. Pengunjung dapat menikmati waktu bersama keluarga sambil menyerap suasana alam yang tenang dan jauh dari hiruk-pikuk perkotaan.\r\n\r\nDengan perpaduan antara keindahan alam, aktivitas seru, dan kesempatan untuk merasakan budaya lokal, Pango-Pango adalah destinasi yang menawarkan pengalaman wisata yang lengkap dan memuaskan.', '2025-02-20', '10:00:00', '100', 110),
(11, 'Toraja Coffee Plantation', 'images/10066cba07dae2013477789fbfbb6f2e.jpeg', 'images/0a33d1488f52eb4730c7f0a7146a8103.jpeg', 'images/abd78037f166c875dcd5d001088501e0.jpeg', 'images/6662895619787fc9e2692d5d512a1527.jpeg', 'images/7a798697c893caeedc592adbdad1698b.jpeg', 'Toraja Utara', 'Kebun kopi Toraja', 'Toraja Coffee Plantation adalah surga bagi para pecinta kopi yang ingin mengeksplorasi asal-usul salah satu kopi terbaik dunia. Perkebunan ini dikenal menghasilkan biji kopi dengan kualitas premium, yang ditanam di tanah vulkanik subur di dataran tinggi Toraja. Proses pengolahan kopi di sini dilakukan secara tradisional, memastikan cita rasa yang autentik dan khas.\r\n\r\nWisatawan yang berkunjung ke Toraja Coffee Plantation dapat mengikuti tur edukatif yang menjelaskan setiap tahap dalam produksi kopi, mulai dari pemetikan biji hingga proses pemanggangan. Pengalaman ini memberikan wawasan mendalam tentang dedikasi dan keahlian yang terlibat dalam menciptakan secangkir kopi Toraja yang sempurna.\r\n\r\nSelain tur, pengunjung juga dapat menikmati sesi mencicipi kopi yang dipandu oleh ahli. Dalam sesi ini, mereka diajak untuk memahami berbagai rasa dan aroma unik yang menjadi ciri khas kopi Toraja. Banyak wisatawan menganggap pengalaman ini sebagai puncak kunjungan mereka ke perkebunan.\r\n\r\nToraja Coffee Plantation juga menawarkan pemandangan yang memukau, dengan deretan tanaman kopi yang tumbuh di lereng bukit dan udara sejuk yang menyegarkan. Area ini sangat cocok untuk bersantai sambil menikmati secangkir kopi langsung dari sumbernya.\r\n\r\nBagi mereka yang ingin membawa pulang kenangan, tersedia berbagai produk kopi seperti biji kopi mentah, kopi bubuk, dan suvenir unik lainnya. Toraja Coffee Plantation adalah destinasi yang tidak hanya memanjakan lidah tetapi juga memperkaya pengalaman wisatawan.\r\n\r\n', '2025-03-05', '09:00:00', '120', 60),
(12, 'Sesean Mountain', 'images/95a3079eefc927f0eb660f8fd48b1419.jpeg', 'images/f11693e7b82d172d3aeb9e714cca1f27.jpeg', 'images/b2c3bcfe363e10b73bea0faea0d7f7e5.jpeg', 'images/9cf8ba2a0f33ea455bc44d0817eee8af.jpeg', 'images/c49bd5b451bbbcd9c884cedee259d520.jpeg', 'Sesean Suloara', 'Gunung tertinggi di Toraja', 'Sesean Mountain adalah salah satu puncak tertinggi di Toraja yang menjadi tujuan favorit para pendaki dan pecinta alam. Dengan ketinggian lebih dari 2.000 meter di atas permukaan laut, gunung ini menawarkan pemandangan spektakuler dari dataran tinggi Toraja, termasuk hamparan sawah, desa-desa kecil, dan awan yang menyelimuti pegunungan.\r\n\r\nPendakian ke Gunung Sesean tidak hanya menawarkan tantangan fisik tetapi juga memberikan pengalaman spiritual dan koneksi mendalam dengan alam. Jalur pendakian dihiasi dengan flora dan fauna lokal, serta suasana hutan yang tenang dan asri. Pendakian ini cocok untuk pendaki pemula maupun berpengalaman.\r\n\r\nSelain trekking, Gunung Sesean sering menjadi tempat untuk aktivitas camping. Para pengunjung dapat menghabiskan malam di bawah langit berbintang sambil menikmati udara segar dan suara alam yang menenangkan. Suasana ini menciptakan pengalaman yang tidak terlupakan bagi siapa saja yang berkunjung.\r\n\r\nBagi masyarakat lokal, Gunung Sesean memiliki makna spiritual yang mendalam. Banyak legenda dan cerita rakyat yang berhubungan dengan gunung ini, menjadikannya tidak hanya sebagai tempat wisata tetapi juga sebagai simbol kebanggaan budaya.\r\n\r\nDengan keindahan alam yang memukau dan nilai-nilai budaya yang kaya, Gunung Sesean adalah destinasi yang sempurna untuk melarikan diri dari kesibukan sehari-hari dan menemukan kedamaian dalam keindahan alam Toraja.', '2025-03-25', '06:00:00', '250', 30),
(13, 'Buntu Burake', 'images/892e6636ec95482edbbc918a8b67452d.jpg', 'images/6c7251b1b777c05e3b0cbd4f42150914.jpeg', 'images/1876453d26e31c7531d4713921a680b8.jpeg', 'images/162ed59b73663938ed2c434b7fe557c7.jpeg', 'images/e8426e87eacb5cef273a12a96ad9b1b8.jpeg', 'Makale', 'Patung Yesus raksasa', 'Buntu Burake adalah salah satu destinasi ikonik di Toraja yang dikenal dengan patung Yesus memberkati, salah satu yang tertinggi di dunia. Terletak di atas bukit, patung ini menawarkan pemandangan indah dari kota Makale dan sekitarnya. Kombinasi antara arsitektur yang megah dan keindahan alam menjadikan Buntu Burake sebagai destinasi yang tak boleh dilewatkan.\r\n\r\nSelain patung Yesus, kawasan Buntu Burake juga memiliki jembatan kaca yang menantang adrenalin. Jembatan ini memungkinkan pengunjung berjalan di atas ketinggian dengan pemandangan langsung ke bawah, memberikan pengalaman yang memacu semangat sekaligus memukau.\r\n\r\nBuntu Burake juga merupakan tempat untuk kegiatan spiritual dan refleksi diri. Banyak wisatawan datang ke sini untuk berdoa atau sekadar menikmati ketenangan. Suasana yang damai dan udara sejuk menambah daya tarik tempat ini sebagai destinasi wisata rohani.\r\n\r\nDi sekitar kawasan, terdapat berbagai warung yang menjual makanan dan suvenir lokal. Pengunjung dapat mencicipi makanan khas Toraja sambil menikmati pemandangan. Hal ini menjadikan Buntu Burake sebagai tempat yang cocok untuk bersantai bersama keluarga dan teman.\r\n\r\nDengan perpaduan antara nilai religius, keindahan alam, dan aktivitas menarik, Buntu Burake adalah salah satu simbol utama pariwisata Toraja yang memikat hati wisatawan dari berbagai penjuru.', '2025-04-15', '07:00:00', '25000', 100),
(14, 'Lemo Stone Graves', 'images/0ecd983b8c4ab9a327b5b8f3358a4adc.jpeg', 'images/135108853e0244f4aea5aeeed29b7d0f.jpeg', 'images/ba39a9dfa3c1fc74a22784369db4e01d.jpeg', 'images/3807e795ade59d541d933e31a883ecc7.jpeg', 'images/4625df2640cfe85a76d39e98dd37e5bf.jpeg', 'Makale Utara', 'Makam batu kuno', 'Lemo Stone Graves adalah situs pemakaman kuno yang menjadi salah satu ikon budaya Toraja. Dikenal sebagai \"rumah arwah\", situs ini menampilkan deretan lubang makam yang dipahat langsung di tebing batu kapur. Di depan makam, terdapat deretan patung tau-tau yang melambangkan orang yang telah dimakamkan, menciptakan suasana yang penuh makna spiritual dan sejarah.\r\n\r\nSetiap lubang makam di Lemo memiliki cerita unik yang mencerminkan status sosial dan tradisi keluarga yang dimakamkan di sana. Ritual dan proses pembuatan makam ini dilakukan dengan penuh penghormatan, menunjukkan hubungan yang kuat antara masyarakat Toraja dan leluhur mereka. Pengunjung dapat merasakan atmosfer sakral yang kental saat menjelajahi area ini.\r\n\r\nSelain keunikan makam batu, Lemo juga menawarkan pemandangan alam yang indah. Terletak di tengah perbukitan hijau dan pepohonan rindang, lokasi ini memberikan nuansa yang tenang dan harmonis. Banyak wisatawan merasa terhubung dengan alam dan sejarah selama kunjungan mereka ke Lemo.\r\n\r\nUntuk wisatawan yang ingin mempelajari lebih dalam, pemandu lokal tersedia untuk menjelaskan makna dan simbolisme di balik setiap elemen di Lemo. Ini adalah cara yang baik untuk memahami tradisi Toraja secara mendalam. Dengan nilai budaya dan keindahan alam yang luar biasa, Lemo Stone Graves adalah destinasi yang wajib dikunjungi di Toraja.', '2025-05-01', '09:00:00', '15500', 78),
(15, 'Rambu Solo', 'images/154c4cb40843a5b7d160c835ef2c1f2f.jpeg', 'images/1eda9da0820050930f2155ed22e44a71.jpeg', 'images/24999f33b3f947b777da00635564d1bd.jpeg', 'images/659761e94c9b38802bbe8a50933dd287.jpeg', 'images/05a0b2d55ad662a032961b40f2be7155.jpeg', 'Sangalla', 'Upacara Pemakaman di Toraja', 'Rambu Solo\' adalah upacara pemakaman tradisional Toraja yang sarat dengan nilai budaya dan spiritual. Sebagai salah satu ritual paling penting dalam masyarakat Toraja, Rambu Solo\' dirancang untuk menghormati dan mengantar roh almarhum ke Puya, atau dunia akhirat. Prosesi ini melibatkan berbagai tahapan, mulai dari penyembelihan kerbau hingga tarian dan musik tradisional yang menggambarkan hubungan mendalam antara masyarakat Toraja dan leluhur mereka.\r\n\r\nUpacara ini biasanya berlangsung selama beberapa hari, dengan suasana yang penuh kebersamaan dan penghormatan. Salah satu ciri khasnya adalah penyembelihan kerbau, yang dipercaya sebagai simbol pengantar jiwa almarhum. Semakin tinggi status sosial almarhum, semakin banyak kerbau yang disembelih. Para tamu yang hadir pun membawa persembahan sebagai bentuk penghormatan dan solidaritas kepada keluarga yang berduka.\r\n\r\nRambu Solo\' juga menjadi momen berkumpul bagi keluarga besar dan masyarakat, menjadikannya sebagai perayaan kehidupan dan warisan budaya. Rumah adat Tongkonan sering kali menjadi pusat kegiatan, di mana prosesi dilakukan dengan penuh keagungan. Ritual ini tidak hanya memperkuat ikatan keluarga, tetapi juga mempertahankan tradisi turun-temurun yang telah menjadi identitas Toraja.\r\n\r\nSelain aspek spiritual, Rambu Solo\' juga menjadi daya tarik wisata budaya yang unik. Banyak wisatawan dari berbagai penjuru dunia datang untuk menyaksikan langsung keunikan dan keagungan upacara ini. Namun, penting bagi wisatawan untuk menghormati adat istiadat dan tradisi selama menghadiri upacara.\r\n\r\nDengan nilai-nilai budaya yang kaya dan ritual yang mendalam, Rambu Solo\' adalah salah satu warisan budaya yang tidak hanya memukau tetapi juga memberikan wawasan mendalam tentang kehidupan masyarakat Toraja.', '2025-05-20', '08:30:00', '50000', 65),
(16, 'Sarambu Waterfall', 'images/81c851162d5b3b5e138fef8a748bf3d2.jpeg', 'images/1a539fa116aa81cebcdda975dea70caa.jpeg', 'images/c43115280ab297ec196a8daf54b18452.jpeg', 'images/6aba99ad4cd7583403e5257a580711ad.jpeg', 'images/c1c8cf705fcaefc885e359e07c49a0b2.jpeg', 'Batupapan', 'Air terjun alami di Toraja', 'Sarambu Waterfall adalah salah satu keajaiban alam Toraja yang menawarkan keindahan air terjun yang menakjubkan. Dikelilingi oleh hutan hijau yang asri, air terjun ini menciptakan suasana yang menenangkan dan menyegarkan. Air yang jatuh deras dari ketinggian menghasilkan suara alami yang harmonis, memberikan sensasi kedamaian bagi para pengunjung.\r\n\r\nDestinasi ini adalah tempat yang sempurna bagi pencinta alam dan petualangan. Untuk mencapai Sarambu Waterfall, pengunjung harus menempuh perjalanan melalui jalur trekking yang menawarkan pemandangan perbukitan dan vegetasi tropis. Meski perjalanan memerlukan sedikit usaha, panorama yang ditawarkan di sepanjang jalan menjadikannya pengalaman yang tak terlupakan.\r\n\r\nSarambu Waterfall juga menjadi lokasi favorit untuk berbagai aktivitas, seperti berfoto, berenang di kolam alami, atau sekadar duduk bersantai menikmati keindahan alam. Udara sejuk dan suasana yang tenang membuat tempat ini ideal untuk melarikan diri dari hiruk-pikuk kehidupan sehari-hari.\r\n\r\nBagi masyarakat setempat, Sarambu Waterfall juga memiliki makna spiritual, dipercaya sebagai tempat yang membawa keberkahan dan kedamaian. Beberapa cerita rakyat dan mitos lokal turut menambah daya tarik budaya dari lokasi ini.\r\n\r\nDengan kombinasi keindahan alam dan nilai budaya, Sarambu Waterfall adalah destinasi yang wajib dikunjungi oleh siapa pun yang datang ke Toraja. Lokasinya yang eksotis dan suasana yang memikat menjadikannya salah satu permata tersembunyi di kawasan ini.', '2025-06-05', '17:30:00', '9000', 110);

-- --------------------------------------------------------

--
-- Table structure for table `tour_reserves`
--

CREATE TABLE `tour_reserves` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reservations` int(11) NOT NULL,
  `booking_date` datetime NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','cancelled') DEFAULT 'pending',
  `payment_proof` varchar(255) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_reserves`
--

INSERT INTO `tour_reserves` (`id`, `tour_id`, `user_id`, `reservations`, `booking_date`, `total_price`, `status`, `payment_proof`, `payment_date`) VALUES
(9, 4, 1, 6, '2024-12-25 17:38:48', 60000.00, 'pending', NULL, NULL),
(10, 9, 5, 10, '2024-12-25 18:03:28', 200000.00, 'pending', NULL, NULL),
(11, 14, 1, 5, '2024-12-25 18:35:31', 77500.00, 'pending', NULL, NULL);

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
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone`, `email`, `password`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'kelvin', '8888', 'kelvin@ramadan', '$2y$10$hl.DzBs0ZWDMxP//wjKvgOlJMvi7aqINcI1k9qAQpDoTts1lkMywi', 'uploads/profile_images/1_1735138260.jpeg', '2024-12-21 19:50:20', '2024-12-25 14:51:00'),
(2, 'alma', '877328', 'alma@gmail.com', '$2y$10$nJj6TcbDnXgqus49LTQc0.U6EJqWAmgupK7lZx16PmcI3jevh0D5K', '', '2024-12-22 09:33:32', '2024-12-23 01:22:33'),
(5, 'Lana Del Rey', '1898709170', 'Lanadelrey@gmail.com', '$2y$10$75wpw0hxktCqHGcRw9scRe46yTP97SgDweo42CK4rE0SQULrGTTG.', 'uploads/profile_images/5_1735146185.jpeg', '2024-12-25 14:58:34', '2024-12-25 17:03:05');

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
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_reserves`
--
ALTER TABLE `room_reserves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_room_reserves_user` (`user_id`),
  ADD KEY `idx_room_reserves_room` (`room_id`),
  ADD KEY `idx_room_status` (`status`),
  ADD KEY `idx_room_payment` (`payment_status`);

--
-- Indexes for table `tourism`
--
ALTER TABLE `tourism`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_reserves`
--
ALTER TABLE `tour_reserves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

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
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `room_reserves`
--
ALTER TABLE `room_reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tourism`
--
ALTER TABLE `tourism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tour_reserves`
--
ALTER TABLE `tour_reserves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_reserves`
--
ALTER TABLE `room_reserves`
  ADD CONSTRAINT `room_reserves_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `room_reserves_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tour_reserves`
--
ALTER TABLE `tour_reserves`
  ADD CONSTRAINT `tour_reserves_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tourism` (`id`),
  ADD CONSTRAINT `tour_reserves_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

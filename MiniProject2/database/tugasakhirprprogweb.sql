-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 07:23 PM
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
-- Database: `tugasakhirprprogweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `artis`
--

CREATE TABLE `artis` (
  `id_artis` int(11) NOT NULL,
  `nama_artis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artis`
--

INSERT INTO `artis` (`id_artis`, `nama_artis`) VALUES
(11, 'Afgan'),
(4, 'Alan Walker'),
(12, 'All-4-One'),
(7, 'Brian McKnight'),
(13, 'Christian Bautista'),
(5, 'David Foster'),
(8, 'Jessie J'),
(10, 'Josh Groban'),
(2, 'Jumat Gombrong'),
(3, 'Karaoke Paripurna'),
(6, 'Katharine McPhee'),
(1, 'NdarBoy Genk'),
(9, 'Rossa');

-- --------------------------------------------------------

--
-- Table structure for table `featuring`
--

CREATE TABLE `featuring` (
  `id_featuring` int(11) NOT NULL,
  `id_konser` int(11) NOT NULL,
  `id_artis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `featuring`
--

INSERT INTO `featuring` (`id_featuring`, `id_konser`, `id_artis`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 3, 5),
(6, 3, 10),
(7, 3, 6),
(8, 3, 7),
(9, 3, 8),
(10, 3, 9),
(11, 3, 11),
(12, 4, 12),
(13, 4, 13);

-- --------------------------------------------------------

--
-- Table structure for table `konser_data`
--

CREATE TABLE `konser_data` (
  `id_konser` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `description` text NOT NULL,
  `poster` text NOT NULL,
  `seating` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konser_data`
--

INSERT INTO `konser_data` (`id_konser`, `judul`, `venue`, `kota`, `tanggal_awal`, `tanggal_akhir`, `description`, `poster`, `seating`) VALUES
(1, 'Live Music : UKDW Seru', 'Auditorium Koinonia UKDW', 'Yogyakarta', '2024-07-13', '2024-07-13', 'Hallo koncoDW, kita happy2 bareng di Live Music Konser, UKDW Seru.\r\n\r\nSemua genre music bisa kumpul bersama nih, karena bakal kedatangan idola kalian dari berbagai macam music. So, kami tunggu kedatangan kalian di 13 July 2024, buruan amankan tiket kalian yahh.\r\n\r\nSYARAT & KETENTUAN PEMBELIAN TIKET:\r\n\r\nTiket UKDW SERU yang RESMI hanya bisa dibeli melalui @yesplisofficial / www.yesplis.com maupun official ticket box yang ditentukan penyelenggara. Jika Anda membeli tiket diluar itu, maka kami tidak bertanggung jawab jika tidak dinyatakan TIDAK VALID.\r\n\r\nHarga tiket belum termasuk Ticketing Tax dan Biaya Administrasi.\r\n\r\nPembelian dengan kartu kredit ataupun bank transfer dapat dikenakan biaya administrasi.\r\n\r\nPastikan Email yang Anda sertakan masih AKTIF. Pengiriman e-Ticket akan dikirimkan melalui Email yang Anda sertakan.\r\n\r\nTiket yang sudah dibeli TIDAK dapat ditukar ataupun diuangkan kembali atas dasar alasan apapun.\r\n\r\nPenukaran e-Ticket menjadi gelang dilakukan di venue pada saat Hari-H atau saat penukaran tiket sudah dibuka.\r\n\r\nPenyelenggara/promotor TIDAK bertanggung jawab atas kelalaian pembeli tiket yang mengakibatkan e-Ticket/Tiket jatuh ke tangan orang lain (dalam penguasaan orang lain) untuk digunakan sebagai tanda masuk ke tempat pertunjukan atau menukarkan tiket yang menghilangkan hak pembeli untuk masuk ke tempat pertunjukan/menukarkan e-Ticket.\r\n\r\nJika e-Ticket hilang, maka BUKAN menjadi tanggung jawab kami.\r\n\r\nJika menerima e-Ticket palsu/penduplikasian tiket BUKAN menjadi tanggung jawab kami.\r\n\r\nPembeli dan pengguna tiket dengan ini menyatakan melepaskan segala hak hukumnya untuk mengajukan tuntutan balik melalui pengadilan atau cara-cara apapun yang diperkenankan secara hukum untuk menuntut Penyelenggara dalam hal terjadi pembatalan acara yang dilakukan secara sepihak oleh pihak artis atau pemerintah atau sebab-sebab lain di luar kemampuan dan kehendak pihak Penyelenggara.\r\n\r\nSeluruh pembeli tiket dan pengunjung dianggap telah membaca, memahami, dan menyetujui Syarat dan Ketentuan untuk event UKDW SERU 2024.\r\n\r\nInformasi selengkapnya melalui Instagram @dewefest', 'PosterKonser\\UKDW_Seru.jpg', NULL),
(2, 'Alan Walker World', 'Phantom Ground Park', 'Tangerang', '2024-06-08', '2024-06-08', 'Color Asia Live dan Prestige Promotions dengan bangga mengumumkan kabar gembira mengenai: Alan Walker yang siap untuk memukau Jakarta, Indonesia, sebagai bagian dari tur Asia-nya yang sangat dinantikan bertajuk, \"Walker World Southeast Asia Tour Part 1\".Pertunjukan Alan Walker & Friends Live On Stage akan menampilkan beberapa Special Guests dari manca negara seperti Robin Packalen, Sofiloud, Putri Ariani dan masih akan ada lagi yang akan diumumkan dalam waktu dekat, akan berlangsung pada hari Sabtu, 8 Juni 2024, di Phantom PIK 2 Ground Park. Penjualan presale tiket akan tersedia mulai besok pada Jumat, 15 Maret 2024, pukul 10:00 pagi (WIB) secara eksklusif di www.alanwalkerjakarta.com dengan mitra penjualan tiket resmi oleh tiket.com.\r\n\r\n\r\nDestinasi menarik menjadi alasan mengapa PHANTOM - PIK 2 merupakan area hiburan tersentralisasi yang cocok dan strategis untuk Konser Alan Walker \"WALKER WORLD\" karena memiliki fasilitas luas dan modern, dengan luas impresif 3000 meter persegi, PHANTOM - PIK 2 dapat menampung ribuan pengunjung dan menyediakan ruang yang cukup untuk panggung dan area penonton. Fasilitas ini dilengkapi dengan sistem suara terbaik di kelasnya dan ambience yang memadai untuk mendukung konser musik yang spektakuler. Dengan lokasinya yang strategis di PIK 2 membuat PHANTOM - PIK 2 mudah diakses dari berbagai daerah di Jakarta dan sekitarnya. Akses transportasi umum dan parkir yang memadai akan memudahkan para pengunjung untuk datang ke konser musik.\r\n\r\n\r\nPHANTOM-PIK 2 dirancang oleh Top Indonesian Architect, memiliki desain yang mewah dan menawan, menciptakan atmosfer yang cocok untuk konser musik yang eksklusif dan berkelas. Selain area indoor, PHANTOM - PIK 2 juga dilengkapi dengan fasilitas pendukung seperti area makan dan minum, area lounge, dan area outdoor “PHANTOM GROUND PARK”, yang dapat menampung kapasitas hingga 20.000 pengunjung.', 'PosterKonser\\Alan_Walker_World.jpg', 'SeatingKonser\\Alan_Walker_World.jpg'),
(3, 'Hitman Returns', 'ICE BSD CITY', 'Tangerang', '2024-06-15', '2024-06-15', 'David Foster, pencetak hits dan pembuat bintang. Produser musik terkenal dunia akan kembali ke Indonesia dengan line-up terbaik! Bersama dengan Brian McKnight, Katharine McPhee, Jessie J, dan Josh Groban. Pemenang Grammy Awards ikonik ini tentunya akan memberikan penampilan konser terbaik. Jangan lewatkan!', 'PosterKonser\\Hitman_Returns.jpg', 'SeatingKonser\\Hitman_Returns.jpg'),
(4, 'All-4-One 30 Years Anniversary Tour', 'Ballroom Pullman Jakarta', 'Jakarta', '2024-06-23', '2024-06-23', 'All 4 One: 30 Years Anniversary Tour\r\n\r\nMark your calendars! All 4 One is bringing their 30 Years Anniversary Tour to Ballroom Pullman Jakarta Central Park on June 23, 2024. Join us for a night of celebration as we revisit all the hits that made All 4 One as one of the most popular R&B groups of the 90\'s. From \"I Swear\", \"So Much in Love\" to \"I Can Love You Like That,\" you\'ll be singing along to all your favorites.\r\n\r\nThis is a show you won\'t want to miss! Get your tickets now!', 'PosterKonser\\All-4-One_30 Aniv.jpg', 'SeatingKonser\\ALL-4-ONE.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_konser` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_data`
--

CREATE TABLE `pemesanan_data` (
  `id_data_pemesanan` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama_depan` varchar(255) NOT NULL,
  `nama_belakang` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_HP` varchar(20) NOT NULL,
  `id_tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tiket_data`
--

CREATE TABLE `tiket_data` (
  `id_tiket` int(11) NOT NULL,
  `jenis_tiket` varchar(255) NOT NULL,
  `id_konser` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket_data`
--

INSERT INTO `tiket_data` (`id_tiket`, `jenis_tiket`, `id_konser`, `harga`, `stok`) VALUES
(1, 'Presale 1', 1, 55000, 100),
(2, 'Presale 2', 1, 75000, 85),
(3, 'VIP', 1, 100000, 50),
(4, 'Festival B (Standing)', 2, 588000, 500),
(5, 'Festival (Standing)', 2, 900000, 580),
(6, 'Golden Festival (Standing)', 2, 1140000, 600),
(7, 'Platinum (Seating)', 2, 1500000, 300),
(8, 'Diamond (Seating)', 2, 1980000, 250),
(9, 'BRONZE', 3, 990000, 0),
(10, 'SILVER', 3, 1250000, 0),
(11, 'BLUE', 3, 1950000, 0),
(12, 'PLATINUM', 3, 2100000, 0),
(13, 'RUBY', 3, 2950000, 0),
(14, 'TOPAZ', 3, 3300000, 10),
(15, 'DIAMOND VIP', 3, 5000000, 20),
(16, 'SUPER VVIP', 3, 7500000, 27),
(17, 'Festival', 4, 450000, 29),
(18, 'Silver', 4, 950000, 45),
(19, 'Gold', 4, 1350000, 28),
(20, 'Platinum', 4, 2250000, 10),
(21, 'Platinum + Meet & Greet', 4, 3250000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artis`
--
ALTER TABLE `artis`
  ADD PRIMARY KEY (`id_artis`),
  ADD UNIQUE KEY `nama_artis` (`nama_artis`);

--
-- Indexes for table `featuring`
--
ALTER TABLE `featuring`
  ADD PRIMARY KEY (`id_featuring`),
  ADD KEY `id_konser` (`id_konser`),
  ADD KEY `id_artis` (`id_artis`);

--
-- Indexes for table `konser_data`
--
ALTER TABLE `konser_data`
  ADD PRIMARY KEY (`id_konser`),
  ADD UNIQUE KEY `judul` (`judul`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_konser` (`id_konser`),
  ADD KEY `id_tiket` (`id_tiket`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pemesanan_data`
--
ALTER TABLE `pemesanan_data`
  ADD PRIMARY KEY (`id_data_pemesanan`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_tiket` (`id_tiket`);

--
-- Indexes for table `tiket_data`
--
ALTER TABLE `tiket_data`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `id_konser` (`id_konser`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artis`
--
ALTER TABLE `artis`
  MODIFY `id_artis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `featuring`
--
ALTER TABLE `featuring`
  MODIFY `id_featuring` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `konser_data`
--
ALTER TABLE `konser_data`
  MODIFY `id_konser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemesanan_data`
--
ALTER TABLE `pemesanan_data`
  MODIFY `id_data_pemesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tiket_data`
--
ALTER TABLE `tiket_data`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `featuring`
--
ALTER TABLE `featuring`
  ADD CONSTRAINT `featuring_ibfk_1` FOREIGN KEY (`id_konser`) REFERENCES `konser_data` (`id_konser`),
  ADD CONSTRAINT `featuring_ibfk_2` FOREIGN KEY (`id_artis`) REFERENCES `artis` (`id_artis`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_konser`) REFERENCES `konser_data` (`id_konser`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`id_tiket`) REFERENCES `tiket_data` (`id_tiket`),
  ADD CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user_data` (`id_user`);

--
-- Constraints for table `pemesanan_data`
--
ALTER TABLE `pemesanan_data`
  ADD CONSTRAINT `pemesanan_data_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`),
  ADD CONSTRAINT `pemesanan_data_ibfk_2` FOREIGN KEY (`id_tiket`) REFERENCES `tiket_data` (`id_tiket`);

--
-- Constraints for table `tiket_data`
--
ALTER TABLE `tiket_data`
  ADD CONSTRAINT `tiket_data_ibfk_1` FOREIGN KEY (`id_konser`) REFERENCES `konser_data` (`id_konser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

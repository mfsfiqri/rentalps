-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 10:04 AM
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
-- Database: `rentalps`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `nama_game` varchar(50) NOT NULL,
  `nama_playstation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `nama_game`, `nama_playstation`) VALUES
(1, 'Hogwarts Legacy', 'PlayStation 5 (PS5)'),
(2, 'EA Sports FC 24', 'PlayStation 5 (PS5)'),
(3, 'God of War Ragnarök', 'PlayStation 5 (PS5)'),
(4, 'Elden Ring', 'PlayStation 5 (PS5)'),
(5, 'eFootball PES 2021', 'PlayStation 5 (PS5)');

-- --------------------------------------------------------

--
-- Table structure for table `orderan`
--

CREATE TABLE `orderan` (
  `id` int(11) NOT NULL,
  `kode_orderan` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_playstation` varchar(50) NOT NULL,
  `estimasi_jam` int(11) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `tanggal` date NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderan`
--

INSERT INTO `orderan` (`id`, `kode_orderan`, `username`, `nama_playstation`, `estimasi_jam`, `waktu_mulai`, `tanggal`, `harga`, `status`) VALUES
(2, '3a34c5', 'resa', 'PlayStation 5 (PS5)', 2, '16:00:00', '2023-12-11', 30000, 'sukses'),
(5, 'b1006b', 'nafrizal', 'PlayStation 5 (PS5)', 1, '18:09:00', '2023-12-10', 15000, 'sukses'),
(6, 'c7c521', 'nafrizal', 'PlayStation 5 (PS5)', 2, '19:26:00', '2023-12-06', 30000, 'sukses'),
(7, '2485c9', 'nafrizal', 'PlayStation 5 (PS5)', 3, '15:30:00', '2023-12-14', 45000, 'disewakan'),
(8, 'e3fd56', 'nafrizal', 'PlayStation 5 (PS5)', 1, '08:30:00', '2023-12-18', 15000, 'sukses'),
(9, '857763', 'resa', 'PlayStation 5 (PS5)', 2, '09:00:00', '2023-12-07', 30000, 'sukses'),
(10, '173ac8', 'resa', 'PlayStation 5 (PS5)', 2, '07:12:00', '2023-12-18', 30000, 'sukses'),
(11, '2e620c', 'resa', 'PlayStation 5 (PS5)', 3, '10:30:00', '2023-12-21', 45000, 'disewakan'),
(12, '1af71e', 'dicky', 'PlayStation 5 (PS5)', 3, '10:20:00', '2023-12-28', 45000, 'sukses');

-- --------------------------------------------------------

--
-- Table structure for table `playstation`
--

CREATE TABLE `playstation` (
  `id` int(11) NOT NULL,
  `nama_playstation` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `playstation`
--

INSERT INTO `playstation` (`id`, `nama_playstation`, `jumlah`) VALUES
(1, 'PlayStation 5 (PS5)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `level_user` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `no_telp`, `alamat`, `level_user`) VALUES
(8, 'admin', '$2y$10$2qQOEC07ww2kFlgIIAOGyObBo3YJxhbeK.j7q/vm80FvaWzf7BvzS', 'Fiqri', '082123123123', 'Bandung', 'admin'),
(9, 'resa', '$2y$10$Km9h3Mr6k57RO.L.GD0ln.d2gjesrfrqxNKxDakcO4TdhGuTgpcDW', 'Resa Aldiana', '085123123321', 'Majalaya', 'user'),
(10, 'nafrizal', '$2y$10$4SFI3/Id3Zdh4DlQQ57bDeNMy78DOfupIsisf/5qpJtgUAEDMbN1e', 'Nafrizal', '022123123123', 'Bandung', 'user'),
(11, 'dicky', '$2y$10$FNIMXIjxuHFSPq44CU14TuI7nXkSt1Hr6RFEtc1I0HzFI4BDNhyji', 'Dicky', '0212121', ' Bandung', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_game` (`nama_game`),
  ADD KEY `nama_playstation` (`nama_playstation`);

--
-- Indexes for table `orderan`
--
ALTER TABLE `orderan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_orderan` (`kode_orderan`),
  ADD KEY `username` (`username`),
  ADD KEY `nama_playstation` (`nama_playstation`);

--
-- Indexes for table `playstation`
--
ALTER TABLE `playstation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_playstation` (`nama_playstation`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orderan`
--
ALTER TABLE `orderan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `playstation`
--
ALTER TABLE `playstation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`nama_playstation`) REFERENCES `playstation` (`nama_playstation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orderan`
--
ALTER TABLE `orderan`
  ADD CONSTRAINT `orderan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orderan_ibfk_2` FOREIGN KEY (`nama_playstation`) REFERENCES `playstation` (`nama_playstation`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

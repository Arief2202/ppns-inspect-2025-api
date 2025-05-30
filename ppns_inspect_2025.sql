-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 07:19 AM
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
-- Database: `ppns_inspect_2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `apar`
--

CREATE TABLE `apar` (
  `id` int(255) NOT NULL,
  `jenis_pemadam` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `berat` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `tanggal_kadaluarsa` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hydrant`
--

CREATE TABLE `hydrant` (
  `id` int(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `jenis_hydrant` varchar(5) NOT NULL DEFAULT 'ihb',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------

--
-- Table structure for table `p3k`
--

CREATE TABLE `p3k` (
  `id` int(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspeksi_apar`
--

CREATE TABLE `inspeksi_apar` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `apar_id` int(255) NOT NULL,
  `tersedia` varchar(255) NOT NULL,
  `alasan` varchar(255) NOT NULL,
  `kondisi_tabung` varchar(255) NOT NULL,
  `segel_pin` varchar(255) NOT NULL,
  `tuas_pegangan` varchar(255) NOT NULL,
  `label_segitiga` varchar(255) NOT NULL,
  `label_instruksi` varchar(255) NOT NULL,
  `kondisi_selang` varchar(255) NOT NULL,
  `tekanan_tabung` varchar(255) NOT NULL,
  `posisi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspeksi_hydrant_ihb`
--

CREATE TABLE `inspeksi_hydrant_ihb` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `hydrant_id` int(255) NOT NULL,
  `kondisi_kotak` varchar(255) NOT NULL,
  `posisi_kotak` varchar(255) NOT NULL,
  `kondisi_nozzle` varchar(255) NOT NULL,
  `kondisi_selang` varchar(255) NOT NULL,
  `jenis_selang` varchar(255) NOT NULL,
  `kondisi_coupling` varchar(255) NOT NULL,
  `kondisi_landing_valve` varchar(255) NOT NULL,
  `kondisi_tray` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspeksi_hydrant_ohb`
--

CREATE TABLE `inspeksi_hydrant_ohb` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `hydrant_id` int(255) NOT NULL,
  `kondisi_kotak` varchar(255) NOT NULL,
  `posisi_kotak` varchar(255) NOT NULL,
  `kondisi_nozzle` varchar(255) NOT NULL,
  `kondisi_selang` varchar(255) NOT NULL,
  `jenis_selang` varchar(255) NOT NULL,
  `kondisi_coupling` varchar(255) NOT NULL,
  `tuas_pembuka` varchar(255) NOT NULL,
  `kondisi_outlet` varchar(255) NOT NULL,
  `penutup_cop` varchar(255) NOT NULL,
  `flushing_hydrant` varchar(255) NOT NULL,
  `tekanan_hydrant` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `inspeksi_p3k` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `kotak_id` int(255) NOT NULL,
  `kasa_steril_bungkus` varchar(255) NOT NULL,
  `perban5` varchar(255) NOT NULL,
  `perban10` varchar(255) NOT NULL,
  `plester125` varchar(255) NOT NULL,
  `plester_cepat` varchar(255) NOT NULL,
  `kapas` varchar(255) NOT NULL,
  `mitella` varchar(255) NOT NULL,
  `gunting` varchar(255) NOT NULL,
  `peniti` varchar(255) NOT NULL,
  `sarung_tangan` varchar(255) NOT NULL,
  `masker` varchar(255) NOT NULL,
  `pinset` varchar(255) NOT NULL,
  `lampu_senter` varchar(255) NOT NULL,
  `gelas_cuci_mata` varchar(255) NOT NULL,
  `kantong_plastik` varchar(255) NOT NULL,
  `aquades` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `inspeksi_jalur_evakuasi` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `kebersihan` varchar(255) NOT NULL,
  `penanda_exit` varchar(255) NOT NULL,
  `kebebasan_hambatan` varchar(255) NOT NULL,
  `penerangan_jalur` varchar(255) NOT NULL,
  `tanda_arah` varchar(255) NOT NULL,
  `material_lantai` varchar(255) NOT NULL,
  `tanda_pintu_darurat` varchar(255) NOT NULL,
  `pegangan_rambat` varchar(255) NOT NULL,
  `pencahayaan_darurat` varchar(255) NOT NULL,
  `identifikasi_titik_kumpul` varchar(255) NOT NULL,
  `jalur_menuju_titik_kumpul` varchar(255) NOT NULL,
  `peralatan_darurat` varchar(255) NOT NULL,
  `peta_evakuasi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `displayed` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` int(255) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apar`
--
ALTER TABLE `apar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hydrant`
--
ALTER TABLE `hydrant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p3k`
--
ALTER TABLE `p3k`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `inspeksi_apar`
--
ALTER TABLE `inspeksi_apar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspeksi_hydrant_ihb`
--
ALTER TABLE `inspeksi_hydrant_ihb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspeksi_hydrant_ohb`
--
ALTER TABLE `inspeksi_hydrant_ohb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspeksi_p3k`
--
ALTER TABLE `inspeksi_p3k`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

  
--
-- Indexes for table `inspeksi_jalur_evakuasi`
--
ALTER TABLE `inspeksi_jalur_evakuasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apar`
--
ALTER TABLE `apar`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hydrant`
--
ALTER TABLE `hydrant`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `p3k`
--
ALTER TABLE `p3k`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspeksi_apar`
--
ALTER TABLE `inspeksi_apar`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspeksi_hydrant_ihb`
--
ALTER TABLE `inspeksi_hydrant_ihb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspeksi_hydrant_ohb`
--
ALTER TABLE `inspeksi_hydrant_ohb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspeksi_p3k`
--
ALTER TABLE `inspeksi_p3k`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- AUTO_INCREMENT for table `inspeksi_jalur_evakuasi`
--
ALTER TABLE `inspeksi_jalur_evakuasi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `created_at`) VALUES (NULL, '1', 'admin', 'admin', '$2y$10$3iXDxjq7nBpBnWG5ta8r4eggd2CpwP3qYBNVP76CrgQXMaPKnAOjG', current_timestamp());
INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `created_at`) VALUES (NULL, '0', 'inspektor', 'inspektor', '$2y$10$TZOtCNTC28yxWNccSr5qB.lbiVklElOl29ue3Xnofmd/xA6Xm53iC', current_timestamp());

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

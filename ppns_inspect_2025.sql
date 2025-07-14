/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ppns_2025_inspect
-- ------------------------------------------------------
-- Server version	10.11.13-MariaDB-0ubuntu0.24.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `apar`
--

DROP TABLE IF EXISTS `apar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `apar` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `jenis_pemadam` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `berat` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `tanggal_kadaluarsa` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hydrant`
--

DROP TABLE IF EXISTS `hydrant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `hydrant` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `jenis_hydrant` varchar(5) NOT NULL DEFAULT 'ihb',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inspeksi_apar`
--

DROP TABLE IF EXISTS `inspeksi_apar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `inspeksi_apar` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `kondisi_roda` varchar(255) NOT NULL DEFAULT 'Not Applicable',
  `durasi_inspeksi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inspeksi_hydrant_ihb`
--

DROP TABLE IF EXISTS `inspeksi_hydrant_ihb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `inspeksi_hydrant_ihb` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `durasi_inspeksi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inspeksi_hydrant_ohb`
--

DROP TABLE IF EXISTS `inspeksi_hydrant_ohb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `inspeksi_hydrant_ohb` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `durasi_inspeksi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inspeksi_jalur_evakuasi`
--

DROP TABLE IF EXISTS `inspeksi_jalur_evakuasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `inspeksi_jalur_evakuasi` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `pintu_dikunci` varchar(255) NOT NULL,
  `pintu_berfungsi` varchar(255) NOT NULL,
  `terdapat_ganjal` varchar(255) NOT NULL,
  `terbebas_halangan` varchar(255) NOT NULL,
  `terbebas_hambatan` varchar(255) NOT NULL,
  `pintu_pelepasan_terkunci` varchar(255) NOT NULL,
  `durasi_inspeksi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inspeksi_p3k`
--

DROP TABLE IF EXISTS `inspeksi_p3k`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `inspeksi_p3k` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
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
  `durasi_inspeksi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `displayed` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `p3k`
--

DROP TABLE IF EXISTS `p3k`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `p3k` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `role` int(255) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-15  3:51:53

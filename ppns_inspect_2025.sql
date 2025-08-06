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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
  `tersedia_img` varchar(255) DEFAULT NULL,
  `kondisi_tabung_img` varchar(255) DEFAULT NULL,
  `segel_pin_img` varchar(255) DEFAULT NULL,
  `tuas_pegangan_img` varchar(255) DEFAULT NULL,
  `label_segitiga_img` varchar(255) DEFAULT NULL,
  `label_instruksi_img` varchar(255) DEFAULT NULL,
  `kondisi_selang_img` varchar(255) DEFAULT NULL,
  `tekanan_tabung_img` varchar(255) DEFAULT NULL,
  `posisi_img` varchar(255) DEFAULT NULL,
  `kondisi_roda_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
  `kondisi_kotak_img` varchar(255) DEFAULT NULL,
  `posisi_kotak_img` varchar(255) DEFAULT NULL,
  `kondisi_nozzle_img` varchar(255) DEFAULT NULL,
  `kondisi_selang_img` varchar(255) DEFAULT NULL,
  `jenis_selang_img` varchar(255) DEFAULT NULL,
  `kondisi_coupling_img` varchar(255) DEFAULT NULL,
  `kondisi_landing_valve_img` varchar(255) DEFAULT NULL,
  `kondisi_tray_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
  `kondisi_kotak_img` varchar(255) DEFAULT NULL,
  `posisi_kotak_img` varchar(255) DEFAULT NULL,
  `kondisi_nozzle_img` varchar(255) DEFAULT NULL,
  `kondisi_selang_img` varchar(255) DEFAULT NULL,
  `jenis_selang_img` varchar(255) DEFAULT NULL,
  `kondisi_coupling_img` varchar(255) DEFAULT NULL,
  `tuas_pembuka_img` varchar(255) DEFAULT NULL,
  `kondisi_outlet_img` varchar(255) DEFAULT NULL,
  `penutup_cop_img` varchar(255) DEFAULT NULL,
  `flushing_hydrant_img` varchar(255) DEFAULT NULL,
  `tekanan_hydrant_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
  `pintu_terkunci` varchar(255) NOT NULL,
  `pintu_berfungsi` varchar(255) NOT NULL,
  `ganjal` varchar(255) NOT NULL,
  `ganjal_tangga` varchar(255) NOT NULL,
  `kebersihan_tangga` varchar(255) NOT NULL,
  `hambatan_eksit` varchar(255) NOT NULL,
  `eksit_terkunci` varchar(255) NOT NULL,
  `visibilitas_eksit` varchar(255) NOT NULL,
  `pencahayaan_eksit` varchar(255) NOT NULL,
  `durasi_inspeksi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pintu_terkunci_img` varchar(255) DEFAULT NULL,
  `pintu_berfungsi_img` varchar(255) DEFAULT NULL,
  `ganjal_img` varchar(255) DEFAULT NULL,
  `ganjal_tangga_img` varchar(255) DEFAULT NULL,
  `kebersihan_tangga_img` varchar(255) DEFAULT NULL,
  `hambatan_eksit_img` varchar(255) DEFAULT NULL,
  `eksit_terkunci_img` varchar(255) DEFAULT NULL,
  `visibilitas_eksit_img` varchar(255) DEFAULT NULL,
  `pencahayaan_eksit_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
  `oxygen` varchar(255) NOT NULL,
  `obat_luka_bakar` varchar(255) NOT NULL,
  `buku_catatan` varchar(255) NOT NULL,
  `daftar_isi` varchar(255) NOT NULL,
  `durasi_inspeksi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `kasa_steril_bungkus_img` varchar(255) DEFAULT NULL,
  `perban5_img` varchar(255) DEFAULT NULL,
  `perban10_img` varchar(255) DEFAULT NULL,
  `plester125_img` varchar(255) DEFAULT NULL,
  `plester_cepat_img` varchar(255) DEFAULT NULL,
  `kapas_img` varchar(255) DEFAULT NULL,
  `mitella_img` varchar(255) DEFAULT NULL,
  `gunting_img` varchar(255) DEFAULT NULL,
  `peniti_img` varchar(255) DEFAULT NULL,
  `sarung_tangan_img` varchar(255) DEFAULT NULL,
  `masker_img` varchar(255) DEFAULT NULL,
  `pinset_img` varchar(255) DEFAULT NULL,
  `lampu_senter_img` varchar(255) DEFAULT NULL,
  `gelas_cuci_mata_img` varchar(255) DEFAULT NULL,
  `kantong_plastik_img` varchar(255) DEFAULT NULL,
  `aquades_img` varchar(255) DEFAULT NULL,
  `oxygen_img` varchar(255) DEFAULT NULL,
  `obat_luka_bakar_img` varchar(255) DEFAULT NULL,
  `buku_catatan_img` varchar(255) DEFAULT NULL,
  `daftar_isi_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `inspeksi_rumah_pompa`
--

DROP TABLE IF EXISTS `inspeksi_rumah_pompa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `inspeksi_rumah_pompa` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `kondisi` varchar(255) NOT NULL,
  `ventilasi` varchar(255) NOT NULL,
  `katup_hisap` varchar(255) NOT NULL,
  `perpipaan` varchar(255) NOT NULL,
  `pengukur_hisap` varchar(255) NOT NULL,
  `pengukur_sistem` varchar(255) NOT NULL,
  `tangki_hisap` varchar(255) NOT NULL,
  `saringan_hisap` varchar(255) NOT NULL,
  `katup_uji` varchar(255) NOT NULL,
  `lampu_pengontrol` varchar(255) NOT NULL,
  `lampu_saklar` varchar(255) NOT NULL,
  `saklar_isolasi` varchar(255) NOT NULL,
  `lampu_rotasi` varchar(255) NOT NULL,
  `level_oli_motor` varchar(255) NOT NULL,
  `pompa_pemeliharaan` varchar(255) NOT NULL,
  `tangki_bahan_bakar` varchar(255) NOT NULL,
  `saklar_pemilih` varchar(255) NOT NULL,
  `pembacaan_tegangan` varchar(255) NOT NULL,
  `pembacaan_arus` varchar(255) NOT NULL,
  `lampu_baterai` varchar(255) NOT NULL,
  `semua_lampu_alarm` varchar(255) NOT NULL,
  `pengukur_waktu` varchar(255) NOT NULL,
  `ketinggian_oli` varchar(255) NOT NULL,
  `level_oli_mesin` varchar(255) NOT NULL,
  `ketinggian_air` varchar(255) NOT NULL,
  `tingkat_elektrolit` varchar(255) NOT NULL,
  `terminal_baterai` varchar(255) NOT NULL,
  `pemanas_jaket` varchar(255) NOT NULL,
  `kondisi_uap` varchar(255) NOT NULL,
  `durasi_inspeksi` varchar(255) DEFAULT '00:00',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `kondisi_img` varchar(255) DEFAULT NULL,
  `ventilasi_img` varchar(255) DEFAULT NULL,
  `katup_hisap_img` varchar(255) DEFAULT NULL,
  `perpipaan_img` varchar(255) DEFAULT NULL,
  `pengukur_hisap_img` varchar(255) DEFAULT NULL,
  `pengukur_sistem_img` varchar(255) DEFAULT NULL,
  `tangki_hisap_img` varchar(255) DEFAULT NULL,
  `saringan_hisap_img` varchar(255) DEFAULT NULL,
  `katup_uji_img` varchar(255) DEFAULT NULL,
  `lampu_pengontrol_img` varchar(255) DEFAULT NULL,
  `lampu_saklar_img` varchar(255) DEFAULT NULL,
  `saklar_isolasi_img` varchar(255) DEFAULT NULL,
  `lampu_rotasi_img` varchar(255) DEFAULT NULL,
  `level_oli_motor_img` varchar(255) DEFAULT NULL,
  `pompa_pemeliharaan_img` varchar(255) DEFAULT NULL,
  `tangki_bahan_bakar_img` varchar(255) DEFAULT NULL,
  `saklar_pemilih_img` varchar(255) DEFAULT NULL,
  `pembacaan_tegangan_img` varchar(255) DEFAULT NULL,
  `pembacaan_arus_img` varchar(255) DEFAULT NULL,
  `lampu_baterai_img` varchar(255) DEFAULT NULL,
  `semua_lampu_alarm_img` varchar(255) DEFAULT NULL,
  `pengukur_waktu_img` varchar(255) DEFAULT NULL,
  `ketinggian_oli_img` varchar(255) DEFAULT NULL,
  `level_oli_mesin_img` varchar(255) DEFAULT NULL,
  `ketinggian_air_img` varchar(255) DEFAULT NULL,
  `tingkat_elektrolit_img` varchar(255) DEFAULT NULL,
  `terminal_baterai_img` varchar(255) DEFAULT NULL,
  `pemanas_jaket_img` varchar(255) DEFAULT NULL,
  `kondisi_uap_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=996 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-06 23:46:52

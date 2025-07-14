<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['create']) || isset($_POST['create'])){
        $user_id;
        $lokasi;
        $kebersihan;
        $penanda_exit;
        $kebebasan_hambatan;
        $penerangan_jalur;
        $tanda_arah;
        $material_lantai;
        $tanda_pintu_darurat;
        $pegangan_rambat;
        $pencahayaan_darurat;
        $identifikasi_titik_kumpul;
        $jalur_menuju_titik_kumpul;
        $peralatan_darurat;
        $peta_evakuasi;
        $pintu_dikunci;
        $pintu_berfungsi;
        $terdapat_ganjal;
        $terbebas_halangan;
        $terbebas_hambatan;
        $pintu_pelepasan_terkunci;
        $durasi_inspeksi;

        if(isset($_GET['create'])){
            $user_id = $_GET['user_id'];
            $lokasi = $_GET['lokasi'];
            $kebersihan = $_GET['kebersihan'];
            $penanda_exit = $_GET['penanda_exit'];
            $kebebasan_hambatan = $_GET['kebebasan_hambatan'];
            $penerangan_jalur = $_GET['penerangan_jalur'];
            $tanda_arah = $_GET['tanda_arah'];
            $material_lantai = $_GET['material_lantai'];
            $tanda_pintu_darurat = $_GET['tanda_pintu_darurat'];
            $pegangan_rambat = $_GET['pegangan_rambat'];
            $pencahayaan_darurat = $_GET['pencahayaan_darurat'];
            $identifikasi_titik_kumpul = $_GET['identifikasi_titik_kumpul'];
            $jalur_menuju_titik_kumpul = $_GET['jalur_menuju_titik_kumpul'];
            $peralatan_darurat = $_GET['peralatan_darurat'];
            $peta_evakuasi = $_GET['peta_evakuasi'];
            $pintu_dikunci = $_GET['pintu_dikunci'];
            $pintu_berfungsi = $_GET['pintu_berfungsi'];
            $terdapat_ganjal = $_GET['terdapat_ganjal'];
            $terbebas_halangan = $_GET['terbebas_halangan'];
            $terbebas_hambatan = $_GET['terbebas_hambatan'];
            $pintu_pelepasan_terkunci = $_GET['pintu_pelepasan_terkunci'];
            $durasi_inspeksi = $_GET['durasi_inspeksi'];
        }
        if(isset($_POST['create'])){
            $user_id = $_POST['user_id'];
            $lokasi = $_POST['lokasi'];
            $kebersihan = $_POST['kebersihan'];
            $penanda_exit = $_POST['penanda_exit'];
            $kebebasan_hambatan = $_POST['kebebasan_hambatan'];
            $penerangan_jalur = $_POST['penerangan_jalur'];
            $tanda_arah = $_POST['tanda_arah'];
            $material_lantai = $_POST['material_lantai'];
            $tanda_pintu_darurat = $_POST['tanda_pintu_darurat'];
            $pegangan_rambat = $_POST['pegangan_rambat'];
            $pencahayaan_darurat = $_POST['pencahayaan_darurat'];
            $identifikasi_titik_kumpul = $_POST['identifikasi_titik_kumpul'];
            $jalur_menuju_titik_kumpul = $_POST['jalur_menuju_titik_kumpul'];
            $peralatan_darurat = $_POST['peralatan_darurat'];
            $peta_evakuasi = $_POST['peta_evakuasi'];
            $pintu_dikunci = $_POST['pintu_dikunci'];
            $pintu_berfungsi = $_POST['pintu_berfungsi'];
            $terdapat_ganjal = $_POST['terdapat_ganjal'];
            $terbebas_halangan = $_POST['terbebas_halangan'];
            $terbebas_hambatan = $_POST['terbebas_hambatan'];
            $pintu_pelepasan_terkunci = $_POST['pintu_pelepasan_terkunci'];
            $durasi_inspeksi = $_POST['durasi_inspeksi'];
        }
        
        if( $kebersihan != 'Ya' || 
            $penanda_exit != 'Ya' || 
            $kebebasan_hambatan != 'Ya' || 
            $penerangan_jalur != 'Ya' || 
            $tanda_arah != 'Ya' || 
            $material_lantai != 'Ya' || 
            $tanda_pintu_darurat != 'Ya' || 
            $pegangan_rambat != 'Ya' || 
            $pencahayaan_darurat != 'Ya' || 
            $identifikasi_titik_kumpul != 'Ya' || 
            $jalur_menuju_titik_kumpul != 'Ya' || 
            $peralatan_darurat != 'Ya' || 
            $peta_evakuasi != 'Ya' ||
            $pintu_dikunci != 'Ya' ||
            $pintu_berfungsi != 'Ya' ||
            $terdapat_ganjal != 'Ya' ||
            $terbebas_halangan != 'Ya' ||
            $terbebas_hambatan != 'Ya' ||
            $pintu_pelepasan_terkunci != 'Ya'
        ){
            $users = mysqli_query($conn, "SELECT * FROM users where role = 1");
            while($userAdmin = mysqli_fetch_object($users)){
                mysqli_query($conn, "INSERT INTO `notification` (`id`, `user_id`, `title`, `content`, `displayed`, `timestamp`) VALUES (NULL, '$userAdmin->id', 'Jalur Evakuasi Abnormal Terinspeksi', 'Telah terdeteksi Jalur Evakuasi Abnormal', '0', current_timestamp());");
            }
        }

        $sql = "INSERT INTO `inspeksi_jalur_evakuasi` (`id`, `user_id`, `lokasi`, `kebersihan`,`penanda_exit`,`kebebasan_hambatan`,`penerangan_jalur`,`tanda_arah`,`material_lantai`,`tanda_pintu_darurat`,`pegangan_rambat`,`pencahayaan_darurat`,`identifikasi_titik_kumpul`,`jalur_menuju_titik_kumpul`,`peralatan_darurat`,`peta_evakuasi`, `pintu_dikunci`, `pintu_berfungsi`, `terdapat_ganjal`, `terbebas_halangan`, `terbebas_hambatan`, `pintu_pelepasan_terkunci`, `durasi_inspeksi`, `created_at`) VALUES (NULL, $user_id, '$lokasi', '$kebersihan','$penanda_exit','$kebebasan_hambatan','$penerangan_jalur','$tanda_arah','$material_lantai','$tanda_pintu_darurat','$pegangan_rambat','$pencahayaan_darurat','$identifikasi_titik_kumpul','$jalur_menuju_titik_kumpul','$peralatan_darurat','$peta_evakuasi', '$pintu_dikunci', '$pintu_berfungsi', '$terdapat_ganjal', '$terbebas_halangan', '$terbebas_hambatan', '$pintu_pelepasan_terkunci', '$durasi_inspeksi', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "pesan" => "Data Inspeksi Jalur Evakuasi Berhasil Ditambahkan",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data Inspeksi Jalur Evakuasi Gagal Ditambahkan",
            ]);
        }
    }
    
    if(isset($_GET['read']) || isset($_POST['read'])){
        $datas = [];
        $result = null;
        $start_date = null;
        $end_date = null;
        $inspeksi = null;
        $kerusakan = null;
        if(isset($_GET['read'])){
            if(isset($_GET['start_date'])) $start_date = $_GET['start_date'];
            if(isset($_GET['end_date'])) $end_date = $_GET['end_date'];
            if(isset($_GET['inspeksi'])) $inspeksi = $_GET['inspeksi'];
            if(isset($_GET['kerusakan'])) $kerusakan = $_GET['kerusakan'];
        }
        if($start_date!=null & $end_date != null){            
            $sqlll = "SELECT * FROM inspeksi_jalur_evakuasi WHERE created_at > '$start_date' AND created_at < '$end_date'";
            
            if($kerusakan == "tidak") $sqlll .= " AND `kebersihan` = 'Ya' AND `penanda_exit` = 'Ya' AND `kebebasan_hambatan` = 'Ya' AND `penerangan_jalur` = 'Ya' AND `tanda_arah` = 'Ya' AND `material_lantai` = 'Ya' AND `tanda_pintu_darurat` = 'Ya' AND `pegangan_rambat` = 'Ya' AND `pencahayaan_darurat` = 'Ya' AND `identifikasi_titik_kumpul` = 'Ya' AND `jalur_menuju_titik_kumpul` = 'Ya' AND `peralatan_darurat` = 'Ya' AND `peta_evakuasi` = 'Ya' AND `pintu_dikunci` = 'Ya' AND `pintu_berfungsi` = 'Ya' AND `terdapat_ganjal` = 'Ya' AND `terbebas_halangan` = 'Ya' AND `terbebas_hambatan` = 'Ya' AND `pintu_pelepasan_terkunci` = 'Ya'";
            if($kerusakan == "rusak") $sqlll .= " AND (`kebersihan` != 'Ya' OR `penanda_exit` != 'Ya' OR `kebebasan_hambatan` != 'Ya' OR `penerangan_jalur` != 'Ya' OR `tanda_arah` != 'Ya' OR `material_lantai` != 'Ya' OR `tanda_pintu_darurat` != 'Ya' OR `pegangan_rambat` != 'Ya' OR `pencahayaan_darurat` != 'Ya' OR `identifikasi_titik_kumpul` != 'Ya' OR `jalur_menuju_titik_kumpul` != 'Ya' OR `peralatan_darurat` != 'Ya' OR `peta_evakuasi` != 'Ya' OR `pintu_dikunci` != 'Ya' OR `pintu_berfungsi` != 'Ya' OR `terdapat_ganjal` != 'Ya' OR `terbebas_halangan` != 'Ya' OR `terbebas_hambatan` != 'Ya' OR `pintu_pelepasan_terkunci` != 'Ya')";

            $result = mysqli_query($conn,$sqlll);
        }
        else $result = mysqli_query($conn, "SELECT * FROM inspeksi_jalur_evakuasi");
        $arr = 0;
        if($result){
            http_response_code(200);
                while($data = mysqli_fetch_object($result)){
                $resultUser = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data->user_id"));
                $data->user = $resultUser;
                $datas[$arr++] = $data;
            }
            echo json_encode([
                "status" => "success",
                "pesan" => "Read data inspeksi Success",
                "data" => $datas,

            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Read data inspeksi Failed",
            ]);
        }
    }

    if(isset($_GET['search']) || isset($_POST['search'])){
        $data2 = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_jalur_evakuasi WHERE created_at > '".date("Y-m")."-01 00:00:00' AND created_at < '".date("Y-m")."-31 23:59:59'"));
        if($data2){
            $user = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data2->user_id"));
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "inspection" => false,
                "pesan" => "Search data Successed!",
                "data_inspeksi" => $data2,
                "data_user" => $user,
            ]);die;
        }
        else{
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "inspection" => true,
                "pesan" => "Search data Successed!",
                "data" => $data,
            ]);die;
        }
    
    }
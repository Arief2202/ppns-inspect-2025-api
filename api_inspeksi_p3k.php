<?php
    include "koneksi.php";
    date_default_timezone_set("Asia/Jakarta");
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['create']) || isset($_POST['create'])){

        $user_id = null;
        $kotak_id = null;
        $kasa_steril_bungkus = null;
        $perban5 = null;
        $perban10 = null;
        $plester125 = null;
        $plester_cepat = null;
        $kapas = null;
        $mitella = null;
        $gunting = null;
        $peniti = null;
        $sarung_tangan = null;
        $masker = null;
        $pinset = null;
        $lampu_senter = null;
        $gelas_cuci_mata = null;
        $kantong_plastik = null;
        $aquades = null;
        $oxygen = null;
        $obat_luka_bakar = null;
        $buku_catatan = null;
        $daftar_isi = null;
        $durasi_inspeksi = null;

        if(isset($_GET['create'])){
            $user_id = $_GET['user_id'];
            $kotak_id = $_GET['kotak_id'];
            $kasa_steril_bungkus = $_GET['kasa_steril_bungkus'];
            $perban5 = $_GET['perban5'];
            $perban10 = $_GET['perban10'];
            $plester125 = $_GET['plester125'];
            $plester_cepat = $_GET['plester_cepat'];
            $kapas = $_GET['kapas'];
            $mitella = $_GET['mitella'];
            $gunting = $_GET['gunting'];
            $peniti = $_GET['peniti'];
            $sarung_tangan = $_GET['sarung_tangan'];
            $masker = $_GET['masker'];
            $pinset = $_GET['pinset'];
            $lampu_senter = $_GET['lampu_senter'];
            $gelas_cuci_mata = $_GET['gelas_cuci_mata'];
            $kantong_plastik = $_GET['kantong_plastik'];
            $aquades = $_GET['aquades'];
            $oxygen = $_GET['oxygen'];
            $obat_luka_bakar = $_GET['obat_luka_bakar'];
            $buku_catatan = $_GET['buku_catatan'];
            $daftar_isi = $_GET['daftar_isi'];
            $durasi_inspeksi = $_GET['durasi_inspeksi'];
        }
        else if(isset($_POST['create'])){
            $user_id = $_POST['user_id'];
            $kotak_id = $_POST['kotak_id'];
            $kasa_steril_bungkus = $_POST['kasa_steril_bungkus'];
            $perban5 = $_POST['perban5'];
            $perban10 = $_POST['perban10'];
            $plester125 = $_POST['plester125'];
            $plester_cepat = $_POST['plester_cepat'];
            $kapas = $_POST['kapas'];
            $mitella = $_POST['mitella'];
            $gunting = $_POST['gunting'];
            $peniti = $_POST['peniti'];
            $sarung_tangan = $_POST['sarung_tangan'];
            $masker = $_POST['masker'];
            $pinset = $_POST['pinset'];
            $lampu_senter = $_POST['lampu_senter'];
            $gelas_cuci_mata = $_POST['gelas_cuci_mata'];
            $kantong_plastik = $_POST['kantong_plastik'];
            $aquades = $_POST['aquades'];
            $oxygen = $_POST['oxygen'];
            $obat_luka_bakar = $_POST['obat_luka_bakar'];
            $buku_catatan = $_POST['buku_catatan'];
            $daftar_isi = $_POST['daftar_isi'];
            $durasi_inspeksi = $_POST['durasi_inspeksi'];
        }
        
        if( 
            $user_id != 'Ada' || 
            $kotak_id != 'Ada' || 
            $kasa_steril_bungkus != 'Ada' || 
            $perban5 != 'Ada' || 
            $perban10 != 'Ada' || 
            $plester125 != 'Ada' || 
            $plester_cepat != 'Ada' || 
            $kapas != 'Ada' || 
            $mitella != 'Ada' || 
            $gunting != 'Berfungsi' || 
            $peniti != 'Ada' || 
            $sarung_tangan != 'Ada' || 
            $masker != 'Ada' || 
            $pinset != 'Berfungsi' || 
            $lampu_senter != 'Berfungsi' || 
            $gelas_cuci_mata != 'Ada' || 
            $kantong_plastik != 'Ada' || 
            $aquades != 'Ada' ||
            $oxygen != 'Ada' || 
            $obat_luka_bakar != 'Ada' || 
            $buku_catatan != 'Ada' || 
            $daftar_isi != 'Ada'  
        ){
            $users = mysqli_query($conn, "SELECT * FROM users where role = 1");
            while($userAdmin = mysqli_fetch_object($users)){
                $p3k = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM p3k WHERE id = $kotak_id"));
                mysqli_query($conn, "INSERT INTO `notification` (`id`, `user_id`, `title`, `content`, `displayed`, `timestamp`) VALUES (NULL, '$userAdmin->id', 'P3K Abnormal Terinspeksi', 'Telah terdeteksi P3K rusak dengan Nomor : $p3k->nomor', '0', current_timestamp());");
            }
        }

        $sql = "INSERT INTO `inspeksi_p3k` (`id`, `user_id`, `kotak_id`, `kasa_steril_bungkus`, `perban5`, `perban10`, `plester125`, `plester_cepat`, `kapas`, `mitella`, `gunting`, `peniti`, `sarung_tangan`, `masker`, `pinset`, `lampu_senter`, `gelas_cuci_mata`, `kantong_plastik`, `aquades`, `oxygen`, `obat_luka_bakar`, `buku_catatan`, `daftar_isi`, `durasi_inspeksi`, `created_at`) VALUES (NULL, '$user_id','$kotak_id','$kasa_steril_bungkus','$perban5','$perban10','$plester125','$plester_cepat','$kapas','$mitella','$gunting','$peniti','$sarung_tangan','$masker','$pinset','$lampu_senter','$gelas_cuci_mata','$kantong_plastik', '$aquades', '$oxygen', '$obat_luka_bakar', '$buku_catatan', '$daftar_isi', '$durasi_inspeksi', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "pesan" => "Data Inspeksi P3K Berhasil Ditambahkan",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data Inspeksi P3K Gagal Ditambahkan",
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
        
        if($start_date!=null && $end_date != null){
            $sqlll = "SELECT * FROM inspeksi_p3k WHERE created_at > '$start_date' AND created_at < '$end_date'";

            if($kerusakan == "tidak") $sqlll .= " AND `kasa_steril_bungkus` = 'Ada' AND `perban5` = 'Ada' AND `perban10` = 'Ada' AND `plester125` = 'Ada' AND `plester_cepat` = 'Ada' AND `kapas` = 'Ada' AND `mitella` = 'Ada' AND `gunting` = 'Berfungsi' AND `peniti` = 'Ada' AND `sarung_tangan` = 'Ada' AND `masker` = 'Ada' AND `pinset` = 'Berfungsi' AND `lampu_senter` = 'Berfungsi' AND `gelas_cuci_mata` = 'Ada' AND `kantong_plastik` = 'Ada'  AND `aquades` = 'Ada' AND `oxygen` = 'Ada' AND `obat_luka_bakar` = 'Ada' AND `buku_catatan` = 'Ada' AND `daftar_isi` = 'Ada' ";
            if($kerusakan == "rusak") $sqlll .= " AND (`kasa_steril_bungkus` != 'Ada' OR `perban5` != 'Ada' OR `perban10` != 'Ada' OR `plester125` != 'Ada' OR `plester_cepat` != 'Ada' OR `kapas` != 'Ada' OR `mitella` != 'Ada' OR `gunting` != 'Berfungsi' OR `peniti` != 'Ada' OR `sarung_tangan` != 'Ada' OR `masker` != 'Ada' OR `pinset` != 'Berfungsi' OR `lampu_senter` != 'Berfungsi' OR `gelas_cuci_mata` != 'Ada' OR `kantong_plastik` != 'Ada'  OR `aquades` != 'Ada' OR `oxygen` != 'Ada' OR `obat_luka_bakar` != 'Ada' OR `buku_catatan` != 'Ada' OR `daftar_isi` != 'Ada')";


            $result = mysqli_query($conn, $sqlll);
        }
        else $result = mysqli_query($conn, "SELECT * FROM inspeksi_p3k");
        $arr = 0;
        if($result){
            http_response_code(200);
            if($inspeksi == 'belum'){
                $allApar = mysqli_query($conn, "SELECT * FROM p3k");
                while($data = mysqli_fetch_object($allApar)){
                    $data2 = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_p3k WHERE kotak_id = $data->id AND created_at > '$start_date' AND created_at < '$end_date'"));
                    if($data2 == null) $datas[$arr++] = $data;
                }
            }
            else{
                while($data = mysqli_fetch_object($result)){
                    $resultUser = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data->user_id"));
                    $resultP3K = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM p3k WHERE id = $data->kotak_id"));
                    $data->user = $resultUser;
                    $data->p3k = $resultP3K;
                    $datas[$arr++] = $data;

                }
            }
            echo json_encode([
                "status" => "success",
                "pesan" => "Read data inspeksi Success",
                "data" => $datas,

            ]);
        }
        else{
            echo json_encode([
                "SQL"=> $sqlll,
                "status" => "failed",
                "pesan" => "Read data inspeksi Failed",
            ]);
        }
    }
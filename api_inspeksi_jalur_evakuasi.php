<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);
    
    function checkUploadedFile($postName){
        $target_dir = "uploads/";
        if(isset($_FILES[$postName])){
            $target_file = $target_dir . basename($_FILES[$postName]["name"]);
            if (move_uploaded_file($_FILES[$postName]["tmp_name"], $target_file)) {
               return '/uploads/'.$_FILES[$postName]["name"];
            } else {
                return null;
            }
        }
    }

    if(isset($_GET['create']) || isset($_POST['create'])){
        $user_id;
        $lokasi;
        $durasi_inspeksi;
        
        $pintu_terkunci;
        $pintu_berfungsi;
        $ganjal;
        $ganjal_tangga;
        $kebersihan_tangga;
        $hambatan_eksit;
        $eksit_terkunci;
        $visibilitas_eksit;
        $pencahayaan_eksit;

        $pintu_terkunci_img;
        $pintu_berfungsi_img;
        $ganjal_img;
        $ganjal_tangga_img;
        $kebersihan_tangga_img;
        $hambatan_eksit_img;
        $eksit_terkunci_img;
        $visibilitas_eksit_img;
        $pencahayaan_eksit_img;
        
        if(isset($_GET['create'])){
            $user_id = $_GET['user_id'];
            $lokasi = $_GET['lokasi'];
            $pintu_terkunci = $_GET['pintu_terkunci'];
            $pintu_berfungsi = $_GET['pintu_berfungsi'];
            $ganjal = $_GET['ganjal'];
            $ganjal_tangga = $_GET['ganjal_tangga'];
            $kebersihan_tangga = $_GET['kebersihan_tangga'];
            $hambatan_eksit = $_GET['hambatan_eksit'];
            $eksit_terkunci = $_GET['eksit_terkunci'];
            $visibilitas_eksit = $_GET['visibilitas_eksit'];
            $pencahayaan_eksit = $_GET['pencahayaan_eksit'];
            $durasi_inspeksi = $_GET['durasi_inspeksi'];
        }
        if(isset($_POST['create'])){
            $user_id = $_POST['user_id'];
            $lokasi = $_POST['lokasi'];
            $pintu_terkunci = $_POST['pintu_terkunci'];
            $pintu_berfungsi = $_POST['pintu_berfungsi'];
            $ganjal = $_POST['ganjal'];
            $ganjal_tangga = $_POST['ganjal_tangga'];
            $kebersihan_tangga = $_POST['kebersihan_tangga'];
            $hambatan_eksit = $_POST['hambatan_eksit'];
            $eksit_terkunci = $_POST['eksit_terkunci'];
            $visibilitas_eksit = $_POST['visibilitas_eksit'];
            $pencahayaan_eksit = $_POST['pencahayaan_eksit'];
            $durasi_inspeksi = $_POST['durasi_inspeksi'];
        }
        
        if( $lokasi != 'Ya' || 
            $pintu_terkunci != 'Ya' || 
            $pintu_berfungsi != 'Ya' || 
            $ganjal != 'Ya' || 
            $ganjal_tangga != 'Ya' || 
            $kebersihan_tangga != 'Bersih' || 
            $hambatan_eksit != 'Ya' || 
            $eksit_terkunci != 'Ya' || 
            $visibilitas_eksit != 'Terlihat' || 
            $pencahayaan_eksit != 'Menyala'
        ){
            $users = mysqli_query($conn, "SELECT * FROM users where role = 1");
            while($userAdmin = mysqli_fetch_object($users)){
                mysqli_query($conn, "INSERT INTO `notification` (`id`, `user_id`, `title`, `content`, `displayed`, `timestamp`) VALUES (NULL, '$userAdmin->id', 'Jalur Evakuasi Abnormal Terinspeksi', 'Telah terdeteksi Jalur Evakuasi Abnormal', '0', current_timestamp());");
            }
        }

        $pintu_terkunci_img = checkUploadedFile('pintu_terkunci_img');
        $pintu_berfungsi_img = checkUploadedFile('pintu_berfungsi_img');
        $ganjal_img = checkUploadedFile('ganjal_img');
        $ganjal_tangga_img = checkUploadedFile('ganjal_tangga_img');
        $kebersihan_tangga_img = checkUploadedFile('kebersihan_tangga_img');
        $hambatan_eksit_img = checkUploadedFile('hambatan_eksit_img');
        $eksit_terkunci_img = checkUploadedFile('eksit_terkunci_img');
        $visibilitas_eksit_img = checkUploadedFile('visibilitas_eksit_img');
        $pencahayaan_eksit_img = checkUploadedFile('pencahayaan_eksit_img');

        $sql = "INSERT INTO `inspeksi_jalur_evakuasi` (`id`, `user_id`, `lokasi`, `pintu_terkunci`, `pintu_berfungsi`, `ganjal`, `ganjal_tangga`, `kebersihan_tangga`, `hambatan_eksit`, `eksit_terkunci`, `visibilitas_eksit`, `pencahayaan_eksit`, `durasi_inspeksi`, `created_at`";

        if($pintu_terkunci_img != null) $sql .= ", `pintu_terkunci_img`";
        if($pintu_berfungsi_img != null) $sql .= ", `pintu_berfungsi_img`";
        if($ganjal_img != null) $sql .= ", `ganjal_img`";
        if($ganjal_tangga_img != null) $sql .= ", `ganjal_tangga_img`";
        if($kebersihan_tangga_img != null) $sql .= ", `kebersihan_tangga_img`";
        if($hambatan_eksit_img != null) $sql .= ", `hambatan_eksit_img`";
        if($eksit_terkunci_img != null) $sql .= ", `eksit_terkunci_img`";
        if($visibilitas_eksit_img != null) $sql .= ", `visibilitas_eksit_img`";
        if($pencahayaan_eksit_img != null) $sql .= ", `pencahayaan_eksit_img`";

        $sql .= ") VALUES (NULL, $user_id, '$lokasi', '$pintu_terkunci', '$pintu_berfungsi', '$ganjal', '$ganjal_tangga', '$kebersihan_tangga', '$hambatan_eksit', '$eksit_terkunci', '$visibilitas_eksit', '$pencahayaan_eksit', '$durasi_inspeksi', current_timestamp()";

        if($pintu_terkunci_img != null) $sql .= ", '$pintu_terkunci_img'";
        if($pintu_berfungsi_img != null) $sql .= ", '$pintu_berfungsi_img'";
        if($ganjal_img != null) $sql .= ", '$ganjal_img'";
        if($ganjal_tangga_img != null) $sql .= ", '$ganjal_tangga_img'";
        if($kebersihan_tangga_img != null) $sql .= ", '$kebersihan_tangga_img'";
        if($hambatan_eksit_img != null) $sql .= ", '$hambatan_eksit_img'";
        if($eksit_terkunci_img != null) $sql .= ", '$eksit_terkunci_img'";
        if($visibilitas_eksit_img != null) $sql .= ", '$visibilitas_eksit_img'";
        if($pencahayaan_eksit_img != null) $sql .= ", '$pencahayaan_eksit_img'";

        $sql .= ");";

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

    if(isset($_GET['search']) || isset($_POST['search'])){
        $lokasi = null;
        if(isset($_GET['search'])){
            if(isset($_GET['lokasi'])) $lokasi = $_GET['lokasi'];
        }
        else if(isset($_POST['search'])){
            if(isset($_POST['lokasi'])) $lokasi = $_POST['lokasi'];
        }

        $data2 = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_jalur_evakuasi WHERE lokasi = '$lokasi' AND created_at > '".date("Y-m")."-01 00:00:00' AND created_at < '".date("Y-m")."-31 23:59:59'"));
        if($data2){
            $user = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data2->user_id"));
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "inspection" => false,
                "pesan" => "Search data Successed!",
                "lokasi" => $lokasi,
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
                "lokasi" => $lokasi,
                "data" => $data,
            ]);die;
        }
    }
    

    // if(isset($_GET['read']) || isset($_POST['read'])){
    //     $datas = [];
    //     $result = null;
    //     $start_date = null;
    //     $end_date = null;
    //     $inspeksi = null;
    //     $kerusakan = null;
    //     if(isset($_GET['read'])){
    //         if(isset($_GET['start_date'])) $start_date = $_GET['start_date'];
    //         if(isset($_GET['end_date'])) $end_date = $_GET['end_date'];
    //         if(isset($_GET['inspeksi'])) $inspeksi = $_GET['inspeksi'];
    //         if(isset($_GET['kerusakan'])) $kerusakan = $_GET['kerusakan'];
    //     }
    //     if($start_date!=null & $end_date != null){            
    //         $sqlll = "SELECT * FROM inspeksi_jalur_evakuasi WHERE created_at > '$start_date' AND created_at < '$end_date'";
            
    //         if($kerusakan == "tidak") $sqlll .= " AND `kebersihan` = 'Ya' AND `penanda_exit` = 'Ya' AND `kebebasan_hambatan` = 'Ya' AND `penerangan_jalur` = 'Ya' AND `tanda_arah` = 'Ya' AND `material_lantai` = 'Ya' AND `tanda_pintu_darurat` = 'Ya' AND `pegangan_rambat` = 'Ya' AND `pencahayaan_darurat` = 'Ya' AND `identifikasi_titik_kumpul` = 'Ya' AND `jalur_menuju_titik_kumpul` = 'Ya' AND `peralatan_darurat` = 'Ya' AND `peta_evakuasi` = 'Ya' AND `pintu_dikunci` = 'Ya' AND `pintu_berfungsi` = 'Ya' AND `terdapat_ganjal` = 'Ya' AND `terbebas_halangan` = 'Ya' AND `terbebas_hambatan` = 'Ya' AND `pintu_pelepasan_terkunci` = 'Ya'";
    //         if($kerusakan == "rusak") $sqlll .= " AND (`kebersihan` != 'Ya' OR `penanda_exit` != 'Ya' OR `kebebasan_hambatan` != 'Ya' OR `penerangan_jalur` != 'Ya' OR `tanda_arah` != 'Ya' OR `material_lantai` != 'Ya' OR `tanda_pintu_darurat` != 'Ya' OR `pegangan_rambat` != 'Ya' OR `pencahayaan_darurat` != 'Ya' OR `identifikasi_titik_kumpul` != 'Ya' OR `jalur_menuju_titik_kumpul` != 'Ya' OR `peralatan_darurat` != 'Ya' OR `peta_evakuasi` != 'Ya' OR `pintu_dikunci` != 'Ya' OR `pintu_berfungsi` != 'Ya' OR `terdapat_ganjal` != 'Ya' OR `terbebas_halangan` != 'Ya' OR `terbebas_hambatan` != 'Ya' OR `pintu_pelepasan_terkunci` != 'Ya')";

    //         $result = mysqli_query($conn,$sqlll);
    //     }
    //     else $result = mysqli_query($conn, "SELECT * FROM inspeksi_jalur_evakuasi");
    //     $arr = 0;
    //     if($result){
    //         http_response_code(200);
    //             while($data = mysqli_fetch_object($result)){
    //             $resultUser = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data->user_id"));
    //             $data->user = $resultUser;
    //             $datas[$arr++] = $data;
    //         }
    //         echo json_encode([
    //             "status" => "success",
    //             "pesan" => "Read data inspeksi Success",
    //             "data" => $datas,

    //         ]);
    //     }
    //     else{
    //         echo json_encode([
    //             "status" => "failed",
    //             "pesan" => "Read data inspeksi Failed",
    //         ]);
    //     }
    // }

    if(isset($_GET['read']) || isset($_POST['read'])){
        $datas = [];
        $result = null;
        $start_date = null;
        $end_date = null;
        $kerusakan = null;

        if(isset($_GET['read'])){
            if(isset($_GET['start_date'])) $start_date = $_GET['start_date'];
            if(isset($_GET['end_date'])) $end_date = $_GET['end_date'];
            if(isset($_GET['kerusakan'])) $kerusakan = $_GET['kerusakan'];
        }
        
        if($start_date!=null & $end_date != null){            
            $sqlll = "SELECT * FROM inspeksi_jalur_evakuasi WHERE created_at > '$start_date' AND created_at < '$end_date'";
            
            if($kerusakan == "tidak") $sqlll .= " AND `pintu_terkunci` = 'Ya' AND `pintu_berfungsi` = 'Ya' AND `ganjal` = 'Ya' AND `ganjal_tangga` = 'Ya' AND `kebersihan_tangga` = 'Bersih' AND `hambatan_eksit` = 'Ya' AND `eksit_terkunci` = 'Ya' AND `visibilitas_eksit` = 'Terlihat' AND `pencahayaan_eksit` = 'Menyala'";
            if($kerusakan == "rusak") $sqlll .= " AND (`pintu_terkunci` != 'Ya' OR `pintu_berfungsi` != 'Ya' OR `ganjal` != 'Ya' OR `ganjal_tangga` != 'Ya' OR `kebersihan_tangga` != 'Bersih' OR `hambatan_eksit` != 'Ya' OR `eksit_terkunci` != 'Ya' OR `visibilitas_eksit` != 'Terlihat' OR `pencahayaan_eksit` != 'Menyala')";

            $result = mysqli_query($conn,$sqlll);
        }
        else $result = mysqli_query($conn, "SELECT * FROM inspeksi_jalur_evakuasi");
        // var_dump($result);die;   
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
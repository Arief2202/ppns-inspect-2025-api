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

        $kondisi;
        $ventilasi;
        $katup_hisap;
        $perpipaan;
        $pengukur_hisap;
        $pengukur_sistem;
        $tangki_hisap;
        $saringan_hisap;
        $katup_uji;
        $lampu_pengontrol;
        $lampu_saklar;
        $saklar_isolasi;
        $lampu_rotasi;
        $level_oli_motor;
        $pompa_pemeliharaan;
        $tangki_bahan_bakar;
        $saklar_pemilih;
        $pembacaan_tegangan;
        $pembacaan_arus;
        $lampu_baterai;
        $semua_lampu_alarm;
        $pengukur_waktu;
        $ketinggian_oli;
        $level_oli_mesin;
        $ketinggian_air;
        $tingkat_elektrolit;
        $terminal_baterai;
        $pemanas_jaket;
        $kondisi_uap;

        $lokasi_img;
        $kondisi_img;
        $ventilasi_img;
        $katup_hisap_img;
        $perpipaan_img;
        $pengukur_hisap_img;
        $pengukur_sistem_img;
        $tangki_hisap_img;
        $saringan_hisap_img;
        $katup_uji_img;
        $lampu_pengontrol_img;
        $lampu_saklar_img;
        $saklar_isolasi_img;
        $lampu_rotasi_img;
        $level_oli_motor_img;
        $pompa_pemeliharaan_img;
        $tangki_bahan_bakar_img;
        $saklar_pemilih_img;
        $pembacaan_tegangan_img;
        $pembacaan_arus_img;
        $lampu_baterai_img;
        $semua_lampu_alarm_img;
        $pengukur_waktu_img;
        $ketinggian_oli_img;
        $level_oli_mesin_img;
        $ketinggian_air_img;
        $tingkat_elektrolit_img;
        $terminal_baterai_img;
        $pemanas_jaket_img;
        $kondisi_uap_img;

        if(isset($_GET['create'])){
            $user_id = $_GET['user_id'];
            $lokasi = $_GET['lokasi'];
            $kondisi = $_GET['kondisi'];
            $ventilasi = $_GET['ventilasi'];
            $katup_hisap = $_GET['katup_hisap'];
            $perpipaan = $_GET['perpipaan'];
            $pengukur_hisap = $_GET['pengukur_hisap'];
            $pengukur_sistem = $_GET['pengukur_sistem'];
            $tangki_hisap = $_GET['tangki_hisap'];
            $saringan_hisap = $_GET['saringan_hisap'];
            $katup_uji = $_GET['katup_uji'];
            $lampu_pengontrol = $_GET['lampu_pengontrol'];
            $lampu_saklar = $_GET['lampu_saklar'];
            $saklar_isolasi = $_GET['saklar_isolasi'];
            $lampu_rotasi = $_GET['lampu_rotasi'];
            $level_oli_motor = $_GET['level_oli_motor'];
            $pompa_pemeliharaan = $_GET['pompa_pemeliharaan'];
            $tangki_bahan_bakar = $_GET['tangki_bahan_bakar'];
            $saklar_pemilih = $_GET['saklar_pemilih'];
            $pembacaan_tegangan = $_GET['pembacaan_tegangan'];
            $pembacaan_arus = $_GET['pembacaan_arus'];
            $lampu_baterai = $_GET['lampu_baterai'];
            $semua_lampu_alarm = $_GET['semua_lampu_alarm'];
            $pengukur_waktu = $_GET['pengukur_waktu'];
            $ketinggian_oli = $_GET['ketinggian_oli'];
            $level_oli_mesin = $_GET['level_oli_mesin'];
            $ketinggian_air = $_GET['ketinggian_air'];
            $tingkat_elektrolit = $_GET['tingkat_elektrolit'];
            $terminal_baterai = $_GET['terminal_baterai'];
            $pemanas_jaket = $_GET['pemanas_jaket'];
            $kondisi_uap = $_GET['kondisi_uap'];
            $durasi_inspeksi = $_GET['durasi_inspeksi'];
        }
        if(isset($_POST['create'])){
            $user_id = $_POST['user_id'];
            $lokasi = $_POST['lokasi'];
            $kondisi = $_POST['kondisi'];
            $ventilasi = $_POST['ventilasi'];
            $katup_hisap = $_POST['katup_hisap'];
            $perpipaan = $_POST['perpipaan'];
            $pengukur_hisap = $_POST['pengukur_hisap'];
            $pengukur_sistem = $_POST['pengukur_sistem'];
            $tangki_hisap = $_POST['tangki_hisap'];
            $saringan_hisap = $_POST['saringan_hisap'];
            $katup_uji = $_POST['katup_uji'];
            $lampu_pengontrol = $_POST['lampu_pengontrol'];
            $lampu_saklar = $_POST['lampu_saklar'];
            $saklar_isolasi = $_POST['saklar_isolasi'];
            $lampu_rotasi = $_POST['lampu_rotasi'];
            $level_oli_motor = $_POST['level_oli_motor'];
            $pompa_pemeliharaan = $_POST['pompa_pemeliharaan'];
            $tangki_bahan_bakar = $_POST['tangki_bahan_bakar'];
            $saklar_pemilih = $_POST['saklar_pemilih'];
            $pembacaan_tegangan = $_POST['pembacaan_tegangan'];
            $pembacaan_arus = $_POST['pembacaan_arus'];
            $lampu_baterai = $_POST['lampu_baterai'];
            $semua_lampu_alarm = $_POST['semua_lampu_alarm'];
            $pengukur_waktu = $_POST['pengukur_waktu'];
            $ketinggian_oli = $_POST['ketinggian_oli'];
            $level_oli_mesin = $_POST['level_oli_mesin'];
            $ketinggian_air = $_POST['ketinggian_air'];
            $tingkat_elektrolit = $_POST['tingkat_elektrolit'];
            $terminal_baterai = $_POST['terminal_baterai'];
            $pemanas_jaket = $_POST['pemanas_jaket'];
            $kondisi_uap = $_POST['kondisi_uap'];
            $durasi_inspeksi = $_POST['durasi_inspeksi'];
        }
        
        if( $kondisi != 'Aman' || 
            $ventilasi != 'Aman' || 
            $katup_hisap != 'Aman' || 
            $perpipaan != 'Aman' || 
            $pengukur_hisap != 'Aman' || 
            $pengukur_sistem != 'Aman' || 
            $tangki_hisap != 'Aman' || 
            $saringan_hisap != 'Aman' || 
            $katup_uji != 'Aman' || 
            $lampu_pengontrol != 'Aman' || 
            $lampu_saklar != 'Aman' || 
            $saklar_isolasi != 'Aman' || 
            $lampu_rotasi != 'Aman' || 
            $level_oli_motor != 'Aman' || 
            $pompa_pemeliharaan != 'Aman' || 
            $tangki_bahan_bakar != 'Aman' || 
            $saklar_pemilih != 'Aman' || 
            $pembacaan_tegangan != 'Aman' || 
            $pembacaan_arus != 'Aman' || 
            $lampu_baterai != 'Aman' || 
            $semua_lampu_alarm != 'Aman' || 
            $pengukur_waktu != 'Aman' || 
            $ketinggian_oli != 'Aman' || 
            $level_oli_mesin != 'Aman' || 
            $ketinggian_air != 'Aman' || 
            $tingkat_elektrolit != 'Aman' || 
            $terminal_baterai != 'Aman' || 
            $pemanas_jaket != 'Aman' || 
            $kondisi_uap != 'Aman'
        ){
            $users = mysqli_query($conn, "SELECT * FROM users where role = 1");
            while($userAdmin = mysqli_fetch_object($users)){
                mysqli_query($conn, "INSERT INTO `notification` (`id`, `user_id`, `title`, `content`, `displayed`, `timestamp`) VALUES (NULL, '$userAdmin->id', 'Rumah Pompa Hydrant Rusak Terinspeksi', 'Telah terdeteksi Rumah Pompa Rusak', '0', current_timestamp());");
            }
        }

        $lokasi_img = checkUploadedFile('lokasi_img');
        $kondisi_img = checkUploadedFile('kondisi_img');
        $ventilasi_img = checkUploadedFile('ventilasi_img');
        $katup_hisap_img = checkUploadedFile('katup_hisap_img');
        $perpipaan_img = checkUploadedFile('perpipaan_img');
        $pengukur_hisap_img = checkUploadedFile('pengukur_hisap_img');
        $pengukur_sistem_img = checkUploadedFile('pengukur_sistem_img');
        $tangki_hisap_img = checkUploadedFile('tangki_hisap_img');
        $saringan_hisap_img = checkUploadedFile('saringan_hisap_img');
        $katup_uji_img = checkUploadedFile('katup_uji_img');
        $lampu_pengontrol_img = checkUploadedFile('lampu_pengontrol_img');
        $lampu_saklar_img = checkUploadedFile('lampu_saklar_img');
        $saklar_isolasi_img = checkUploadedFile('saklar_isolasi_img');
        $lampu_rotasi_img = checkUploadedFile('lampu_rotasi_img');
        $level_oli_motor_img = checkUploadedFile('level_oli_motor_img');
        $pompa_pemeliharaan_img = checkUploadedFile('pompa_pemeliharaan_img');
        $tangki_bahan_bakar_img = checkUploadedFile('tangki_bahan_bakar_img');
        $saklar_pemilih_img = checkUploadedFile('saklar_pemilih_img');
        $pembacaan_tegangan_img = checkUploadedFile('pembacaan_tegangan_img');
        $pembacaan_arus_img = checkUploadedFile('pembacaan_arus_img');
        $lampu_baterai_img = checkUploadedFile('lampu_baterai_img');
        $semua_lampu_alarm_img = checkUploadedFile('semua_lampu_alarm_img');
        $pengukur_waktu_img = checkUploadedFile('pengukur_waktu_img');
        $ketinggian_oli_img = checkUploadedFile('ketinggian_oli_img');
        $level_oli_mesin_img = checkUploadedFile('level_oli_mesin_img');
        $ketinggian_air_img = checkUploadedFile('ketinggian_air_img');
        $tingkat_elektrolit_img = checkUploadedFile('tingkat_elektrolit_img');
        $terminal_baterai_img = checkUploadedFile('terminal_baterai_img');
        $pemanas_jaket_img = checkUploadedFile('pemanas_jaket_img');
        $kondisi_uap_img = checkUploadedFile('kondisi_uap_img');

        $sql = "INSERT INTO `inspeksi_rumah_pompa` (`id`, `user_id`, `lokasi`, `kondisi`, `ventilasi`, `katup_hisap`, `perpipaan`, `pengukur_hisap`, `pengukur_sistem`, `tangki_hisap`, `saringan_hisap`, `katup_uji`, `lampu_pengontrol`, `lampu_saklar`, `saklar_isolasi`, `lampu_rotasi`, `level_oli_motor`, `pompa_pemeliharaan`, `tangki_bahan_bakar`, `saklar_pemilih`, `pembacaan_tegangan`, `pembacaan_arus`, `lampu_baterai`, `semua_lampu_alarm`, `pengukur_waktu`, `ketinggian_oli`, `level_oli_mesin`, `ketinggian_air`, `tingkat_elektrolit`, `terminal_baterai`, `pemanas_jaket`, `kondisi_uap`, `durasi_inspeksi`, `timestamp`";

        if($lokasi_img != null) $sql .= ", `lokasi_img`";
        if($kondisi_img != null) $sql .= ", `kondisi_img`";
        if($ventilasi_img != null) $sql .= ", `ventilasi_img`";
        if($katup_hisap_img != null) $sql .= ", `katup_hisap_img`";
        if($perpipaan_img != null) $sql .= ", `perpipaan_img`";
        if($pengukur_hisap_img != null) $sql .= ", `pengukur_hisap_img`";
        if($pengukur_sistem_img != null) $sql .= ", `pengukur_sistem_img`";
        if($tangki_hisap_img != null) $sql .= ", `tangki_hisap_img`";
        if($saringan_hisap_img != null) $sql .= ", `saringan_hisap_img`";
        if($katup_uji_img != null) $sql .= ", `katup_uji_img`";
        if($lampu_pengontrol_img != null) $sql .= ", `lampu_pengontrol_img`";
        if($lampu_saklar_img != null) $sql .= ", `lampu_saklar_img`";
        if($saklar_isolasi_img != null) $sql .= ", `saklar_isolasi_img`";
        if($lampu_rotasi_img != null) $sql .= ", `lampu_rotasi_img`";
        if($level_oli_motor_img != null) $sql .= ", `level_oli_motor_img`";
        if($pompa_pemeliharaan_img != null) $sql .= ", `pompa_pemeliharaan_img`";
        if($tangki_bahan_bakar_img != null) $sql .= ", `tangki_bahan_bakar_img`";
        if($saklar_pemilih_img != null) $sql .= ", `saklar_pemilih_img`";
        if($pembacaan_tegangan_img != null) $sql .= ", `pembacaan_tegangan_img`";
        if($pembacaan_arus_img != null) $sql .= ", `pembacaan_arus_img`";
        if($lampu_baterai_img != null) $sql .= ", `lampu_baterai_img`";
        if($semua_lampu_alarm_img != null) $sql .= ", `semua_lampu_alarm_img`";
        if($pengukur_waktu_img != null) $sql .= ", `pengukur_waktu_img`";
        if($ketinggian_oli_img != null) $sql .= ", `ketinggian_oli_img`";
        if($level_oli_mesin_img != null) $sql .= ", `level_oli_mesin_img`";
        if($ketinggian_air_img != null) $sql .= ", `ketinggian_air_img`";
        if($tingkat_elektrolit_img != null) $sql .= ", `tingkat_elektrolit_img`";
        if($terminal_baterai_img != null) $sql .= ", `terminal_baterai_img`";
        if($pemanas_jaket_img != null) $sql .= ", `pemanas_jaket_img`";
        if($kondisi_uap_img != null) $sql .= ", `kondisi_uap_img`";

        $sql .= ") VALUES (NULL, $user_id, '$lokasi', '$kondisi', '$ventilasi', '$katup_hisap', '$perpipaan', '$pengukur_hisap', '$pengukur_sistem', '$tangki_hisap', '$saringan_hisap', '$katup_uji', '$lampu_pengontrol', '$lampu_saklar', '$saklar_isolasi', '$lampu_rotasi', '$level_oli_motor', '$pompa_pemeliharaan', '$tangki_bahan_bakar', '$saklar_pemilih', '$pembacaan_tegangan', '$pembacaan_arus', '$lampu_baterai', '$semua_lampu_alarm', '$pengukur_waktu', '$ketinggian_oli', '$level_oli_mesin', '$ketinggian_air', '$tingkat_elektrolit', '$terminal_baterai', '$pemanas_jaket', '$kondisi_uap', '$durasi_inspeksi', current_timestamp()";

        if($lokasi_img != null) $sql .= ", '$lokasi_img'";
        if($kondisi_img != null) $sql .= ", '$kondisi_img'";
        if($ventilasi_img != null) $sql .= ", '$ventilasi_img'";
        if($katup_hisap_img != null) $sql .= ", '$katup_hisap_img'";
        if($perpipaan_img != null) $sql .= ", '$perpipaan_img'";
        if($pengukur_hisap_img != null) $sql .= ", '$pengukur_hisap_img'";
        if($pengukur_sistem_img != null) $sql .= ", '$pengukur_sistem_img'";
        if($tangki_hisap_img != null) $sql .= ", '$tangki_hisap_img'";
        if($saringan_hisap_img != null) $sql .= ", '$saringan_hisap_img'";
        if($katup_uji_img != null) $sql .= ", '$katup_uji_img'";
        if($lampu_pengontrol_img != null) $sql .= ", '$lampu_pengontrol_img'";
        if($lampu_saklar_img != null) $sql .= ", '$lampu_saklar_img'";
        if($saklar_isolasi_img != null) $sql .= ", '$saklar_isolasi_img'";
        if($lampu_rotasi_img != null) $sql .= ", '$lampu_rotasi_img'";
        if($level_oli_motor_img != null) $sql .= ", '$level_oli_motor_img'";
        if($pompa_pemeliharaan_img != null) $sql .= ", '$pompa_pemeliharaan_img'";
        if($tangki_bahan_bakar_img != null) $sql .= ", '$tangki_bahan_bakar_img'";
        if($saklar_pemilih_img != null) $sql .= ", '$saklar_pemilih_img'";
        if($pembacaan_tegangan_img != null) $sql .= ", '$pembacaan_tegangan_img'";
        if($pembacaan_arus_img != null) $sql .= ", '$pembacaan_arus_img'";
        if($lampu_baterai_img != null) $sql .= ", '$lampu_baterai_img'";
        if($semua_lampu_alarm_img != null) $sql .= ", '$semua_lampu_alarm_img'";
        if($pengukur_waktu_img != null) $sql .= ", '$pengukur_waktu_img'";
        if($ketinggian_oli_img != null) $sql .= ", '$ketinggian_oli_img'";
        if($level_oli_mesin_img != null) $sql .= ", '$level_oli_mesin_img'";
        if($ketinggian_air_img != null) $sql .= ", '$ketinggian_air_img'";
        if($tingkat_elektrolit_img != null) $sql .= ", '$tingkat_elektrolit_img'";
        if($terminal_baterai_img != null) $sql .= ", '$terminal_baterai_img'";
        if($pemanas_jaket_img != null) $sql .= ", '$pemanas_jaket_img'";
        if($kondisi_uap_img != null) $sql .= ", '$kondisi_uap_img'";

        $sql .= ");";

        // echo $sql; die;
        $result = mysqli_query($conn, $sql);
        if($result){
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "pesan" => "Data Inspeksi Rumah Pompa Berhasil Ditambahkan",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data Inspeksi Rumah Pompa Gagal Ditambahkan",
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
            $sqlll = "SELECT * FROM inspeksi_rumah_pompa WHERE timestamp > '$start_date' AND timestamp < '$end_date'";
            
            if($kerusakan == "tidak") $sqlll .= " AND `kondisi` = 'Aman' AND `ventilasi` = 'Aman' AND `katup_hisap` = 'Aman' AND `perpipaan` = 'Aman' AND `pengukur_hisap` = 'Aman' AND `pengukur_sistem` = 'Aman' AND `tangki_hisap` = 'Aman' AND `saringan_hisap` = 'Aman' AND `katup_uji` = 'Aman' AND `lampu_pengontrol` = 'Aman' AND `lampu_saklar` = 'Aman' AND `saklar_isolasi` = 'Aman' AND `lampu_rotasi` = 'Aman' AND `level_oli_motor` = 'Aman' AND `pompa_pemeliharaan` = 'Aman' AND `tangki_bahan_bakar` = 'Aman' AND `saklar_pemilih` = 'Aman' AND `pembacaan_tegangan` = 'Aman' AND `pembacaan_arus` = 'Aman' AND `lampu_baterai` = 'Aman' AND `semua_lampu_alarm` = 'Aman' AND `pengukur_waktu` = 'Aman' AND `ketinggian_oli` = 'Aman' AND `level_oli_mesin` = 'Aman' AND `ketinggian_air` = 'Aman' AND `tingkat_elektrolit` = 'Aman' AND `terminal_baterai` = 'Aman' AND `pemanas_jaket` = 'Aman' AND `kondisi_uap` = 'Aman'";
            if($kerusakan == "rusak") $sqlll .= " AND (`kondisi` != 'Aman' OR `ventilasi` != 'Aman' OR `katup_hisap` != 'Aman' OR `perpipaan` != 'Aman' OR `pengukur_hisap` != 'Aman' OR `pengukur_sistem` != 'Aman' OR `tangki_hisap` != 'Aman' OR `saringan_hisap` != 'Aman' OR `katup_uji` != 'Aman' OR `lampu_pengontrol` != 'Aman' OR `lampu_saklar` != 'Aman' OR `saklar_isolasi` != 'Aman' OR `lampu_rotasi` != 'Aman' OR `level_oli_motor` != 'Aman' OR `pompa_pemeliharaan` != 'Aman' OR `tangki_bahan_bakar` != 'Aman' OR `saklar_pemilih` != 'Aman' OR `pembacaan_tegangan` != 'Aman' OR `pembacaan_arus` != 'Aman' OR `lampu_baterai` != 'Aman' OR `semua_lampu_alarm` != 'Aman' OR `pengukur_waktu` != 'Aman' OR `ketinggian_oli` != 'Aman' OR `level_oli_mesin` != 'Aman' OR `ketinggian_air` != 'Aman' OR `tingkat_elektrolit` != 'Aman' OR `terminal_baterai` != 'Aman' OR `pemanas_jaket` != 'Aman' OR `kondisi_uap` != 'Aman' OR )";

            $result = mysqli_query($conn,$sqlll);
        }
        else $result = mysqli_query($conn, "SELECT * FROM inspeksi_rumah_pompa");
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
        $data2 = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_rumah_pompa WHERE timestamp > '".date("Y-m")."-01 00:00:00' AND timestamp < '".date("Y-m")."-31 23:59:59'"));
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
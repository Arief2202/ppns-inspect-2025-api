<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['create']) || isset($_POST['create'])){
        $user_id;
        $hydrant_id;
        $kondisi_kotak;
        $posisi_kotak;
        $kondisi_nozzle;
        $kondisi_selang;
        $jenis_selang;
        $kondisi_coupling;
        $kondisi_landing_valve;
        $kondisi_tray;

        if(isset($_GET['create'])){
            $user_id = $_GET['user_id'];
            $hydrant_id = $_GET['hydrant_id'];
            $kondisi_kotak = $_GET['kondisi_kotak'];
            $posisi_kotak = $_GET['posisi_kotak'];
            $kondisi_nozzle = $_GET['kondisi_nozzle'];
            $kondisi_selang = $_GET['kondisi_selang'];
            $jenis_selang = $_GET['jenis_selang'];
            $kondisi_coupling = $_GET['kondisi_coupling'];
            $kondisi_landing_valve = $_GET['kondisi_landing_valve'];
            $kondisi_tray = $_GET['kondisi_tray'];
        }
        else if(isset($_POST['create'])){
            $user_id = $_POST['user_id'];
            $hydrant_id = $_POST['hydrant_id'];
            $kondisi_kotak = $_POST['kondisi_kotak'];
            $posisi_kotak = $_POST['posisi_kotak'];
            $kondisi_nozzle = $_POST['kondisi_nozzle'];
            $kondisi_selang = $_POST['kondisi_selang'];
            $jenis_selang = $_POST['jenis_selang'];
            $kondisi_coupling = $_POST['kondisi_coupling'];
            $kondisi_landing_valve = $_POST['kondisi_landing_valve'];
            $kondisi_tray = $_POST['kondisi_tray'];
        }
        
        if( $kondisi_kotak != 'Bersih' || 
            $posisi_kotak != 'Tidak Terhalang' || 
            $kondisi_nozzle != 'Baik' || 
            $kondisi_selang != 'Baik' || 
            $kondisi_coupling != 'Baik' || 
            $kondisi_landing_valve != 'Baik' ||
            $kondisi_tray != 'Baik'
        ){
            $users = mysqli_query($conn, "SELECT * FROM users where role = 1");
            while($userAdmin = mysqli_fetch_object($users)){
                $hydrant = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM hydrant WHERE id = $hydrant_id"));
                mysqli_query($conn, "INSERT INTO `notification` (`id`, `user_id`, `title`, `content`, `displayed`, `timestamp`) VALUES (NULL, '$userAdmin->id', 'Hydrant IHB Rusak Terinspeksi', 'Telah terdeteksi Hydrant IHB rusak dengan Nomor : $hydrant->nomor', '0', current_timestamp());");
            }
        }

        $sql = "INSERT INTO `inspeksi_hydrant_ihb` (`id`, `user_id`, `hydrant_id`, `kondisi_kotak`, `posisi_kotak`, `kondisi_nozzle`, `kondisi_selang`, `jenis_selang`, `kondisi_coupling`, `kondisi_landing_valve`, `kondisi_tray`, `created_at`) VALUES (NULL, '$user_id', '$hydrant_id', '$kondisi_kotak', '$posisi_kotak', '$kondisi_nozzle', '$kondisi_selang', '$jenis_selang', '$kondisi_coupling', '$kondisi_landing_valve', '$kondisi_tray', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            http_response_code(200);
            // $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_apar WHERE nomor = '".$nomor."'"));
            echo json_encode([
                "status" => "success",
                // "data" => $data,
                "pesan" => "Data Inspeksi Hydrant IHB Berhasil Ditambahkan",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data Inspeksi Hydrant IHB Gagal Ditambahkan",
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
            $sqlll = "SELECT * FROM inspeksi_hydrant_ihb WHERE created_at > '$start_date' AND created_at < '$end_date'";
            
            if($kerusakan == "tidak") $sqlll .= " AND `kondisi_kotak` = 'Bersih' AND `posisi_kotak` = 'Tidak Terhalang' AND `kondisi_nozzle` = 'Baik' AND `kondisi_selang` = 'Baik' AND `kondisi_coupling` = 'Baik' AND `kondisi_landing_valve` = 'Baik' AND `kondisi_tray` = 'Baik'";
            if($kerusakan == "rusak") $sqlll .= " AND (`kondisi_kotak` != 'Bersih' OR `posisi_kotak` != 'Tidak Terhalang' OR `kondisi_nozzle` != 'Baik' OR `kondisi_selang` != 'Baik' OR `kondisi_coupling` != 'Baik' OR `kondisi_landing_valve` != 'Baik' OR `kondisi_tray` != 'Baik')";

            $result = mysqli_query($conn,$sqlll);
        }
        else $result = mysqli_query($conn, "SELECT * FROM inspeksi_hydrant_ihb");
        $arr = 0;
        if($result){
            http_response_code(200);
            if($inspeksi == 'belum'){
                $allHydrant = mysqli_query($conn, "SELECT * FROM hydrant WHERE jenis_hydrant = 'ihb'");
                while($data = mysqli_fetch_object($allHydrant)){
                    $data2 = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_hydrant_ihb WHERE hydrant_id = $data->id AND created_at > '$start_date' AND created_at < '$end_date'"));
                    if($data2 == null) $datas[$arr++] = $data;
                }
            }
            else{
                while($data = mysqli_fetch_object($result)){
                        $resultUser = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data->user_id"));
                        $resultApar = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM hydrant WHERE id = $data->hydrant_id"));
                        $data->user = $resultUser;
                        $data->hydrant = $resultApar;
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
                "status" => "failed",
                "pesan" => "Read data inspeksi Failed",
            ]);
        }
    }
<?php
    include "koneksi.php";
    date_default_timezone_set("Asia/Jakarta");
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['create']) || isset($_POST['create'])){
        $user_id = null;
        $apar_id = null;
        $tersedia = null;
        $alasan = null;
        $kondisi_tabung = null;
        $segel_pin = null;
        $tuas_pegangan = null;
        $label_segitiga = null;
        $label_instruksi = null;
        $kondisi_selang = null;
        $tekanan_tabung = null;
        $posisi = null;

        if(isset($_GET['create'])){
            $user_id = $_GET['user_id'];
            $apar_id = $_GET['apar_id'];
            $tersedia = $_GET['tersedia'];
            $alasan = $_GET['alasan'];
            $kondisi_tabung = $_GET['kondisi_tabung'];
            $segel_pin = $_GET['segel_pin'];
            $tuas_pegangan = $_GET['tuas_pegangan'];
            $label_segitiga = $_GET['label_segitiga'];
            $label_instruksi = $_GET['label_instruksi'];
            $kondisi_selang = $_GET['kondisi_selang'];
            $tekanan_tabung = $_GET['tekanan_tabung'];
            $posisi = $_GET['posisi'];
        }
        else if(isset($_POST['create'])){
            $user_id = $_POST['user_id'];
            $apar_id = $_POST['apar_id'];
            $tersedia = $_POST['tersedia'];
            $alasan = $_POST['alasan'];
            $kondisi_tabung = $_POST['kondisi_tabung'];
            $segel_pin = $_POST['segel_pin'];
            $tuas_pegangan = $_POST['tuas_pegangan'];
            $label_segitiga = $_POST['label_segitiga'];
            $label_instruksi = $_POST['label_instruksi'];
            $kondisi_selang = $_POST['kondisi_selang'];
            $tekanan_tabung = $_POST['tekanan_tabung'];
            $posisi = $_POST['posisi'];
        }
        
        if( $tersedia != 'Tersedia' || 
            $kondisi_tabung != 'Baik' || 
            $segel_pin != 'Terpasang' || 
            $tuas_pegangan != 'Baik' || 
            $label_segitiga != 'Tersedia' || 
            $label_instruksi != 'Terbaca' || 
            $kondisi_selang != 'Baik' || 
            $tekanan_tabung != 'Tepat di hijau' || 
            $posisi != 'Terlihat'
        ){
            $users = mysqli_query($conn, "SELECT * FROM users where role = 1");
            while($userAdmin = mysqli_fetch_object($users)){
                $apar = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM apar WHERE id = $apar_id"));
                mysqli_query($conn, "INSERT INTO `notification` (`id`, `user_id`, `title`, `content`, `displayed`, `timestamp`) VALUES (NULL, '$userAdmin->id', 'APAR Rusak Terinspeksi', 'Telah terdeteksi APAR rusak dengan Nomor : $apar->nomor', '0', current_timestamp());");
            }
        }

        $sql = "INSERT INTO `inspeksi_apar` (`id`, `user_id`, `apar_id`, `tersedia`, `alasan`, `kondisi_tabung`, `segel_pin`, `tuas_pegangan`, `label_segitiga`, `label_instruksi`, `kondisi_selang`, `tekanan_tabung`, `posisi`, `created_at`) VALUES (NULL, '$user_id', '$apar_id', '$tersedia', '$alasan', '$kondisi_tabung', '$segel_pin', '$tuas_pegangan', '$label_segitiga', '$label_instruksi', '$kondisi_selang', '$tekanan_tabung', '$posisi', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            http_response_code(200);
            // $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_apar WHERE nomor = '".$nomor."'"));
            echo json_encode([
                "status" => "success",
                // "data" => $data,
                "pesan" => "Data Inspeksi Apar Berhasil Ditambahkan",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data Inspeksi Apar Gagal Ditambahkan",
            ]);
        }
    }
    
    if(isset($_GET['read']) || isset($_POST['read'])){
        $datas = [];
        $result = null;
        $start_date = null;
        $end_date = null;
        $inspeksi = null;
        $kadaluarsa = null;
        $kerusakan = null;
        if(isset($_GET['read'])){
            if(isset($_GET['start_date'])) $start_date = $_GET['start_date'];
            if(isset($_GET['end_date'])) $end_date = $_GET['end_date'];
            if(isset($_GET['inspeksi'])) $inspeksi = $_GET['inspeksi'];
            if(isset($_GET['kadaluarsa'])) $kadaluarsa = $_GET['kadaluarsa'];
            if(isset($_GET['kerusakan'])) $kerusakan = $_GET['kerusakan'];
        }
        //SELECT * FROM `inspeksi_apar` WHERE `kondisi_tabung` LIKE 'Baik' AND `tuas_pegangan` LIKE 'Baik'
        //SELECT * FROM `apar` WHERE `tanggal_kadaluarsa` < '2024-05-16 00:00:00'
        if($start_date!=null & $end_date != null){
            $sqlll = "SELECT * FROM inspeksi_apar WHERE created_at > '$start_date' AND created_at < '$end_date'";
            // if($kadaluarsa == "belum") $sqlll .= " AND `tanggal_kadaluarsa` < '".date("Y-m-d h:i:s")."'";
            // if($kadaluarsa == "sudah") $sqlll .= " AND `tanggal_kadaluarsa` < '".date("Y-m-d h:i:s")."'";

            if($kerusakan == "tidak") $sqlll .= " AND `tersedia` = 'Tersedia' AND `kondisi_tabung` = 'Baik' AND `segel_pin` = 'Terpasang' AND `tuas_pegangan` = 'Baik' AND `label_segitiga` = 'Tersedia' AND `label_instruksi` = 'Terbaca' AND `kondisi_selang` = 'Baik' AND `tekanan_tabung` = 'Tepat di hijau' AND `posisi` = 'Terlihat'";
            if($kerusakan == "rusak") $sqlll .= " AND (`tersedia` != 'Tersedia' OR `kondisi_tabung` != 'Baik' OR `segel_pin` != 'Terpasang' OR `tuas_pegangan` != 'Baik' OR `label_segitiga` != 'Tersedia' OR `label_instruksi` != 'Terbaca' OR `kondisi_selang` != 'Baik' OR `tekanan_tabung` != 'Tepat di hijau' OR `posisi` != 'Terlihat')";


            $result = mysqli_query($conn, $sqlll);
        }
        else $result = mysqli_query($conn, "SELECT * FROM inspeksi_apar");
        $arr = 0;
        if($result){
            http_response_code(200);
            if($inspeksi == 'belum'){
                if($kadaluarsa == "semua") $allApar = mysqli_query($conn, "SELECT * FROM apar");
                if($kadaluarsa == "belum") $allApar = mysqli_query($conn, "SELECT * FROM apar  WHERE `tanggal_kadaluarsa` > '".date("Y-m-d h:i:s")."'");
                if($kadaluarsa == "sudah") $allApar = mysqli_query($conn, "SELECT * FROM apar WHERE `tanggal_kadaluarsa` < '".date("Y-m-d h:i:s")."'");
                while($data = mysqli_fetch_object($allApar)){
                    $data2 = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_apar WHERE apar_id = $data->id AND created_at > '$start_date' AND created_at < '$end_date'"));
                    if($data2 == null) $datas[$arr++] = $data;
                }
            }
            else{
                while($data = mysqli_fetch_object($result)){
                        if($kadaluarsa == "semua"){
                            $resultUser = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data->user_id"));
                            $resultApar = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM apar WHERE id = $data->apar_id"));
                            $data->user = $resultUser;
                            $data->apar = $resultApar;
                            $datas[$arr++] = $data;
                        }
                        else if($kadaluarsa == "belum"){
                            $resultApar = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM apar WHERE id = $data->apar_id  AND `tanggal_kadaluarsa` > '".date("Y-m-d h:i:s")."'"));
                            if($resultApar){
                                $resultUser = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data->user_id"));
                                $data->user = $resultUser;
                                $data->apar = $resultApar;
                                $datas[$arr++] = $data;
                            }
                        }
                        else if($kadaluarsa == "sudah"){
                            $resultApar = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM apar WHERE id = $data->apar_id  AND `tanggal_kadaluarsa` < '".date("Y-m-d h:i:s")."'"));
                            if($resultApar){
                                $resultUser = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data->user_id"));
                                $data->user = $resultUser;
                                $data->apar = $resultApar;
                                $datas[$arr++] = $data;
                            }
                        }

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
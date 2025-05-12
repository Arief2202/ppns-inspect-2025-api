<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['read']) || isset($_POST['read'])){
        $datas = [];
        $resultApar = [0,0,0];
        $resultIHB = [0,0,0];
        $resultOHB = [0,0,0];

        $start_date = null;
        $end_date = null;

        if(isset($_GET['read'])){
            if(isset($_GET['start_date'])) $start_date = $_GET['start_date'];
            if(isset($_GET['end_date'])) $end_date = $_GET['end_date'];
        }
        
        if($start_date!=null & $end_date != null){
            $sqlApar = "SELECT * FROM inspeksi_apar WHERE created_at > '$start_date' AND created_at < '$end_date'";
            $resultApar[0] = mysqli_query($conn, "SELECT * FROM apar")->num_rows - mysqli_query($conn, $sqlApar)->num_rows;
            $resultApar[1] = mysqli_query($conn, $sqlApar." AND `tersedia` = 'Tersedia' AND `kondisi_tabung` = 'Baik' AND `segel_pin` = 'Terpasang' AND `tuas_pegangan` = 'Baik' AND `label_segitiga` = 'Tersedia' AND `label_instruksi` = 'Terbaca' AND `kondisi_selang` = 'Baik' AND `tekanan_tabung` = 'Tepat di hijau' AND `posisi` = 'Terlihat'")->num_rows;
            $resultApar[2] = mysqli_query($conn, $sqlApar." AND (`tersedia` != 'Tersedia' OR `kondisi_tabung` != 'Baik' OR `segel_pin` != 'Terpasang' OR `tuas_pegangan` != 'Baik' OR `label_segitiga` != 'Tersedia' OR `label_instruksi` != 'Terbaca' OR `kondisi_selang` != 'Baik' OR `tekanan_tabung` != 'Tepat di hijau' OR `posisi` != 'Terlihat')")->num_rows;
            
            $sqlIHB = "SELECT * FROM inspeksi_hydrant_ihb WHERE created_at > '$start_date' AND created_at < '$end_date'";
            $resultIHB[0] = mysqli_query($conn, "SELECT * FROM hydrant where jenis_hydrant = 'ihb'")->num_rows - mysqli_query($conn, $sqlIHB)->num_rows;
            $resultIHB[1] = mysqli_query($conn, $sqlIHB." AND `kondisi_kotak` = 'Bersih' AND `posisi_kotak` = 'Tidak Terhalang' AND `kondisi_nozzle` = 'Baik' AND `kondisi_selang` = 'Baik' AND `kondisi_coupling` = 'Baik' AND `kondisi_landing_valve` = 'Baik' AND `kondisi_tray` = 'Baik'")->num_rows;
            $resultIHB[2] = mysqli_query($conn, $sqlIHB." AND (`kondisi_kotak` != 'Bersih' OR `posisi_kotak` != 'Tidak Terhalang' OR `kondisi_nozzle` != 'Baik' OR `kondisi_selang` != 'Baik' OR `kondisi_coupling` != 'Baik' OR `kondisi_landing_valve` != 'Baik' OR `kondisi_tray` != 'Baik')")->num_rows;
            
            $sqlOHB = "SELECT * FROM inspeksi_hydrant_ohb WHERE created_at > '$start_date' AND created_at < '$end_date'";
            $resultOHB[0] = mysqli_query($conn, "SELECT * FROM hydrant where jenis_hydrant = 'ohb'")->num_rows - mysqli_query($conn, $sqlOHB)->num_rows;
            $resultOHB[1] = mysqli_query($conn, $sqlOHB." AND `kondisi_kotak` = 'Bersih' AND `posisi_kotak` = 'Tidak Terhalang' AND `kondisi_nozzle` = 'Baik' AND `kondisi_selang` = 'Baik' AND `kondisi_coupling` = 'Baik' AND `tuas_pembuka` = 'Tersedia' AND `kondisi_outlet` = 'Baik' AND `penutup_cop` = 'Baik'")->num_rows;
            $resultOHB[2] = mysqli_query($conn, $sqlOHB." AND (`kondisi_kotak` != 'Bersih' OR `posisi_kotak` != 'Tidak Terhalang' OR `kondisi_nozzle` != 'Baik' OR `kondisi_selang` != 'Baik' OR `kondisi_coupling` != 'Baik' OR `tuas_pembuka` != 'Tersedia' OR `kondisi_outlet` != 'Baik' OR `penutup_cop` != 'Baik')")->num_rows;

        }

        http_response_code(200);
        // $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM hydrant WHERE nomor = '".$nomor."'"));
        echo json_encode([
            "status" => "success",
            "data" => [
                "apar" => [
                    "belum"=> "$resultApar[0]",
                    "rusak"=> "$resultApar[1]",
                    "normal"=> "$resultApar[2]",
                ],
                "ihb" => [
                    "belum"=> "$resultIHB[0]",
                    "rusak"=> "$resultIHB[1]",
                    "normal"=> "$resultIHB[2]",
                ],
                "ohb" => [
                    "belum"=> "$resultOHB[0]",
                    "rusak"=> "$resultOHB[1]",
                    "normal"=> "$resultOHB[2]",
                ],
            ],
            "pesan" => "Data Pie Chart Berhasil Diambil",
        ]);
die;




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
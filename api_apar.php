<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['create']) || isset($_POST['create'])){
        $jenis_pemadam;
        $nomor;
        $lokasi;
        $kadaluarsa;
        $berat;
        $rating;
        if(isset($_GET['create'])){
            $jenis_pemadam = $_GET['jenis_pemadam'];
            $nomor = $_GET['nomor'];
            $lokasi = $_GET['lokasi'];
            $kadaluarsa = $_GET['kadaluarsa'];
            $berat = $_GET['berat'];
            $rating = $_GET['rating'];
        }
        else if(isset($_POST['create'])){
            $jenis_pemadam = $_POST['jenis_pemadam'];
            $nomor = $_POST['nomor'];
            $lokasi = $_POST['lokasi'];
            $kadaluarsa = $_POST['kadaluarsa'];
            $berat = $_POST['berat'];
            $rating = $_POST['rating'];
        }
        //2024-03-31 00:00:00 
        $sql = "INSERT INTO `apar` (`id`, `jenis_pemadam`, `nomor`, `lokasi`, `berat`, `rating`, `tanggal_kadaluarsa`, `timestamp`) VALUES (NULL, '".$jenis_pemadam."', '".$nomor."', '".$lokasi."', '".$berat."', '".$rating."', '".$kadaluarsa."', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            http_response_code(200);
            $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM apar WHERE nomor = '".$nomor."'"));
            echo json_encode([
                "status" => "success",
                "data" => $data,
                "pesan" => "Data Apar Berhasil Ditambahkan",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data Apar Gagal Ditambahkan",
            ]);
        }
    }
    
    if(isset($_GET['read']) || isset($_POST['read'])){
        $datas=[];
        $kadaluarsa = null;
        if(isset($_GET['kadaluarsa'])) $kadaluarsa = $_GET['kadaluarsa'];
        if(isset($_POST['kadaluarsa'])) $kadaluarsa = $_POST['kadaluarsa'];
        if($kadaluarsa == 'sudah') $result = mysqli_query($conn, "SELECT * FROM apar WHERE `tanggal_kadaluarsa` < '".date("Y-m-d h:i:s")."'");
        else if($kadaluarsa == 'belum') $result = mysqli_query($conn, "SELECT * FROM apar WHERE `tanggal_kadaluarsa` > '".date("Y-m-d h:i:s")."'");
        else $result = mysqli_query($conn, "SELECT * FROM apar");
        if($result){
            http_response_code(200);
            $arr = 0;
            while($data = mysqli_fetch_object($result)){
                $datas[$arr++] = $data;
            }
            echo json_encode([
                "status" => "success",
                "pesan" => "Read all data Apar Success",
                "data" => $datas,
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Read all data Apar Failed!"
            ]);
        }
    }
    if(isset($_GET['search']) || isset($_POST['search'])){
        $id = null;
        $nomor = null;
        if(isset($_GET['search'])){
            if(isset($_GET['id'])) $id = $_GET['id'];
            if(isset($_GET['nomor'])) $nomor = $_GET['nomor'];
        }
        else if(isset($_POST['search'])){
            if(isset($_POST['id'])) $id = $_POST['id'];
            if(isset($_POST['nomor'])) $nomor = $_POST['nomor'];
        }
        if($id != null && $nomor == null) $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `apar` WHERE id = ".$id));
        else if($id == null && $nomor != null) $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `apar` WHERE nomor = '$nomor'"));
        else if($id != null && $nomor != null) $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `apar` WHERE id = $id AND nomor = '$nomor'"));
        else if($id == null && $nomor == null){
            echo json_encode([
                "status" => "failed",
                "pesan" => "Search data Failed!, Required id or nomor",
            ]);die;
        }
        if($data){ 
            $data2 = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_apar WHERE apar_id = $data->id AND created_at > '".date("Y-m")."-01 00:00:00' AND created_at < '".date("Y-m")."-31 23:59:59'"));
            if($data2){
                $user = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data2->user_id"));
                http_response_code(200);
                echo json_encode([
                    "status" => "success",
                    "inspection" => false,
                    "pesan" => "Search data Successed!",
                    "data_inspeksi" => $data2,
                    "data_apar" => $data,
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
        else{            
            echo json_encode([
                "status" => "failed",
                "pesan" => "Search data Failed!, data not found"
            ]);die;
        }

    }
    if(isset($_GET['update']) || isset($_POST['update'])){
        $id = null;
        $jenis_pemadam = null;
        $nomor = null;
        $lokasi = null;
        $kadaluarsa = null;
        $berat = null;
        $rating = null;
        if(isset($_GET['update'])){
            if(isset($_GET['jenis_pemadam'])) $jenis_pemadam = $_GET['jenis_pemadam'];
            if(isset($_GET['id'])) $id = $_GET['id'];
            if(isset($_GET['nomor'])) $nomor = $_GET['nomor'];
            if(isset($_GET['lokasi'])) $lokasi = $_GET['lokasi'];   
            if(isset($_GET['berat'])) $berat = $_GET['berat'];   
            if(isset($_GET['rating'])) $rating = $_GET['rating'];   
            if(isset($_GET['kadaluarsa'])) $kadaluarsa = $_GET['kadaluarsa'];
        }
        else if(isset($_POST['update'])){
            if(isset($_POST['jenis_pemadam'])) $jenis_pemadam = $_POST['jenis_pemadam'];
            if(isset($_POST['id'])) $id = $_POST['id'];
            if(isset($_POST['nomor'])) $nomor = $_POST['nomor'];
            if(isset($_POST['lokasi'])) $lokasi = $_POST['lokasi'];
            if(isset($_POST['berat'])) $berat = $_POST['berat'];
            if(isset($_POST['rating'])) $rating = $_POST['rating'];
            if(isset($_POST['kadaluarsa'])) $kadaluarsa = $_POST['kadaluarsa'];
        }
        $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `apar` WHERE id = ".$id));
        if($data){
            if($jenis_pemadam != null) $data->jenis_pemadam = $jenis_pemadam;
            if($nomor != null) $data->nomor = $nomor;
            if($lokasi != null) $data->lokasi = $lokasi;
            if($berat != null) $data->berat = $berat;
            if($rating != null) $data->rating = $rating;
            if($kadaluarsa != null) $data->tanggal_kadaluarsa = $kadaluarsa;
            
            //2024-03-31 00:00:00 
            $sql = "UPDATE `apar` SET `jenis_pemadam` = '".$data->jenis_pemadam."', `nomor` = '".$data->nomor."', `lokasi` = '".$data->lokasi."', `berat` = '".$data->berat."', `rating` = '".$data->rating."', `tanggal_kadaluarsa` = '".$data->tanggal_kadaluarsa."' WHERE `apar`.`id` = ".$id.";";
            $result = mysqli_query($conn, $sql);
            if($result){
                http_response_code(200);
                $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM apar WHERE id = '".$id."'"));
                echo json_encode([
                    "status" => "success",
                    "pesan" => "Data Apar Berhasil Diupdate",
                    "data" => $data,
                ]);
            }
            else{
                echo json_encode([
                    "status" => "failed",
                    "pesan" => "Data Apar Gagal Diupdate",
                ]);
            }
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data Apar Gagal Diupdate, ID tidak ditemukan!",
            ]);
        }
    }

    if(isset($_GET['delete']) || isset($_POST['delete'])){
        $id;
        if(isset($_GET['delete'])){
            $id = $_GET['id'];
        }
        else if(isset($_POST['delete'])){
            $id = $_GET['id'];
        }
        $result = mysqli_query($conn, "DELETE FROM `apar` WHERE `apar`.`id` = ".$id);
        if($result){
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "pesan" => "Delete Apar Berhasil",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Delete Apar Gagal",
            ]);
        }
    }
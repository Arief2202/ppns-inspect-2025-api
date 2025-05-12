<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['create']) || isset($_POST['create'])){
        $nomor;
        $lokasi;
        $jenis;
        if(isset($_GET['create'])){
            $nomor = $_GET['nomor'];
            $lokasi = $_GET['lokasi'];
            $jenis = $_GET['jenis'];
        }
        else if(isset($_POST['create'])){
            $nomor = $_POST['nomor'];
            $lokasi = $_POST['lokasi'];
            $jenis = $_POST['jenis'];
        }
        if($jenis != "ihb" && $jenis != "ohb") $jenis = "ihb";
        //2024-03-31 00:00:00 
        $sql = "INSERT INTO `hydrant` (`id`, `nomor`, `lokasi`, `jenis_hydrant`, `timestamp`) VALUES (NULL, '".$nomor."', '".$lokasi."', '".$jenis."', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            http_response_code(200);
            $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM hydrant WHERE nomor = '".$nomor."'"));
            echo json_encode([
                "status" => "success",
                "data" => $data,
                "pesan" => "Data Hydrant Berhasil Ditambahkan",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data Hydrant Gagal Ditambahkan",
            ]);
        }
    }
    
    if(isset($_GET['search']) || isset($_POST['search'])){
        $id = null;
        $nomor = null;
        $jenis = null;
        if(isset($_GET['search'])){
            if(isset($_GET['id'])) $id = $_GET['id'];
            if(isset($_GET['nomor'])) $nomor = $_GET['nomor'];
            if(isset($_GET['jenis'])) $jenis = $_GET['jenis'];
        }
        else if(isset($_POST['search'])){
            if(isset($_POST['id'])) $id = $_POST['id'];
            if(isset($_POST['nomor'])) $nomor = $_POST['nomor'];
            if(isset($_POST['jenis'])) $jenis = $_POST['jenis'];
        }
        if($jenis == null)$jenis = "ihb";
        if($id != null && $nomor == null) $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `hydrant` WHERE jenis_hydrant = '$jenis' AND id = ".$id));
        else if($id == null && $nomor != null) $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `hydrant` WHERE jenis_hydrant = '$jenis' AND nomor = '$nomor'"));
        else if($id != null && $nomor != null) $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `hydrant` WHERE jenis_hydrant = '$jenis' AND id = $id AND nomor = '$nomor'"));
        else if($id == null && $nomor == null){
            echo json_encode([
                "status" => "failed",
                "pesan" => "Search data Failed!, Required id or nomor",
            ]);die;
        }
        if($data){ 
            $data2 = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_hydrant_$jenis WHERE hydrant_id = $data->id AND created_at > '".date("Y-m")."-01 00:00:00' AND created_at < '".date("Y-m")."-31 23:59:59'"));
            if($data2){
                $user = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = $data2->user_id"));
                http_response_code(200);
                echo json_encode([
                    "status" => "success",
                    "inspection" => false,
                    "pesan" => "Search data Successed!",
                    "data_inspeksi" => $data2,
                    "data_hydrant" => $data,
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

    if(isset($_GET['read']) || isset($_POST['read'])){
        $datas = [];
        $result;
        $jenis = null;
        if (isset($_GET['jenis']) || isset($_POST['jenis'])){
            if(isset($_GET['jenis'])) $jenis = $_GET['jenis'];
            if(isset($_POST['jenis'])) $jenis = $_POST['jenis'];
            if($jenis == 'ihb' || $jenis == 'ohb') $result = mysqli_query($conn, "SELECT * FROM hydrant WHERE jenis_hydrant = '".$jenis."'");
            else $result = mysqli_query($conn, "SELECT * FROM hydrant");
        }
        else{
            $result = mysqli_query($conn, "SELECT * FROM hydrant");
        }
        if($result){
            http_response_code(200);
            $arr = 0;
            while($data = mysqli_fetch_object($result)){
                $datas[$arr++] = $data;
            }
            $pesan = "Read all data Hydrant Success";
            if($jenis == 'ihb') $pesan = "Read all data Hydrant IHB Success";
            if($jenis == 'ohb') $pesan = "Read all data Hydrant OHB Success";
            echo json_encode([
                "status" => "success",
                "pesan" => $pesan,
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
    if(isset($_GET['update']) || isset($_POST['update'])){
        $id = null;
        $nomor = null;
        $lokasi = null;
        $jenis = null;
        if(isset($_GET['update'])){
            if(isset($_GET['id'])) $id = $_GET['id'];
            if(isset($_GET['nomor'])) $nomor = $_GET['nomor'];
            if(isset($_GET['lokasi'])) $lokasi = $_GET['lokasi'];
            if(isset($_GET['jenis'])) $jenis = $_GET['jenis'];
        }
        else if(isset($_POST['update'])){
            if(isset($_POST['id'])) $id = $_POST['id'];
            if(isset($_POST['nomor'])) $nomor = $_POST['nomor'];
            if(isset($_POST['lokasi'])) $lokasi = $_POST['lokasi'];
            if(isset($_POST['jenis'])) $jenis = $_POST['jenis'];
        }
        if($jenis != "ihb" && $jenis != "ohb" && $jenis != null) $jenis = "ihb";
        $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `hydrant` WHERE id = ".$id));
        if($data){
            if($nomor != null) $data->nomor = $nomor;
            if($lokasi != null) $data->lokasi = $lokasi;
            if($lokasi != null) $data->lokasi = $lokasi;
            if($jenis != null) $data->jenis_hydrant = $jenis;
            
            //2024-03-31 00:00:00 
            $sql = "UPDATE `hydrant` SET `nomor` = '".$data->nomor."', `lokasi` = '".$data->lokasi."', `jenis_hydrant` = '".$data->jenis_hydrant."' WHERE `hydrant`.`id` = ".$id.";";
            $result = mysqli_query($conn, $sql);
            if($result){
                http_response_code(200);
                $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM apar WHERE id = '".$id."'"));
                echo json_encode([
                    "status" => "success",
                    "pesan" => "Data Hydrant Berhasil Diupdate",
                    "data" => $data,
                ]);
            }
            else{
                echo json_encode([
                    "status" => "failed",
                    "pesan" => "Data Hydrant Gagal Diupdate",
                ]);
            }
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data Hydrant Gagal Diupdate, ID tidak ditemukan!",
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
        $result = mysqli_query($conn, "DELETE FROM `hydrant` WHERE `hydrant`.`id` = ".$id);
        if($result){
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "pesan" => "Delete Hydrant Berhasil",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Delete Hydrant Gagal",
            ]);
        }
    }
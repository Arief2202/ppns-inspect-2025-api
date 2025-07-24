<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['create']) || isset($_POST['create'])){
        $nomor;
        $lokasi;
        if(isset($_GET['create'])){
            $nomor = $_GET['nomor'];
            $lokasi = $_GET['lokasi'];
        }
        else if(isset($_POST['create'])){
            $nomor = $_POST['nomor'];
            $lokasi = $_POST['lokasi'];
        }
        //2024-03-31 00:00:00 
        $sql = "INSERT INTO `p3k` (`id`, `nomor`, `lokasi`, `timestamp`) VALUES (NULL, '".$nomor."', '".$lokasi."', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        if($result){
            http_response_code(200);
            $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM p3k WHERE nomor = '".$nomor."'"));
            echo json_encode([
                "status" => "success",
                "data" => $data,
                "pesan" => "Data P3K Berhasil Ditambahkan",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data P3K Gagal Ditambahkan",
            ]);
        }
    }
    
    if(isset($_GET['read']) || isset($_POST['read'])){
        $datas=[];
        $result = mysqli_query($conn, "SELECT * FROM p3k");
        if($result){
            http_response_code(200);
            $arr = 0;
            while($data = mysqli_fetch_object($result)){
                $datas[$arr++] = $data;
            }
            echo json_encode([
                "status" => "success",
                "pesan" => "Read all data P3K Success",
                "data" => $datas,
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Read all data P3K Failed!"
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
        if($id != null && $nomor == null) $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `p3k` WHERE id = ".$id));
        else if($id == null && $nomor != null) $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `p3k` WHERE nomor = '$nomor'"));
        else if($id != null && $nomor != null) $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `p3k` WHERE id = $id AND nomor = '$nomor'"));
        else if($id == null && $nomor == null){
            echo json_encode([
                "status" => "failed",
                "pesan" => "Search data Failed!, Required id or nomor",
            ]);die;
        }
        if($data){ 
            $data2 = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM inspeksi_p3k WHERE kotak_id = $data->id AND created_at > '".date("Y-m")."-01 00:00:00' AND created_at < '".date("Y-m")."-31 23:59:59'"));
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
        $nomor = null;
        $lokasi = null;

        if(isset($_GET['update'])){
            if(isset($_GET['id'])) $id = $_GET['id'];
            if(isset($_GET['nomor'])) $nomor = $_GET['nomor'];
            if(isset($_GET['lokasi'])) $lokasi = $_GET['lokasi'];   
        }
        else if(isset($_POST['update'])){
            if(isset($_POST['id'])) $id = $_POST['id'];
            if(isset($_POST['nomor'])) $nomor = $_POST['nomor'];
            if(isset($_POST['lokasi'])) $lokasi = $_POST['lokasi'];
        }

        $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `p3k` WHERE id = ".$id));
        if($data){
            if($nomor != null) $data->nomor = $nomor;
            if($lokasi != null) $data->lokasi = $lokasi;
            //2024-03-31 00:00:00 
            $sql = "UPDATE `p3k` SET `nomor` = '".$data->nomor."', `lokasi` = '".$data->lokasi."' WHERE `p3k`.`id` = ".$id.";";
            $result = mysqli_query($conn, $sql);
            if($result){
                http_response_code(200);
                $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM p3k WHERE id = '".$id."'"));
                echo json_encode([
                    "status" => "success",
                    "pesan" => "Data P3K Berhasil Diupdate",
                    "data" => $data,
                ]);
            }
            else{
                echo json_encode([
                    "status" => "failed",
                    "pesan" => "Data P3K Gagal Diupdate",
                ]);
            }
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data P3K Gagal Diupdate, ID tidak ditemukan!",
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
        $result = mysqli_query($conn, "DELETE FROM `p3k` WHERE `p3k`.`id` = ".$id);
        if($result){
            
            mysqli_query($conn, "DELETE FROM `inspeksi_p3k` WHERE `inspeksi_p3k`.`kotak_id` = ".$id);
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "pesan" => "Delete P3K Berhasil",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Delete P3K Gagal",
            ]);
        }
    }
<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['create']) || isset($_POST['create'])){
        $role=null;
        $name=null;
        $email=null;
        $password=null;
        if(isset($_GET['create'])){
            $role = $_GET['role'];
            $name = $_GET['name'];
            $email = $_GET['email'];
            $password = $_GET['password'];
        }
        else if(isset($_POST['create'])){
            $role = $_POST['role'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        if($role != null && $name != null & $email != null & $password != null){
            $sql = "INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `created_at`) VALUES (NULL, '".$role."', '".$name."', '".$email."', '".password_hash($password, PASSWORD_DEFAULT)."', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if($result){
                http_response_code(200);
                echo json_encode([
                    "status" => "success",
                    "pesan" => "Data User Berhasil Ditambahkan",
                ]);
            }
            else{
                echo json_encode([
                    "status" => "failed",
                    "pesan" => "Data User Gagal Ditambahkan",
                ]);
            }
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data User Gagal Ditambahkan, Paramater tidak lengkap!",
            ]);
        }
    }
    
    if(isset($_GET['read']) || isset($_POST['read'])){
        $datas=[];
        $result = mysqli_query($conn, "SELECT * FROM users");
        if($result){
            http_response_code(200);
            $arr = 0;
            while($data = mysqli_fetch_object($result)){
                $datas[$arr++] = $data;
            }
            echo json_encode([
                "status" => "success",
                "pesan" => "Read all data User Success",
                "data" => $datas,
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Read all data User Failed!"
            ]);
        }
    }
    if(isset($_GET['update']) || isset($_POST['update'])){
        $id = null;
        $role = null;
        $name = null;
        $email = null;
        $password = null;
        if(isset($_GET['update'])){
            if(isset($_GET['id'])) $id = $_GET['id'];
            if(isset($_GET['role'])) $role = $_GET['role'];
            if(isset($_GET['name'])) $name = $_GET['name'];
            if(isset($_GET['email'])) $email = $_GET['email'];
            if(isset($_GET['password'])) $password = $_GET['password'];
        }
        else if(isset($_POST['update'])){
            if(isset($_POST['id'])) $id = $_POST['id'];
            if(isset($_POST['role'])) $role = $_POST['role'];
            if(isset($_POST['name'])) $name = $_POST['name'];
            if(isset($_POST['email'])) $email = $_POST['email'];
            if(isset($_POST['password'])) $password = $_POST['password'];
        }
        $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM `users` WHERE id = ".$id));
        if($data){
            if($role != null) $data->role = $role;
            if($name != null) $data->name = $name;
            if($email != null) $data->email = $email;
            if($password != null && $password != $data->password) $data->password = password_hash($password, PASSWORD_DEFAULT);
            
            //2024-03-31 00:00:00 
            $sql = "UPDATE `users` SET `role` = '".$data->role."', `name` = '".$data->name."', `email` = '".$data->email."' , `password` = '".$data->password."' WHERE `id` = ".$id.";";
            $result = mysqli_query($conn, $sql);
            if($result){
                http_response_code(200);
                $data = mysqli_fetch_object(mysqli_query($conn, "SELECT * FROM users WHERE id = '".$id."'"));
                echo json_encode([
                    "status" => "success",
                    "pesan" => "Data User Berhasil Diupdate",
                    "data" => $data,
                ]);
            }
            else{
                echo json_encode([
                    "status" => "failed",
                    "pesan" => "Data User Gagal Diupdate",
                ]);
            }
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Data User Gagal Diupdate, ID tidak ditemukan!",
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
        $result = mysqli_query($conn, "DELETE FROM `users` WHERE `users`.`id` = ".$id);
        if($result){
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "pesan" => "Delete User Berhasil",
            ]);
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Delete User Gagal",
            ]);
        }
    }
<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);

    if(isset($_GET['read']) || isset($_POST['read'])){
        $datas=[];
        $user_id = null;
        $history = null;
        if(isset($_GET['user_id']) && $_GET['user_id'] != "") $user_id = $_GET['user_id']; 
        if(isset($_POST['user_id']) && $_POST['user_id'] != "") $user_id = $_POST['user_id'];
        if($user_id != null){
            $result = mysqli_query($conn, "SELECT * FROM notification WHERE `user_id` = $user_id AND `displayed` = 0");
            if($result){
                http_response_code(200);
                $arr = 0;
                while($data = mysqli_fetch_object($result)){
                    $datas[$arr++] = $data;
                }
                echo json_encode([
                    "status" => "success",
                    "pesan" => "Read all data Notificatoin Success",
                    "data" => $datas,
                ]);
            }
            else{
                echo json_encode([
                    "status" => "failed",
                    "pesan" => "Read all data Notification Failed!"
                ]);
            }
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Read all data Notification Failed!"
            ]);
        }
    }
    
    if(isset($_GET['displayed']) || isset($_POST['displayed'])){
        $notif_id = null;
        if(isset($_GET['notif_id']) && $_GET['notif_id'] != "") $notif_id = $_GET['notif_id']; 
        if(isset($_POST['notif_id']) && $_POST['notif_id'] != "") $notif_id = $_POST['notif_id'];
        
        if($notif_id != null){
            $result = mysqli_query($conn, "UPDATE `notification` SET `displayed` = '1' WHERE `notification`.`id` = $notif_id;");
            if($result){
                http_response_code(200);
                echo json_encode([
                    "status" => "success",
                    "pesan" => "Update Notification Success",
                ]);
            }
            else{
                echo json_encode([
                    "status" => "failed",
                    "pesan" => "Update Notification reading failed!"
                ]);
            }
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "Required Notification id!"
            ]);
        }
    }
    
    if(isset($_GET['check_kadaluarsa']) || isset($_POST['check_kadaluarsa'])){
        http_response_code(200);
        
        $result = mysqli_query($conn, "SELECT * FROM apar");
        while($apar = mysqli_fetch_object($result)){                
            $now = new DateTime(date('Y-m-d'));
            $dataTime = new DateTime($apar->tanggal_kadaluarsa);                
            $abs_diff = $now->diff($dataTime)->format("%r%a");
            if($abs_diff <= 30){
                $users = mysqli_query($conn, "SELECT * FROM users where role = 1");
                while($userAdmin = mysqli_fetch_object($users)){
                    if($abs_diff > 0) mysqli_query($conn, "INSERT INTO `notification` (`id`, `user_id`, `title`, `content`, `displayed`, `timestamp`) VALUES (NULL, '$userAdmin->id', 'APAR Hampir Kadaluarsa', 'APAR hampir kadaluarsa terdeteksi, Tersisa $abs_diff Hari lagi, Nomor Apar : $apar->nomor', '0', current_timestamp());");
                    else mysqli_query($conn, "INSERT INTO `notification` (`id`, `user_id`, `title`, `content`, `displayed`, `timestamp`) VALUES (NULL, '$userAdmin->id', 'APAR Kadaluarsa', 'APAR kadaluarsa terdeteksi, Nomor Apar : $apar->nomor', '0', current_timestamp());");
                }
            }
        }
    }
    if(isset($_GET['check_reminder_inspeksi']) || isset($_POST['check_reminder_inspeksi'])){
        http_response_code(200);
        if(isset($_GET['user_id']) || isset($_POST['user_id'])){
            $user_id = null;
            if(isset($_GET['user_id'])) $user_id = $_GET['user_id'];
            if(isset($_POST['user_id'])) $user_id = $_POST['user_id'];
            if($user_id){
                if(((int) date('d')) < 10 || ((int) date('d')) > 25 ){            
                    mysqli_query($conn, "INSERT INTO `notification` (`id`, `user_id`, `title`, `content`, `displayed`, `timestamp`) VALUES (NULL, '$user_id', 'Reminder Inspeksi', 'Harap Lakukan inspeksi APAR & HYDRANT sebelum tanggal 10', '0', current_timestamp());");
                }
            }
        }
    }
    
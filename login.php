<?php
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(406);
    if((isset($_POST['username']) || isset($_POST['email'])) && isset($_POST['password'])){
        if(isset($_POST['username'])) $email = $_POST['username'];
        if(isset($_POST['email'])) $email = $_POST['email'];
        $user = mysqli_fetch_object(mysqli_query($conn, 'SELECT * FROM users where email = "'.$email.'"'));
        if($user){
            if (password_verify($_POST['password'], $user->password)) {
                http_response_code(200);
                echo json_encode([
                    "status" => "success",
                    "data" => [
                        "user" => $user,
                    ],
                    "pesan" => "",
                ]);
            } else {
                echo json_encode([
                    "status" => "failed",
                    "pesan" => "invalid username or password!"
                ]);
            }
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "invalid username or password!"
            ]);
        }
    }
    else if((isset($_GET['username']) || isset($_GET['email'])) && isset($_GET['password'])){
        if(isset($_GET['username'])) $email = $_GET['username'];
        if(isset($_GET['email'])) $email = $_GET['email'];
        $user = mysqli_fetch_object(mysqli_query($conn, 'SELECT * FROM users where email = "'.$email.'"'));
        if($user){
            if (password_verify($_GET['password'], $user->password)) {
                http_response_code(200);
                echo json_encode([
                    "status" => "success",
                    "data" => [
                        "user" => $user,
                    ],
                    "pesan" => "",
                ]);
            } else {
                echo json_encode([
                    "status" => "failed",
                    "pesan" => "invalid username or password!"
                ]);
            }
        }
        else{
            echo json_encode([
                "status" => "failed",
                "pesan" => "invalid username or password!"
            ]);
        }
    }
    else{
        echo json_encode([
            "status" => "failed",
            "pesan" => "please input username or password!"
        ]);
    }

?> 
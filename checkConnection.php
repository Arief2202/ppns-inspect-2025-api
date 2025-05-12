<?php
    http_response_code(406);
    include "koneksi.php";
    header('Content-Type: application/json; charset=utf-8');
    
    http_response_code(200);
    echo json_encode([
        "status" => "success",
        "pesan" => "Connection OK",
    ]);
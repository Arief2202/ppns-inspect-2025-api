<?php
    include "koneksi.php";
    $sql = mysqli_query($conn, "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='ppns_2025_inspect'");
    while($tb = mysqli_fetch_object($sql)){
        mysqli_query($conn, "DROP TABLE `ppns_inspect`.`$tb->TABLE_NAME`");
    }
    echo "done";
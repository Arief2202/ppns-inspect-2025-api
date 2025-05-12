<?php
    $conn = mysqli_connect("localhost", "root", "", "ppns_inspect");
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }
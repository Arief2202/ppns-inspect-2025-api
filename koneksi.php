<?php
    $conn = mysqli_connect("localhost", "ppns_2025_inspect", "ppns", "ppns_2025_inspect");
    if ($conn -> connect_errno) {
        echo "Failed to connect to MySQL: " . $conn -> connect_error;
        exit();
    }

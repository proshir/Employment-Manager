<?php       
    $host = "sql201.epizy.com";
    $username = "epiz_33267580";
    $password = "6w0r3zxn";
    $dbname = "epiz_33267580_test";
    $conn = mysqli_connect($host, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection to database failed: " .$conn->connect_error);
    }
?>
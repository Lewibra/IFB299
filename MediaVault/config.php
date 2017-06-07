<?php
    require "variables.php";
    define('DB_SERVER', $servername);
    define('DB_USERNAME', $username);
    define('DB_PASSWORD', $password);
    define('DB_DATABASE', $dbname);
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
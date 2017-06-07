<?php
require "config.php";
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE file_details 
            SET `details` = '" . $_GET["desc"] . "'
            WHERE user_name = '" . $_SESSION["login_user"] . "'AND file_id ='" . $_GET["fileId"] ."'";
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

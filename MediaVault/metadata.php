<?php
require "variables.php";
require "config.php";
if (unlink("./mediavault_files/users/".$_SESSION['login_user']."/".$_GET['file'])){
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO file_details WHERE user_name = '" . $_SESSION["login_user"] . "'AND file_id ='" .$_GET["fileId"] .  "' ('details')
                VALUES ('CONCAT_WS(details, $_GET["desc"])')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
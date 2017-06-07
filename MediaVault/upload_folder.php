<?php
require "config.php";
session_start();
if($_GET['action'] == 'call_this') {
    if (!file_exists('./mediavault_files/users/'.$_SESSION['location'].'/' . $_GET['folderName'])) {
        mkdir('./mediavault_files/users/'.$_SESSION['location'].'/' . $_GET['folderName'] , 0777, true);
        // Register the folder into SQL
        //Please note that the table is configured to auto increment
        //Register the new folder into the SQL database
        $sql = "INSERT INTO `file_details` (`user_name`, `file_name`, `file_type`, `file_location`, `location_inside`, `details`)
                VALUES ('".$_SESSION['login_user']."', '".$_GET['folderName']."','folder', '".$_SESSION['location']."', '".$_SESSION['location']."/".$_GET['folderName']."', '".$_GET['folderName']."')";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
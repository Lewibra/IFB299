<?php
require "config.php";
session_start();
if($_GET['action'] == 'call_this') {
        //Register the new folder into the SQL database
        $sql = "UPDATE `user_id` 
                SET `email_address` = '".$_GET['email']."'
                WHERE user_name = '" . $_SESSION["login_user"]."'";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

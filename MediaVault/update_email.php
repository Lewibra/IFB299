<?php
require "variables.php";
session_start();
session_id($_GET['sess']);
header("Content-Type: application/json", true);
if($_POST['action'] == 'call_this') {
        //Register the new folder into the SQL database
        $sql = "INSERT INTO 'user_id' ('email_address')
                VALUES ('email')";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
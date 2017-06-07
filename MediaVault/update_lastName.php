<?php
<<<<<<< HEAD
require "variables.php";
session_start();
session_id($_GET['sess']);
header("Content-Type: application/json", true);
if($_POST['action'] == 'call_this') {
        //Register the new folder into the SQL database
        $sql = "INSERT INTO 'user_id' ('last_name')
                VALUES ('last')";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
=======
require "config.php";
session_start();
if($_GET['action'] == 'call_this') {
    //Register the new folder into the SQL database
    $sql = "UPDATE `user_id` 
                SET `last_name` = '".$_GET['last']."'
                WHERE user_name = '" . $_SESSION["login_user"]."'";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
>>>>>>> master

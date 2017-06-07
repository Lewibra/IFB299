<?php
require "config.php";
session_start();
if($_GET['action'] == 'asldnfjanefkjanwekjfbakwefawefajkwbefkjabwe') {
    //Register the new folder into the SQL database
    $sql = "UPDATE `user_id` 
                SET `password` = '".$_GET['asdfasdfasdfasdf']."'
                WHERE user_name = '" . $_SESSION["login_user"]."'";

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}


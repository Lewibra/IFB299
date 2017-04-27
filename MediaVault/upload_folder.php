<?php
require "variables.php";
session_start();
session_id($_GET['sess']);
header("Content-Type: application/json", true);
if($_POST['action'] == 'call_this') {
    if (!file_exists('./mediavault_files/users/ltrac321/' . $_POST['folderName'])) {
        mkdir('./mediavault_files/users/ltrac321/' . $_POST['folderName'] , 0777, true);
        // Register the folder into SQL
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //GET MAX FILE ID
        $sql = "SELECT MAX(file_id) as max FROM file_details";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $file_id = $row["max"] + 1;
            }
        } else {
            $file_id = 0;
        }
        //Register the new folder into the SQL database
        $sql = "INSERT INTO `file_details` (`user_name`, `file_id`, `file_name`, `file_type`)
                VALUES ('".$_SESSION['username']."', '".$file_id."','".$_POST['folderName']."','folder')";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
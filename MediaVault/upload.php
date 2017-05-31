<?php
require "variables.php";
session_start();
session_id($_GET['sess']);
if(!empty($_FILES)){
    $dbHost = 'localhost:8889';
    $dbUsername = 'root';
    $dbPassword = 'root';
    $dbName = 'Media_Vault_Schema'; 
    
    //connect with the database
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($mysqli->connect_errno){
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
 
 	$userName = $dbUsername;
    $targetDir = "./mediavault_files/users/" . $_SESSION['login_user'];
    $fileName = $_FILES['file']['name'];
    $targetFile = $targetDir . "/" .$fileName;
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileSize = filesize($fileName);

    $fileId = uniqid($userName);

    $string = preg_replace('/\s+/', '', $targetFile);

    $newName = preg_replace('/\s+/', '', $fileName);

    if(move_uploaded_file($_FILES['file']['tmp_name'], $string)){
        //insert file information into db table

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
        $sql = "INSERT INTO `Media_Vault_Schema`.`file_details` (`user_name`, `file_id`, `file_name`, `file_type`, `file_location`, `location_inside`)
                VALUES ('".$_SESSION['login_user']."', '".$file_id."','".$newName."','".$fileType."', '".$_SESSION['location']."', '".$_SESSION['location']."/".$newName."')";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
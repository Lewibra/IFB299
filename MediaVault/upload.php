<?php
require "config.php";
session_start();
if(!empty($_FILES)){
 	$userName = $username;
    $targetDir = "./mediavault_files/users/" . $_SESSION['location'];
    $fileName = $_FILES['file']['name'];
    $targetFile = $targetDir . "/" .$fileName;
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileSize = filesize($fileName);
    $fileId = uniqid($userName);
    $string = preg_replace('/\s+/', '', $targetFile);
    $newName = preg_replace('/\s+/', '', $fileName);

    if (file_exists($_FILES['file']['tmp_name'])){
        if(move_uploaded_file($_FILES['file']['tmp_name'], $string)){
            //insert file information into db table
            //Please note that the table is configured to auto increment
            //Register the new folder into the SQL database
            $sql = "INSERT INTO `Media_Vault_Schema`.`file_details` (`user_name`, `file_name`, `file_type`, `file_location`, `location_inside`, `details`)
                    VALUES ('".$_SESSION['login_user']."', '".$newName."','".$fileType."', '".$_SESSION['location']."', '".$_SESSION['location']."/".$newName."', '".$newName."')";

            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    }
}
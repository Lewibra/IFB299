<?php
    require "variables.php";
    require "config.php";
    $fileLocation = "./mediavault_files/users/".$_SESSION['location']."/".$_GET['file'];

    if (unlink($fileLocation)){
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Delete the File
        $sql = "DELETE FROM file_details 
                    WHERE user_name = '" . $_SESSION['login_user'] . "'AND file_id ='" . $_GET["fileId"]. "'";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }else if (rrmdir($fileLocation)){
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Delete the File
        $sql = "DELETE FROM file_details 
                    WHERE (user_name = '" . $_SESSION['login_user'] . "'AND file_id ='" . $_GET["fileId"]. "') ||
                    (user_name = '" . $_SESSION['login_user'] . "' AND file_location = '".$_SESSION['location']."/".$_GET['file']."')";

        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }



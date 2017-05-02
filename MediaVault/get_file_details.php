<?php
require "variables.php";
session_start();
session_id($_GET['sess']);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM file_details WHERE user_name = '" . $_SESSION["login_user"] . "' AND file_location LIKE '" . $_GET['currentlocation'] . "%'";

if ($_SESSION['login_user'] != $_GET['currentlocation']){
    $sql = "SELECT * FROM file_details WHERE user_name = '" . $_SESSION["login_user"] . "' AND location_inside LIKE '" . $_GET['currentlocation'] . "%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
        $json_array = json_encode($data);
    }
    echo $json_array;
} else {
    echo "0 results";
}
$conn->close();
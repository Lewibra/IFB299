<?php
require "dropbox-sdk/start.php";
list($accessToken) = $webAuth->finish($_GET);
$serverName = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "Media_Vault_Schema";
// Create connection
$conn = mysqli_connect($serverName, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE user_id SET dropbox_token ='" . $accessToken . "' WHERE id =" . $_SESSION['user_id'];
$did_update = false;
if (mysqli_query($conn, $sql)) {
    $did_update = true;
}
mysqli_close($conn);
if ($did_update) {
    header('Location:home.php', true, 301);
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
exit;

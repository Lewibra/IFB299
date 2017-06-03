<?php
$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "Media_Vault_Schema";

function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file)) rrmdir($file); else unlink($file);
    }
    return rmdir($dir);
}
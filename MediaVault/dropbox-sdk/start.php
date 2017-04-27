<?php
session_start();
$_SESSION["user_id"] = 1;
require "Dropbox/autoload.php";
$dropboxKey = "d45jga1g58nm6bs";
$dropboxSecret = "3zhumx7p4lzm6g0";
$appName = "mediavault/1.0";
$appInfo = new Dropbox\AppInfo($dropboxKey, $dropboxSecret);
$csrfTokenStore = new Dropbox\ArrayEntryStore($_SESSION, "dropbox-auth-csrf-token");
$webAuth = new Dropbox\WebAuth($appInfo, $appName, "http://localhost:8888/MediaVault/dropbox_finish.php", $csrfTokenStore);
$dbname = "Media_Vault_Schema";
$db = new PDO('mysql:host=localhost;dbname=Media_Vault_Schema', 'root', 'root');
$user = $db->prepare("SELECT * FROM user_id WHERE id = :user_id");
$user->execute(['user_id' => $_SESSION['user_id']]);
$user = $user->fetchObject();
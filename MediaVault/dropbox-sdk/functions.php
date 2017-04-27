<?php
function getUser($userId){
    $db = new PDO('mysql:host=localhost;dbname=Media_Vault_Schema', 'root', 'root');
    $user = $db->prepare("SELECT * FROM user_id WHERE id = :user_id");
    $user->execute(['user_id' => $userId]);
    $user = $user->fetchObject();
    return $user;
}
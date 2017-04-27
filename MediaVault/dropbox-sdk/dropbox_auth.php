<?php
ob_start();
if ($user->dropbox_token){
    $client = new Dropbox\Client($user->dropbox_token, $appName, 'UTF-8');
    $client->getAccountInfo();

}else{
    $authUrl = $webAuth->start();
    header("Location:" . $authUrl, true, 301);
    ob_end_flush();
    exit;
}
<?php
    error_reporting(E_ALL);

    ini_set("display_errors", 1);
    include 'dbmanager.php';
    $shortUrl = "http://localhost:8080/URL_Shortening_Project/".$_GET['code'];
    $ConnectUrl = new ConnectUrl($shortUrl);

    $ConnectUrl->searchOriginalUrl();
?>
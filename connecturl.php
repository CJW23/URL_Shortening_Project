<?php
    include 'dbmanager.php';
    $shortUrl = "http://localhost:8080/URL_Shortening_Project/".$_GET['code'];
    
    searchOriginalUrl($shortUrl);
?>
<?php
    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    include 'dbmanager.php';
    
    if(isset($_POST['input_url'])){
        $url = $_POST['input_url'];
        searchUrl($url);
        header("location: index.php");
    }
?>
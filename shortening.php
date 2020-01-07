<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include 'dbmanager.php';
    if(isset($_POST['input_url'])){
        $url = $_POST['input_url'];
        $shorteningDBManager = new ShorteningDBManager($url);
        
        if($shorteningDBManager->searchUrl() == false){
            $shorteningDBManager->convertUrl();
        } 

        header("location: index.php");
    }
?>
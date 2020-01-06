<?php
    $connection = mysqli_connect("localhost", "root", "awdsd123", "smilegate1");
    require 'vendor/autoload.php';
    use Base62\Base62;
    $base62 = new Base62();
    
    function searchUrl($url){
        global $connection;

        $query = "SELECT long_url, short_url FROM user WHERE long_url = '$url'";
        $result = mysqli_query($connection, $query);
        
        //등록되지 않은 url일 경우
        if(mysqli_num_rows($result) == 0){
            echo $url;
            $_SESSION['convertUrl'] = convertUrl($url);
        } else { //등록된 url인 경우        
            $_SESSION['convertUrl'] = mysqli_fetch_array($result)['short_url'];
        }
    }

    function convertUrl($url){
        global $connection;
        global $base62;

        $query = "SELECT MAX(id) as id FROM user";
        $result = mysqli_query($connection, $query);
        $shortUrl = "http://localhost:8080/URL_Shortening_Project/".$base62->encode(mysqli_fetch_array($result)['id'] + 1);     //url 축소

        registUrl($url, $shortUrl);     //축소 시킨 url DB에 저장
        
        return $shortUrl;
    }

    function registUrl($url, $shortUrl){
        global $connection;
        
        $query = "INSERT INTO user(long_url, short_url) VALUE ('$url', '$shortUrl')";
        mysqli_query($connection, $query);
    }

    function searchOriginalUrl($shortUrl){
        global $connection;

        $query = "SELECT long_url FROM user WHERE '$shortUrl' = short_url";
        $result = mysqli_query($connection, $query);
        
        if(mysqli_num_rows($result) == 0){
            header("locaton: index.php");
        } else {
            $url = mysqli_fetch_array($result)['long_url'];
            header("location: $url");
        }
    }
?>
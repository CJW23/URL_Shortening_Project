<?php
    require 'vendor/autoload.php';
    use Base62\Base62;
    session_start();
    
    class DBManager {
        protected $_connection;
        protected $_query;
        protected $_result;
        protected $_shortUrl;
        protected $_longUrl;

        public function __construct() {
            $this->_connection = mysqli_connect("localhost", "root", "awdsd123", "smilegate1");
        }
    }

    class ShorteningDBManager extends DBManager{
        //private $_base62;

        public function __construct($url){
            parent::__construct();
            echo "awdawdawdawdawdawdawd";
            $this->_longUrl = $url;
        }

        public function searchUrl(){
            $this->_query = "SELECT long_url, short_url FROM user WHERE long_url = '$this->_longUrl'";
            $this->_result = mysqli_query($this->_connection, $this->_query);
            
            //등록되지 않은 url일 경우
            if(mysqli_num_rows($this->_result) == 0){
                return false;
            } else { //등록된 url인 경우
                $_SESSION['convertUrl'] = mysqli_fetch_array($this->_result)['short_url'];
                return true;
            }
        }

        public function convertUrl(){
            $base62 = new Base62();
            $localUrl = "http://localhost:8080/URL_Shortening_Project/";
            $this->_query = "SELECT MAX(id) as id FROM user";
            $this->_result = mysqli_query($this->_connection, $this->_query);
            $this->_shortUrl = $base62->encode(mysqli_fetch_array($this->_result)['id'] + 1);     //url 축소
            
            for($i = 0; $i < $this->checkUrlLength(); $i++) {
                $localUrl .= '0';
            }
            $this->_shortUrl = $localUrl.$this->_shortUrl;
            $_SESSION['convertUrl'] = $this->_shortUrl;
            $this->_registUrl();     //축소 시킨 url DB에 저장
            
            return $this->_shortUrl;
        }
        
        private function checkUrlLength() {
            return 8 - strlen($this->_shortUrl);
        }
        private function _registUrl(){
            $this->_query = "INSERT INTO user(long_url, short_url) VALUE ('$this->_longUrl', '$this->_shortUrl')";
            mysqli_query($this->_connection, $this->_query);
        }
    }

    class ConnectUrl extends DBManager{
        public function __construct($shortUrl) {
            parent::__construct();
            $this->_shortUrl = $shortUrl;
        }

        public function searchOriginalUrl(){
            $this->_query = "SELECT long_url FROM user WHERE '$this->_shortUrl' = short_url";
            $this->_result = mysqli_query($this->_connection, $this->_query);
            
            if(mysqli_num_rows($this->_result) == 0){
                header("locaton: index.php");
            } else {
                $url = mysqli_fetch_array($this->_result)['long_url'];
                header("location: $url");
            }
        }
    }
?>
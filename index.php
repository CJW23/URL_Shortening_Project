<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
        if(isset($_SESSION['convertUrl'])){
            echo "<a href='{$_SESSION['convertUrl']}'>{$_SESSION['convertUrl']}</a>";
            unset($_SESSION['convertUrl']);
        }
    ?>
    <form action="shortening.php" method="post">
        <p><input type="text" name="input_url" placeholder="Enter URL" style="width:500px; height:30px; font-size:20px"></p>
        <p><input type="submit"></p>
    </form>
</body>
</html>
<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="design.css">
</head>
<body>
    <form action=""></form>
    <div class="container">
        <div class="container__item">
            <form action="shortening.php" method="post" class="form">
                <input type="text" name="input_url" class="form__field" placeholder="Enter URL" />
                <input type="submit" class="btn btn--primary btn--inside uppercase" />
            </form>
        </div>
	
        <div class="container__item container__item--bottom">
            <?php
                if(isset($_SESSION['convertUrl'])){
                    echo "<p>URL is <a href='{$_SESSION['convertUrl']}'>{$_SESSION['convertUrl']}</a></p>";
                    unset($_SESSION['convertUrl']);
                }
            ?>
        </div>
    </div>

</body>
</html>
<?php
    require 'vendor/autoload.php';
    use Base62\Base62;

    $base62 = new Base62();
    echo $base62->encode(0000);
?>
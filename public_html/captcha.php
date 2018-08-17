<?php
session_start();
function randomText($length) {
    $pattern = "123456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
    for($i=0;$i<$length;$i++) {
      $key .= $pattern{mt_rand(1, 33)};
    }
    return $key;
}

$_SESSION['tmptxt'] = randomText(5);
$captcha = imagecreatefromgif("css/images/bgcaptcha.gif");
$colText = imagecolorallocate($captcha, 0, 0, 102);
imagestring($captcha, 7, 53, 4, $_SESSION['tmptxt'], $colText);

header("Content-type: image/gif");
imagegif($captcha);
?>
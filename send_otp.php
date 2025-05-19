<?php
$otp=$_SESSION['otp'];
$expiry=$_SESSION['expiry'];
if ($_POST['OTP']!=$otp)
{
    alert("Invalid OTP");
    die();
}
if (time() > $expiry) {
    alert("OTP expired");
    die();
}
header("Location: MainPage.html");
?>
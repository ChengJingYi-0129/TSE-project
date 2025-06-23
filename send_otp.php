<?php
session_start();
$otp=$_SESSION['otp'];
$expiry=$_SESSION['expiry'];
if ($_POST['OTP']!=$otp)
{
    echo "<script>alert('Invalid OTP'); window.history.back();</script>";
    die();
}
if (time() > $expiry) {
    echo "<script>alert('OTP expired'); window.history.back();</script>";
    die();
}
header("Location: Enrollment.html");
exit();
?>
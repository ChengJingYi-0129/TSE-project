<?php
if (isset($_POST['email']) && isset($_POST['otp']) && isset($_POST['expiry'])) {
    $to = $_POST['email'];
    $subject = "CLiC OTP";
    $otp = $_POST['otp'];
    $expiry = $_POST['expiry'];
    $message = "Your OTP is: $otp. Valid 10 minutes until $expiry";
    $headers = "From: noreply@mmu.edu.my\r\n";
    if (mail($to, $subject, $message, $headers)) {
        echo "sent";
    } else {
        echo "mail_failed";
    }
} else {
    echo "error";
}
?>
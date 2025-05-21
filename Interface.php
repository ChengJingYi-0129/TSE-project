<?php
$servername="localhost";
$username="root";
$password="";
$dbname="tse_project";
$ID=$_POST['userID'];
$Password=$_POST['password'];
$connection=new mysqli($servername,$username,$password,$dbname);
if($connection->connect_error){
    die("Connection failed: ".$connection->connect_error);
}
$query=$connection->prepare("SELECT * FROM student_info WHERE Student_ID= ? AND Student_Password=?");
$query->bind_param("ss",$ID,$Password);
$query->execute();
$result=$query->get_result();

$query=$connection->prepare("SELECT Student_Name FROM student_info WHERE Student_ID= ? AND Student_Password=?");
$query->bind_param("ss",$ID,$Password);
$query->execute();
$name=$query->get_result();
$row = $name->fetch_assoc();
$studentName = $row['Student_Name'];
#close the database
$query->close();
$connection->close();
if($result->num_rows<=0){
    alert("Invalid ID or Password");
    $query->close();
    $connection->close();
    exit();    
}
?>

<?php
session_start();
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create a new PHPMailer instance
$mail = new PHPMailer(true);
$otp=rand(100000,999999);
$_SESSION['otp']=$otp;
$expiry=time()+60*10;
$_SESSION['expiry']=$expiry;
$to = $ID."@student.mmu.edu.my";
$subject = "CLiC OTP";
$message = "Your OTP is: $otp. Valid 10 minutes until ".date("Y-m-d H:i:s", $expiry);

try {
    //Server settings
    $mail->isSMTP();                          // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';     // Gmail SMTP server
    $mail->SMTPAuth   = true;                 // Enable SMTP authentication
    $mail->Username   = 'fernandopikachu156@gmail.com';    // Your Gmail address
    $mail->Password   = 'zwiukklsktbvpfyg';       // App password (not Gmail password)
    $mail->SMTPSecure = 'tls';                // Enable TLS encryption
    $mail->Port       = 587;                  // TCP port to connect to

    //Recipients
    $mail->setFrom('fernandopikachu156@gmail.com', 'Fernando');
    $mail->addAddress($to, $studentName);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();
    header("Location: interface2.html");
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
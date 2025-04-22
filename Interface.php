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

if($result->num_rows>0){
    header("Location: interface2.html");
    $query->close();
    $connection->close();
    exit();
}
else{
    echo "<script>alert('Invalid ID or Password');</script>";
    header("Location: Interface.html");
    $query->close();
    $connection->close();
    exit();
}

?>
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="tse_project";
$connection=new mysqli($servername,$username,$password,$dbname);
if($connection->connect_error){
    die("Connection failed: ".$connection->connect_error);
}
$query=$connection->prepare("SELECT * FROM subject");
$query->execute();
$result=$query->get_result();
$subject = array();

echo json_encode($result->fetch_all(MYSQLI_ASSOC));
$connection->close();
?>
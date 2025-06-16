<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tse_project";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Prepare the query
$query = $connection->prepare("
    SELECT subject.Subject_Code, subject.Subject_Name, subject.Subject_Credit_Hours,
           schedule.Day_Of_Week, schedule.Start_Time, schedule.End_Time
    FROM subject 
    LEFT JOIN schedule ON schedule.Subject_Code = subject.Subject_Code
    UNION
    SELECT subject.Subject_Code, subject.Subject_Name, subject.Subject_Credit_Hours,
           schedule.Day_Of_Week, schedule.Start_Time, schedule.End_Time
    FROM subject 
    RIGHT JOIN schedule ON schedule.Subject_Code = subject.Subject_Code
");
$query->execute();

// Get the result of the query
$result = $query->get_result();

// Output the data as JSON
echo json_encode($result->fetch_all(MYSQLI_ASSOC));

// Close connection
$connection->close();
?>

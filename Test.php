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
$query = $connection->prepare("SELECT * FROM subject");
$query->execute();

// Get the result of the query
$result = $query->get_result();

// Output the data as JSON
echo json_encode($result->fetch_all(MYSQLI_ASSOC));

// Close connection
$connection->close();
?>

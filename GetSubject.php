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

// Query all subjects and their schedules
$sql = "
    SELECT subject.Subject_Code, subject.Subject_Name, subject.Subject_Credit_Hours,
           schedule.Day_Of_Week, schedule.Start_Time, schedule.End_Time
    FROM subject
    LEFT JOIN schedule ON schedule.Subject_Code = subject.Subject_Code
    ORDER BY subject.Subject_Code
";
$result = $connection->query($sql);

$subjects = [];
while ($row = $result->fetch_assoc()) {
    $code = $row['Subject_Code'];
    if (!isset($subjects[$code])) {
        $subjects[$code] = [
            'Subject_Code' => $row['Subject_Code'],
            'Subject_Name' => $row['Subject_Name'],
            'Subject_Credit_Hours' => $row['Subject_Credit_Hours'],
            'Days_Of_Week' => [],
            'Start_Times' => [],
            'End_Times' => []
        ];
    }
    if ($row['Day_Of_Week'] !== null) {
        $subjects[$code]['Days_Of_Week'][] = $row['Day_Of_Week'];
        $subjects[$code]['Start_Times'][] = $row['Start_Time'];
        $subjects[$code]['End_Times'][] = $row['End_Time'];
    }
}

// Re-index array for JSON output
echo json_encode(array_values($subjects));

$connection->close();
?>
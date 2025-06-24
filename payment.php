<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
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

$student_id = $_POST['ID'];
$amount = isset($_POST['total']) ? $_POST['total'] : 0;
$method = $_POST['method'];
$payment_date = date('Y-m-d');
$invoice_number = 'INV' . time() . rand(100,999);
$status = 'Paid';

$stmt = $connection->prepare("INSERT INTO payment (payment_date, invoice_number, status, student_id, amount, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssds", $payment_date, $invoice_number, $status, $student_id, $amount, $method);

if ($stmt->execute()) {
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();

//executes another action
function getSemesterInfo($date) {
    // Define semester periods
    $semesters = [
        1 => ['start' => '2025-02-04', 'end' => '2025-04-12'],
        2 => ['start' => '2025-06-24', 'end' => '2025-08-23'],
        3 => ['start' => '2025-09-28', 'end' => '2025-11-16'],
    ];
    foreach ($semesters as $id => $period) {
        if ($date >= $period['start'] && $date <= $period['end']) {
            return [
                'semester_id' => $id,
                'registration_start' => $period['start'],
                'registration_end' => $period['end'],
            ];
        }
    }
    // Default to semester 1 if not found
    return [
        'semester_id' => 1,
        'registration_start' => $semesters[1]['start'],
        'registration_end' => $semesters[1]['end'],
    ];
}

$allSubjectCodes = isset($_POST['allSubjectCodes']) ? $_POST['allSubjectCodes'] : '';
$subjectCodesArray = array_filter(array_map('trim', explode(',', $allSubjectCodes)));

$semesterInfo = getSemesterInfo($payment_date);
$semester_id = $semesterInfo['semester_id'];
$registration_start = $semesterInfo['registration_start'];
$registration_end = $semesterInfo['registration_end'];

foreach ($subjectCodesArray as $subjectCode) {
    $stmt = $connection->prepare("INSERT INTO enrollment (semester_id, enrollment_date, registration_start, registration_end, Subject_Code, student_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $semester_id, $payment_date, $registration_start, $registration_end, $subjectCode, $student_id);
    $stmt->execute();
    $stmt->close();
}
$connection->close();

header("Location: MainPage.html");
?>
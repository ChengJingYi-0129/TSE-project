<?php
include('includes/dbconnection.php');

if (isset($_GET['subject_code'])) {
    $subject_code = $_GET['subject_code'];

    $stmt = $dbh->prepare("SELECT schedule_id, day_of_week, start_time, end_time, location 
                           FROM schedule 
                           WHERE Subject_Code = :code");
    $stmt->bindParam(':code', $subject_code, PDO::PARAM_STR);
    $stmt->execute();
    $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($schedules) {
        foreach ($schedules as $sc) {
            $display = "ID: {$sc['schedule_id']} | {$sc['day_of_week']} {$sc['start_time']} - {$sc['end_time']} @ {$sc['location']}";
            echo "<option value='{$sc['schedule_id']}'>" . htmlentities($display) . "</option>";
        }
    } else {
        echo "<option value=''>No schedules found for this subject</option>";
    }
} else {
    echo "<option value=''>Invalid request</option>";
}
?>

<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];

    foreach ($_POST['target_score'] as $targetId => $target_score) {
        // Update the target_score column for each target
        $updateQuery = "UPDATE work_plan SET target_score = '$target_score' WHERE id = $targetId";
        $conn->query($updateQuery);
    }

    // Calculate overall score
    $target_scores = $_POST['target_score'];
    $overallScore = array_sum($target_scores) / count($target_scores);

    // Update the overall_score column in the work_plan table
    $updateOverallScoreQuery = "UPDATE work_plan SET overall_score = '$overallScore' WHERE employee_id = $employee_id";
    $conn->query($updateOverallScoreQuery);


    // Fetch the details of the just rated employee
    $employeeQuery = $conn->query("SELECT e.id, concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as name, concat(s.lastname, ', ', s.firstname, ' ', s.middlename) as supervisor_name, w.overall_score FROM work_plan w INNER JOIN employee_list e ON e.id = w.employee_id INNER JOIN employee_list s ON s.id = w.supervisor_id WHERE w.employee_id = $employee_id");
    $employeeData = $employeeQuery->fetch_assoc();

    // Redirect to the page that displays the employee details
    header("Location: target_rating_results.php?id=" . $employeeData['id']);
    exit();
} else {
    echo "<script>alert('Failed to save data')</script>";
}

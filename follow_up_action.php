<?php
include 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $employee_id = $_POST['employee_id'];
    $supervisor_id = $_POST['supervisor_id'];
    $action_comment = $_POST['action_comment'];
    $j_title_id = $_POST['j_title_id'];
    $sign = $_POST['sign'];
    $date = $_POST['date'];

    // Insert the form data into the follow_up_action table
    $query = "INSERT INTO follow_up_action (employee_id, supervisor_id, action_comment, j_title_id, sign, date) 
              VALUES ('$employee_id', '$supervisor_id', '$action_comment', '$j_title_id', '$sign', '$date')";

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Successfully Saved!'); window.location='index.php?page=annual_performance_appraisal'</script>";
    } else {
        echo "<script>alert('Failed to save data')</script>";
    }
}

<?php
include 'db_connect.php';

function saveWorkPlan($conn, $employee_id, $supervisor_id, $start_date, $end_date, $kra_name, $p_accountability, $targets, $activ_schedule)
{
    // Prepare the SQL statement
    $completed = "";
    $status = "";
    $date_created = "";
    $stmt = $conn->prepare("INSERT INTO work_plan (employee_id, supervisor_id, start_date, end_date, kra_name, p_accountability, targets, activ_schedule, completed, status, date_created) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssss", $employee_id, $supervisor_id, $start_date, $end_date, $kra_name, $p_accountability, $targets, $activ_schedule, $completed, $status, $date_created);


    // Execute the statement
    if ($stmt->execute()) {
        return true; // Data successfully saved
    } else {
        return false; // Failed to save data
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
    $supervisor_id = isset($_POST['supervisor_id']) ? $_POST['supervisor_id'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
    $kra_name = isset($_POST['kra_name']) ? $_POST['kra_name'] : '';
    $p_accountability = isset($_POST['p_accountability']) ? $_POST['p_accountability'] : '';
    $targets = isset($_POST['targets']) ? $_POST['targets'] : '';
    $activ_schedule = isset($_POST['activ_schedule']) ? $_POST['activ_schedule'] : '';

    // Call the function to save the work plan
    if (saveWorkPlan($conn, $employee_id, $supervisor_id, $start_date, $end_date, $kra_name, $p_accountability, $targets, $activ_schedule)) {
        echo "<script>alert('Successfully Saved!'); window.location='index.php?page=work_plan_list'</script>";
    } else {
        echo "<script>alert('Failed to save data')</script>";
    }
}

$conn->close();

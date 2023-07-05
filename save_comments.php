<?php
include 'db_connect.php';

// Assuming you have the current logged-in user's ID stored in a variable called $user_id


// Process the form data
$supervisor_id = $_POST['supervisor_id'];
$employee_id = $_POST['employee_id'];
$app_achieved = $_POST['app_achieved'];
$app_not_achieved = $_POST['app_not_achieved'];
$sign_1 = $_POST['sign_1'];
$date1 = $_POST['date1'];
$sup_achieved = $_POST['sup_achieved'];
$sup_not_achieved = $_POST['sup_not_achieved'];
$sign_2 = $_POST['sign_2'];
$date2 = $_POST['date2'];
$ministrial_contribution = $_POST['ministrial_contribution'];
$sign_3 = $_POST['sign_3'];
$date3 = $_POST['date3'];

// Prepare the SQL statement
$sql = "INSERT INTO score_comments (employee_id, supervisor_id, app_achieved, app_not_achieved, sign_1, date1, sup_achieved, sup_not_achieved, sign_2, date2, ministrial_contribution, sign_3, date3)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind the parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssssssssss", $employee_id, $supervisor_id, $app_achieved, $app_not_achieved, $sign_1, $date1, $sup_achieved, $sup_not_achieved, $sign_2, $date2, $ministrial_contribution, $sign_3, $date3);

// Execute the statement
if ($stmt->execute()) {
    // Successful execution
    $response = "<script>alert('Successfully Saved!'); window.location='index.php?page=annual_performance_appraisal'</script>";
} else {
    // Error in execution
    $response = "Error: " . $stmt->error;
}

// Close the statement and the database connection
$stmt->close();
$conn->close();

// Return the response
echo $response;

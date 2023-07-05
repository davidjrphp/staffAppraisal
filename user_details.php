<?php
include 'db_connect.php';
// Fetch user details based on the logged-in user ID
 // Assuming the logged-in user ID is stored in a session variable
$userId = $_SESSION['login_id'];
// Fetch user details
$sql = "SELECT * FROM users WHERE id = $userId";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $userRow = $result->fetch_assoc();

    // Fetch supervisor details
    $supervisorId = $userRow['id'];
    $sql = "SELECT * FROM supervisor_list WHERE id = $supervisorId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $supervisorRow = $result->fetch_assoc();

        // Fetch employee details
        $employeeId = $userRow['id'];
        $sql = "SELECT * FROM employee_list WHERE id = $employeeId";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $employeeRow = $result->fetch_assoc();

            // Fetch work plan period
            $sql = "SELECT start_date, end_date FROM work_plan WHERE employee_id = $employeeId";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                $workPlanRow = $result->fetch_assoc();
                
            } else {
                echo "Failed to fetch work plan period.";
            }
        } else {
            echo "Failed to fetch employee details.";
        }
    } else {
        echo "Failed to fetch supervisor details.";
    }
} else {
    echo "Failed to fetch user details.";
}


        <?php
        include 'db_connect.php';
        // Assuming you have the current logged-in user's ID stored in a variable called $user_id

        $i = 1;
        $where = "";
        if ($_SESSION['login_type'] == 0)
            $where = " where w.employee_id = '{$_SESSION['login_id']}' ";
        elseif ($_SESSION['login_type'] == 1)
            $where = " where e.supervisor_id = {$_SESSION['login_id']} ";

        // Query to fetch the job title based on the j_title_id of the current logged-in user
        $query = "SELECT j_purpose FROM job_description WHERE job_id IN (
    SELECT j_title_id FROM users WHERE id = '{$_SESSION['login_id']}'
    UNION
    SELECT j_title_id FROM employee_list WHERE id = '{$_SESSION['login_id']}'
    UNION
    SELECT j_title_id FROM supervisor_list WHERE id = '{$_SESSION['login_id']}'
)";

        $result = $conn->query($query);

        // Check if the query was successful
        if ($result) {
            // Fetch the job title from the result
            $row = $result->fetch_assoc();
            $job_purpose = $row['j_purpose'];

            // Display the job title
            echo "<h5>Current Job Title: $job_purpose </h5>";
        } else {
            echo "Failed to fetch job title: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
        ?>
   
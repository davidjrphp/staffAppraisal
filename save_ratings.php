
<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['employee_id']) && isset($_POST['scores'])) {
        // Sanitize and validate data (you may need to implement this)
        $employee_id = $_POST['employee_id'];
        $scores = $_POST['scores'];

        // Ensure that scores is an array
        if (!is_array($scores)) {
            $scores = array($scores); // Convert to an array
        }

        // Get the target IDs from the work_plan table for the selected employee
        $stmt = $conn->prepare("SELECT targets FROM work_plan WHERE employee_id = ?");
        $stmt->bind_param("i", $employee_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $target_ids = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        // Validate the number of target IDs and scores
        if (count($target_ids) !== count($scores)) {
            // Handle the validation error (e.g., display an error message)
            echo "Invalid number of target IDs or scores";
            exit;
        }

        // Insert the individual target ratings into the apas_rating table
        $stmt = $conn->prepare("INSERT INTO apas_rating (target_id, scores) VALUES (?, ?)");

        // Bind parameters and execute for individual target ratings
        for ($i = 0; $i < count($target_ids); $i++) {
            $target_id = $target_ids[$i]['id'];
            $score = $scores[$i];

            $stmt->bind_param("ii", $target_id, $score);
            $stmt->execute();
        }

        // Close the statement
        $stmt->close();

        // Redirect or display a success message
        header("Location: ratings.php");
        exit();
    }
}

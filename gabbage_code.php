<?php
// ...

$qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM employee_list order by concat(lastname,', ',firstname,' ',middlename) asc");
while ($row = $qry->fetch_assoc()) :
?>
    <tr>
        <!-- ... -->
        <td class="text-center">
            <div class="dropdown">
                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    Action
                </button>
                <div class="dropdown-menu" style="">
                    <a class="dropdown-item view_employee" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
                    <a class="dropdown-item rate_employee" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Rate</a> <!-- Added rating option -->
                    <div class="dropdown-divider"></div>
                    <?php if ($_SESSION['login_type'] == 2) : ?>
                        <a class="dropdown-item" href="./index.php?page=edit_employee&id=<?php echo $row['id'] ?>">Edit</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item delete_employee" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                    <?php endif; ?>
                </div>
            </div>
        </td>
    </tr>
<?php endwhile; ?>

<!-- ... -->

<script>
    $(document).ready(function() {
        // ...
        $('.rate_employee').click(function() {
            var employee_id = $(this).attr('data-id');
            // You can perform further actions here, such as opening a modal or redirecting to a rating page
            // Example: Open a modal with the rating form
            openRatingModal(employee_id);
        });
    });

    function openRatingModal(employee_id) {
        // Implement your logic to open the rating modal and display the rating form
        // You can use JavaScript, jQuery, or a UI library of your choice
        // Example: Using Bootstrap modal
        // You can customize the modal HTML structure and add the rating form inside it
        var modalHtml = `
            <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ratingModalLabel">Rate Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Add your rating form here -->
                            <!-- You can use HTML and PHP to generate the form dynamically -->
                            <form method="POST" action="save_ratings.php">
                                <!-- Display the employee name and other details if needed -->
                                <h4>Employee ID: <?php echo $employee_id; ?></h4>
                                <!-- Add rating fields for each target/KRA -->
                                <!-- ... -->
                                <input type="submit" value="Submit Ratings">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Append the modal HTML to the body and show the modal
        $('body').append(modalHtml);
        $('#ratingModal').modal('show');
    }
</script>






<!-- Step 2 and 3: Rating form for individual targets -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employee_id'])) {
    $employee_id = $_POST['employee_id'];

    // Retrieve the targets/KRAs for the selected employee from the work_plan table
    $work_plan = $conn->query("SELECT kra_name, targets FROM work_plan WHERE employee_id = $employee_id");

    // Display the rating form for each target/KRA
    echo "<form method=\"POST\" action=\"save_ratings.php\">";
    while ($row = $work_plan->fetch_assoc()) {
        echo "<label for=\"target_{$row['kra_name']}\">{$row['kra_name']}:</label>";
        echo "<input type=\"number\" name=\"scores[]\" id=\"target_{$row['kra_name']}\" required>";
        echo "<br>";
    }
    echo "<input type=\"number\" name=\"overall_score\" required placeholder=\"Overall Score\">";
    echo "<br>";
    echo "<input type=\"hidden\" name=\"employee_id\" value=\"$employee_id\">";
    echo "<input type=\"submit\" value=\"Submit Ratings\">";
    echo "</form>";
}
?>

<!-- Step 4 and 5: Save the ratings to the apas_rating table (save_ratings.php) -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employee_id'], $_POST['scores'], $_POST['overall_score'])) {
    $employee_id = $_POST['employee_id'];
    $scores = $_POST['scores'];
    $overall_score = $_POST['overall_score'];

    // Calculate the overall rating
    $num_targets = count($scores);
    $total_rating = array_sum($scores);
    $overall_rating = $total_rating / $num_targets;

    // Save the individual target ratings and overall rating to the apas_rating table
    $stmt = $conn->prepare("INSERT INTO apas_rating (employee_id, target_rating, overall_rating) VALUES (?, ?, ?)");
    foreach ($scores as $score) {
        $stmt->bind_param("iii", $employee_id, $score, $overall_rating);
        $stmt->execute();
    }
    $stmt->close();

    // Redirect or display a success message
    header("Location: success.php");
    exit();
}
?>



<?php
// Save Ratings

include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['overall_score']) && isset($_POST['scores'])) {
        // Sanitize and validate data (you may need to implement this)
        $overall_score = $_POST['overall_score'];
        $scores = $_POST['scores'];

        // Ensure that scores is an array
        if (!is_array($scores)) {
            $scores = array($scores); // Convert to an array
        }

        // Calculate the number of targets
        $num_targets = count($scores);

        // Calculate the total rating
        $total_rating = array_sum($scores);

        // Insert the overall rating and individual target ratings into the database
        $sql = "INSERT INTO apas_rating (overall_score, scores) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute for individual target ratings
        foreach ($scores as $score) {
            $stmt->bind_param("ii", $score, $score);
            $stmt->execute();
        }

        // Calculate the overall rating
        $overall_rating = $total_rating / $num_targets;

        // Bind parameters and execute for overall rating
        $stmt->bind_param("ii", $overall_score, $overall_rating);
        $stmt->execute();

        // Close the statement
        $stmt->close();

        // Redirect or display a success message
        //header("Location: annual_performance_appraisal.php");
        //exit();
    }
}

<div class="col-lg-12">
    <div class="card">
        <div class="card-header" id="heading3">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    PART 3: RATINGS
                </button>
            </h5>
        </div>
        <div class="card-body">
            <h6>2.3 Target set during the appraisal period and the rating.</h6>
            <h6><i>(The Appraisee completes the first two columns for KRA and Targets, as agreed with the Supervisor while the rating is to be completed by the Supervisor using the key* below)</i></h6>
            <hr>

            <form action="save_ratings.php" id="manage_ratings" method="POST">
                <table class="table table-hover table-condensed" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Key Result Area</th>
                            <th>Targets</th>
                            <th>Ratings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connect.php';

                        if (isset($_GET['id'])) {
                            $employee_id = $_GET['id'];

                            // Fetch the data from the work_plan table for the selected employee
                            $qry = $conn->query("SELECT w.*, concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as name FROM work_plan w INNER JOIN employee_list e ON e.id = w.employee_id WHERE w.employee_id = " . $employee_id);
                            $rows = $qry->fetch_all(MYSQLI_ASSOC);

                            $i = 1;
                            foreach ($rows as $row) {
                                $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                                unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                                $kra = strtr(html_entity_decode($row['kra_name']), $trans);
                                $kra = str_replace(array("<li>", "</li>"), array("", ", "), $kra);
                                $targets = strtr(html_entity_decode($row['targets']), $trans);
                                $targets = str_replace(array("<li>", "</li>"), array("", ", "), $targets);
                                $score = strtr(html_entity_decode($row['activ_schedule']), $trans);
                                $score = str_replace(array("<li>", "</li>"), array("", ", "), $score);

                                // Fetch the recent rating for the target
                                $targetId = $row['id']; // Assuming the target ID column name is 'id' in the work_plan table
                                $recentRatingQuery = $conn->query("SELECT target_score FROM work_plan WHERE employee_id = $targetId ");
                                $recentRating = $recentRatingQuery->fetch_assoc();
                                $target_score = isset($recentRating['target_score']) ? $recentRating['target_score'] : '';
                        ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td>
                                        <p class="truncate"><b><?php echo strip_tags($kra) ?></b></p>
                                    </td>
                                    <td>
                                        <p class="truncate"><?php echo strip_tags($targets) ?></p>
                                    </td>
                                    <td>
                                        <input type="hidden" name="employee_id" value="<?php echo isset($employee_id) ? $employee_id : '' ?>">
                                        <?php if ($_SESSION['login_type'] != 0) { ?>
                                            <input class="form-control form-control-sm target_score" style="width: 65px; height: 55px;" name="target_score[<?php echo $targetId ?>]" type="number" value="<?php echo isset($target_score) ? $target_score : '' ?>" id="target_score_<?php echo $i ?>">

                                        <?php } else { ?>
                                            <input class="form-control form-control-sm target_score" style="width: 65px; height: 55px;" name="target_score[<?php echo $targetId ?>]" type="number" value="<?php echo isset($target_score) ? $target_score : '' ?>" id="target_score_<?php echo $i ?>">

                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
                <hr>
                <div class="center">
                    <h6>KEY: Above Target = 3 On Target = 2 Below Target = 1<br> Overall Target Rating** =
                        <input class="form-control form-control-sm" style="width: 65px; height: 55px" name="overall_score" id="overall_score" readonly>
                    </h6>
                    <h6><i>**Overall rating is the total rating divided by the number of targets</i></h6>
                </div>
                <div class="col-lg-12 text-right justify-content-center d-flex">
                    <button type="submit" class="btn btn-primary mr-2" id="save_button">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#list').dataTable();

        // Calculate overall rating
        function calculateOverallRating() {
            var targetCount = $('.target_score').length; // Number of targets
            var totalRating = 0;

            // Loop through each target rating input field and sum the ratings
            $('.target_score').each(function() {
                var rating = parseInt($(this).val());
                totalRating += rating;
            });

            // Calculate the overall rating by dividing the total rating by the number of targets
            var overallRating = totalRating / targetCount;

            // Set the value of the overall rating input field
            $('#overall_score').val(overallRating);
        }

        // Call the calculateOverallRating function initially and whenever a target rating is changed
        calculateOverallRating();

        $('.target_score').on('input', function() {
            calculateOverallRating();
        });
    });
</script>
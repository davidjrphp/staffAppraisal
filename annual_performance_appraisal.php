<div id="accordion">
    <!-- State 1 -->
    <div class="card">
        <?php if (isset($_SESSION['login_id'])) : ?>
            <div class="card-header" id="heading1">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        <h5>PART 1: PERSONAL PARTICULARS</h5>
                    </button>
                </h5>
            </div>
        <?php endif; ?>
        <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordion">
            <?php include 'db_connect.php' ?>
            <?php
            $j_title_id = 0;
            $department_id = 0;
            $supervisor_id = 0;
            $staff_no = 0;
            if (isset($_SESSION['login_id'])) {
                $qry = $conn->query("SELECT e.*, concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as name, s.lastname, s.firstname
                                    FROM employee_list e
                                    LEFT JOIN supervisor_list s ON e.supervisor_id = s.id
                                    WHERE e.id = " . $_SESSION['login_id'])->fetch_array();
                if ($qry) {
                    foreach ($qry as $k => $v) {
                        $$k = $v;
                    }
                }

                $j_title = $conn->query("SELECT * FROM job_description where job_id = $j_title_id ");
                $j_title = $j_title->num_rows > 0 ? $j_title->fetch_array()['j_title'] : 'Unknown Job Description';
                $salary_scale = $conn->query("SELECT * FROM job_description where job_id = $j_title_id ");
                $salary_scale = $salary_scale->num_rows > 0 ? $salary_scale->fetch_array()['salary_scale'] : 'Unknown Job Salary Scale';
                $department = $conn->query("SELECT * FROM department_list where id = $department_id ");
                $department = $department->num_rows > 0 ? $department->fetch_array()['department'] : 'Unknown Department';
                $supervisor = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM supervisor_list where id = $supervisor_id ");
                $supervisor = $supervisor->num_rows > 0 ? $supervisor->fetch_array()['name'] : 'Unknown supervisor';
            }
            ?>
            <div class="card-body">
                <h6><i>(to be completed by the Appraisee but initiated by Human Resources and Administration Department)</i></h6>
                <!-- State 1 Form -->
                <form action="" method="POST">
                    <!-- Form fields for State 1 -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5><b>WORK PLAN PERIOD:</b></h5>
                            <p></p>
                        </div>
                        <div class="col-md-6">
                            <h5><b>STAFF NO:</b></h5>
                            <p><?php echo ucwords($_SESSION['login_staff_no']) ?></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5><b>SURNAME:</b></h5>
                            <p><?php echo ucwords($_SESSION['login_firstname']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5><b>OTHER NAMES:</b></h5>
                            <p><?php echo ucwords($_SESSION['login_lastname']) ?></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5><b>JOB TITLE:</b></h5>
                            <p><?php echo $j_title ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5><b>SALARY SCALE:</b></h5>
                            <p><?php echo $salary_scale ?></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5><b>DATE OF APPOINTMENT TO PRESENT POST:</b></h5>
                            <p><?php echo ucwords($_SESSION['login_date_created']) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5><b>MINISTRY/PROVINCE:</b></h5>
                            <p><?php echo ucwords($_SESSION['login_ministry']) ?></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5><b>DEPARTMENT:</b></h5>
                            <p><?php echo $department ?> </p>
                        </div>
                        <div class="col-md-6">
                            <h5><b>STATION:</b></h5>
                            <p><?php echo ucwords($_SESSION['login_station']) ?></p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- State 2 -->
    <div class="card">
        <div class="card-header" id="heading2">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                    <h5>PART 2: WORK PLAN AND PERFORMANCE</h5>
                </button>
            </h5>
        </div>

        <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordion">

            <?php include 'db_connect.php' ?>
            <?php
            if (isset($_SESSION['login_id'])) {
                $qry = $conn->query("SELECT e.*, concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as name, s.lastname, s.firstname
                FROM employee_list e
                LEFT JOIN supervisor_list s ON e.supervisor_id = s.id
                WHERE e.id = " . $_SESSION['login_id'])->fetch_array();
                if ($qry) {
                    foreach ($qry as $k => $v) {
                        $$k = $v;
                    }
                }
                $j_title = $conn->query("SELECT * FROM job_description where job_id = $j_title_id ");
                $j_title = $j_title->num_rows > 0 ? $j_title->fetch_array()['j_title'] : 'Unknown Job Description';
                $department = $conn->query("SELECT * FROM department_list where id = $department_id ");
                $department = $department->num_rows > 0 ? $department->fetch_array()['department'] : 'Unknown Department';
                $supervisor = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM supervisor_list where id = $supervisor_id ");
                $supervisor = $supervisor->num_rows > 0 ? $supervisor->fetch_array()['name'] : 'Unknown supervisor';
            }
            ?>

            <div class="card-body">
                <h6><i>(to be completed by the Appraisee and Supervisor or as indicated)</i></h6>
                <br>
                <h6>2.1 Purpose of the Job</h6>
                <h6><i>(to be completed by the Appraisee)</i></h6>
                <h5><?php echo $j_title ?></h5>
                <br>
                <h6>2.2 Key Result Area and principle Accountability</h6>
                <h6><i>(to be completed by the Appraisee)</i></h6>

                <!-- Job Title Display -->
                <div id="jobTitleDisplay"></div>

                <!-- State 2 Table -->
                <table class="table tabe-hover table-condensed" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Key Result Area</th>
                            <th>Principal Acc.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $where = "";
                        if ($_SESSION['login_type'] == 0) {
                            $where = " WHERE w.employee_id = '{$_SESSION['login_id']}' ";
                        } elseif ($_SESSION['login_type'] == 1) {
                            $where = " WHERE e.supervisor_id = {$_SESSION['login_id']} ";
                        } elseif ($_SESSION['login_type'] == 2) {
                            $where = " WHERE w.user_id = {$_SESSION['login_id']} ";
                        }

                        $qry = $conn->query("SELECT * FROM work_plan WHERE employee_id = '{$_SESSION['login_id']}'");
                        //$qry = $conn->query("SELECT w.*, concat(e.lastname,', ',e.firstname,' ',e.middlename) as name FROM work_plan w INNER JOIN employee_list e ON e.id = w.employee_id $where ORDER BY UNIX_TIMESTAMP(w.date_created) ASC");
                        while ($row = $qry->fetch_assoc()) {
                            $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                            unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                            $kra = strtr(html_entity_decode($row['kra_name']), $trans);
                            $kra = str_replace(array("<li>", "</li>"), array("", ", "), $kra);
                            $p_acc = strtr(html_entity_decode($row['p_accountability']), $trans);
                            $p_acc = str_replace(array("<li>", "</li>"), array("", ", "), $p_acc);
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++ ?></td>
                                <td>
                                    <p class="truncate"><b><?php echo strip_tags($kra) ?></b></p>
                                </td>
                                <td>
                                    <p class="truncate"><?php echo strip_tags($p_acc) ?></p>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- AJAX to fetch job title -->
    <script>
        $(document).ready(function() {
            $('#list').dataTable()
            //var userId = '<?php //echo $_SESSION['login_type']; 
                            ?>';

            $.ajax({
                url: 'job_title.php?action=getJobTitle',
                method: 'POST',
                data: {
                    userId: $userId
                },
                success: function(response) {
                    $('#jobTitleDisplay').html(response);
                }
            });
        });
    </script>

    <div class="accordion" id="accordionExample">
        <!-- State 3 -->
        <div class="card">
            <div class="card-header" id="heading3">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                        <h5>PART 3: RATINGS</h5>
                    </button>
                </h5>
            </div>

            <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
                <div class="card-body">
                    <h6>2.3 Target set during the appraisal period and the rating.</h6>
                    <h6><i>(The Appraisee completes the first two columns for KRA and Targets, as agreed with the Supervisor while the rating is to be completed by the Supervisor using the key* below)</i></h6>

                    <!-- State 3 Form -->
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
                                $i = 1;
                                $where = "";
                                if ($_SESSION['login_type'] == 0) {
                                    $where = " WHERE w.employee_id = '{$_SESSION['login_id']}' ";
                                } elseif ($_SESSION['login_type'] == 1) {
                                    $where = " WHERE e.supervisor_id = {$_SESSION['login_id']} ";
                                } elseif ($_SESSION['login_type'] == 2) {
                                    $where = " WHERE w.user_id = {$_SESSION['login_id']} ";
                                }

                                $qry = $conn->query("SELECT * FROM work_plan WHERE employee_id = '{$_SESSION['login_id']}'");
                                //$qry = $conn->query("SELECT w.*, concat(e.lastname,', ',e.firstname,' ',e.middlename) as name FROM work_plan w INNER JOIN employee_list e ON e.id = w.employee_id $where ORDER BY UNIX_TIMESTAMP(w.date_created) ASC");
                                while ($row = $qry->fetch_assoc()) {
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
                                    $recentRatingQuery = $conn->query("SELECT scores FROM apas_rating WHERE target_id = $targetId ");
                                    $recentRating = $recentRatingQuery->fetch_assoc();
                                    $ratingValue = isset($recentRating['scores']) ? $recentRating['scores'] : '';
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
                                                <input class="form-control form-control-sm" style="width: 65px; height: 55px;" name="scores" type="number" value="<?php echo $ratingValue; ?>" id="scores_<?php echo $i ?>">
                                            <?php } else { ?>
                                                <input class="form-control form-control-sm" style="width: 65px; height: 55px;" name="scores" type="number" readonly value="<?php echo $ratingValue; ?>" id="scores_<?php echo $i ?>">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
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
    </div>
    <script>
        $(document).ready(function() {
            $('#list').dataTable()
            // Calculate overall rating
            function calculateOverallRating() {
                var targetCount = <?php echo $qry->num_rows; ?>; // Number of targets
                var totalRating = 0;

                // Loop through each target rating input field and sum the ratings
                for (var i = 1; i <= targetCount; i++) {
                    var rating = parseInt(document.getElementById("score_" + i).value);
                    totalRating += rating;
                }

                // Calculate the overall rating by dividing the total rating by the number of targets
                var overallRating = totalRating / targetCount;

                // Set the value of the overall rating input field
                document.getElementById("overall_score").value = overallRating;
            }

            // Call the calculateOverallRating function initially and whenever a target rating is changed
            document.addEventListener("DOMContentLoaded", function() {
                calculateOverallRating();

                // Add an event listener to each target rating input field
                var targetRatingInputs = document.querySelectorAll('[id^="scores_"]');
                targetRatingInputs.forEach(function(input) {
                    input.addEventListener("input", calculateOverallRating);
                });
            });
        });
    </script>
    <!-- State 4 -->
    <div class="card">
        <div class="card-header" id="heading4">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                    <h5>PART 3 (b): APPRAISEE & SUPERVISOR COMMENTS</h5>
                </button>
            </h5>
        </div>

        <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
            <div class="card-body">
                <!-- State 4 Form -->
                <form action="save_comments.php" id="manage_comments" method="POST">
                    <!-- Dropdown for selecting login type -->

                    <div class="form-group">
                        <label>Select Current User Type:</label>
                        <select class="form-control" id="login_type" name="login_type">
                            <option value="0" <?php echo ($_SESSION['login_type'] == 0) ? 'selected' : ''; ?>>Appraisee</option>
                            <option value="1" <?php echo ($_SESSION['login_type'] == 1) ? 'selected' : ''; ?>>Supervisor</option>
                        </select>
                    </div>
                    <?php if ($_SESSION['login_type'] != 2) : ?>
                        <div class="form-group">
                            <label for="">Appraisee Name</label>
                            <select name="employee_id" id="employee_id" class="form-control form-control-sm" required="">
                                <option value=""></option>
                                <?php
                                $employees = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM employee_list order by concat(lastname,', ',firstname,' ',middlename) asc");
                                while ($row = $employees->fetch_assoc()) :
                                ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($employee_id) && $employee_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <?php if ($_SESSION['login_type'] != 0) : ?>
                        <div class="form-group">
                            <label for="">Supervisor Name</label>
                            <select name="supervisor_id" id="supervisor_id" class="form-control form-control-sm" required="">
                                <option value=""></option>
                                <?php
                                $supervisors = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM supervisor_list order by concat(lastname,', ',firstname,' ',middlename) asc");
                                while ($row = $supervisors->fetch_assoc()) :
                                ?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($supervisor_id) && $supervisor_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    <!-- Form fields for State 4 - Appraisee Comments -->
                    <div id="appraisee_comments" class="<?php echo ($_SESSION['login_type'] != 0) ? 'd-none' : ''; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>2.4 Comments by the Appraisee on targets</h5>
                                <div class="form-group">
                                    <label>a) Achieved:</label>
                                    <textarea class="form-control" rows="3" name="app_achieved"><?php echo isset($app_achieved) ? $app_achieved : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>b) Not Achieved:</label>
                                    <textarea class="form-control" rows="3" name="app_not_achieved"><?php echo isset($app_not_achieved) ? $app_not_achieved : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Signature:</label>
                                    <input type="text" class="form-control" id="sign_1" name="sign_1" value="<?php echo isset($sign_1) ? $sign_1 : ''; ?>" placeholder="Enter signature">
                                </div>
                                <div class="form-group">
                                    <label>Date:</label>
                                    <input type="date" class="form-control" id="date1" name="date1" value="<?php echo isset($date1) ? $date1 : date("Y-m-d"); ?>" placeholder="Enter date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form fields for State 4 - Supervisor Comments -->
                    <div id="supervisor_comments" class="<?php echo ($_SESSION['login_type'] != 1) ? 'd-none' : ''; ?>">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <h5>2.5 Comments by the Supervisor on targets</h5>
                                <div class="form-group">
                                    <label>a) Achieved:</label>
                                    <textarea class="form-control" rows="3" name="sup_achieved"><?php echo isset($sup_achieved) ? $sup_achieved : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>b) Not Achieved:</label>
                                    <textarea class="form-control" rows="3" name="sup_not_achieved"><?php echo isset($sup_not_achieved) ? $sup_not_achieved : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Signature:</label>
                                    <input type="text" class="form-control" id="sign_2" name="sign_2" value="<?php echo isset($sign_2) ? $sign_2 : ''; ?>" placeholder="Enter signature">
                                </div>
                                <div class="form-group">
                                    <label>Date:</label>
                                    <input type="date" class="form-control" id="date2" name="date2" value="<?php echo isset($date2) ? $date2 : date("Y-m-d"); ?>" placeholder="Enter date">
                                </div>
                            </div>
                            <div class="col-md-6 border-left">
                                <h5>2.6 Additional contributions made by the Appraisee to the Ministry/Department <i>(to be completed by the Supervisor)</i></h5>
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" name="ministrial_contribution"><?php echo isset($ministrial_contribution) ? $ministrial_contribution : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Signature:</label>
                                    <input type="text" class="form-control" id="sign_3" name="sign_3" value="<?php echo isset($sign_3) ? $sign_3 : ''; ?>" placeholder="Enter signature">
                                </div>
                                <div class="form-group">
                                    <label>Date:</label>
                                    <input type="date" class="form-control" id="date3" name="date3" value="<?php echo isset($date3) ? $date3 : date("Y-m-d"); ?>" placeholder="Enter date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 text-right justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Handle login type selection change event
            document.getElementById('login_type').addEventListener('change', function() {
                var loginType = this.value;

                // Disable inappropriate comment section based on login type
                if (loginType == 0) {
                    document.getElementById('supervisor_comments').classList.add('d-none');
                    document.querySelectorAll('#supervisor_comments textarea, #supervisor_comments input').forEach(function(element) {
                        element.display = false;
                    });

                    document.getElementById('appraisee_comments').classList.remove('d-none');
                    document.querySelectorAll('#appraisee_comments textarea, #appraisee_comments input').forEach(function(element) {
                        element.display = true;
                    });
                } else if (loginType == 1) {
                    document.getElementById('appraisee_comments').classList.add('d-none');
                    document.querySelectorAll('#appraisee_comments textarea, #appraisee_comments input').forEach(function(element) {
                        element.display = false;
                    });

                    document.getElementById('supervisor_comments').classList.remove('d-none');
                    document.querySelectorAll('#supervisor_comments textarea, #supervisor_comments input').forEach(function(element) {
                        element.display = true;
                    });
                }
            });
        });
    </script>
    <!-- State 5 -->
    <div class="card">
        <div class="card-header" id="heading5">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                    <h5>PART 4: PERFORMANCE COMPETENCIES</h5>
                </button>
            </h5>
        </div>

        <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
            <div class="card-body">
                <h6><i>(to be completed by Supervisor using rating key* below)</i></h6>
                <!-- State 5 Form -->
                <form action="save_state5.php" method="POST">
                    <!-- Form fields for State 5 -->

                    <hr>
                    <div class="col-lg-12 text-right justify-content-center d-flex">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
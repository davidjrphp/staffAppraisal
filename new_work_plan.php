<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form action="save_work_plan.php" id="new_work_plan" method="POST">
                <!--<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">-->
                <div class="row">
                    <div class="col-md-6 border-right">
                        <?php if ($_SESSION['login_type'] == 0) : ?>
                            <div class="form-group">
                                <label for="">Enter You Name</label>
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
                                <label for="">Enter You Name</label>
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
                        <div class="form-group">
                            <label for="">start Date</label>
                            <input type="date" class="form-control form-control-sm" name="start_date" value="<?php echo isset($start_date) ? $start_date : date("Y-m-d") ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">End Date</label>
                            <input class="form-control form-control-sm" name="end_date" type="date" required value="<?php echo isset($end_date) ? $end_date : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Key Result Area:</label>
                            <textarea name="kra_name" id="" cols="30" rows="10" class="summernote form-control">
							<?php echo isset($kra_name) ? $kra_name : '' ?>
						    </textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Principal Accountability:</label>
                            <textarea name="p_accountability" id="" cols="30" rows="10" class="summernote form-control">
							<?php echo isset($p_accountability) ? $p_accountability : '' ?>
						</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 border-left">
                        <div class="form-group">
                            <label for="">Targets:</label>
                            <textarea name="targets" id="" cols="30" rows="10" class="summernote form-control">
							<?php echo isset($targets) ? $targets : '' ?>
						</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Schedule of Activity:</label>
                            <textarea name="activ_schedule" id="" cols="30" rows="10" class="summernote form-control">
							<?php echo isset($activ_schedule) ? $activ_schedule : '' ?>
						</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 text-right justify-content-center d-flex">
                        <button class="btn btn-primary mr-2">Save</button>
                        <button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=work_plan_list'">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize select2 and summernote plugins
        $('#j_title_id').select2({
            placeholder: 'Please select a Job Title',
            width: '100%'
        });

        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['table', ['table']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
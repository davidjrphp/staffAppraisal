<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <form action="" id="new_work_plan">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <div class="row">
                    <div class="col-md-6 border-right">
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

        $('#employee_id').select2({
            placeholder: 'Please Employee',
            width: '100%'
        })

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
        })
    })


    $('#new_work_plan').submit(function(e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_work_plan',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast('Data successfully saved', "success");
                    setTimeout(function() {
                        location.replace('index.php?page=work_plan_list')
                    }, 1500)
                }
            }
        })
    })
</script>
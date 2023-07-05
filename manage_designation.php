<?php
include 'db_connect.php';
if (isset($_GET['job_id'])) {
	$qry = $conn->query("SELECT * FROM job_description where job_id = {$_GET['job_id']}")->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-designation">
		<input type="hidden" name="job_id" value="<?php echo isset($job_id) ? $job_id : '' ?>">
		<div id="msg" class="form-group"></div>
		<div class="form-group">
			<label for="j_title" class="control-label">Job Title</label>
			<input type="text" class="form-control form-control-sm" name="j_title" id="j_title" value="<?php echo isset($j_title) ? $j_title : '' ?>">
		</div>
		<div class="form-group">
			<label for="description" class="control-label">Job Purpose</label>
			<textarea name="j_purpose" id="j_purpose" cols="30" rows="4" class="form-control"><?php echo isset($j_purpose) ? $j_purpose : '' ?></textarea>
		</div>
	</form>
</div>
<script>
	$(document).ready(function() {
		$('#manage-designation').submit(function(e) {
			e.preventDefault();
			start_load()
			$('#msg').html('')
			$.ajax({
				url: 'ajax.php?action=save_designation',
				method: 'POST',
				data: $(this).serialize(),
				success: function(resp) {
					if (resp == 1) {
						alert_toast("Data successfully saved.", "success");
						setTimeout(function() {
							location.reload()
						}, 1750)
					} else if (resp == 2) {
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> designation already exist.</div>')
						end_load()
					}
				}
			})
		})
	})
</script>
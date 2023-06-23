<?php
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_supervisor">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Middle Name (optional)</label>
							<input type="text" name="middlename" class="form-control form-control-sm" value="<?php echo isset($middlename) ? $middlename : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
						<div class="form-group">
							<label for="sex">Sex:</label>

							<select class="form-control form-control-sm select2" name="sex" id="sex">
								<option value="<?php echo isset($sex) ? $sex : 'MALE' ?>">MALE</option>
								<option value="<?php echo isset($sex) ? $sex : 'FEMALE' ?>">FEMALE</option>

							</select>
						</div>

						<div class="form-group">
							<label for="" class="control-label">Date of Birth</label>
							<input class="form-control form-control-sm" id="dob" name="DOB" type="Date" required value="<?php echo isset($DOB) ? $DOB : '' ?>">
						</div>

						<div class="form-group">
							<label for="" class="control-label">Station</label>
							<input class="form-control form-control-sm" id="station" name="station" type="text" required value="<?php echo isset($station) ? $station : '' ?>">
						</div>

						<div class="form-group">
							<label for="" class="control-label">Department</label>
							<select name="department_id" id="department_id" class="form-control form-control-sm select2">
								<option value=""></option>
								<?php
								$departments = $conn->query("SELECT * FROM department_list order by department asc");
								while ($row = $departments->fetch_assoc()) :
								?>
									<option value="<?php echo $row['id'] ?>" <?php echo isset($department_id) && $department_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['department'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Job Title</label>
							<select name="j_title_id" id="j_title_id" class="form-control form-control-sm select2">
								<option value=""></option>
								<?php
								$j_titles = $conn->query("SELECT * FROM job_description order by j_title asc");
								while ($row = $j_titles->fetch_assoc()) :
								?>
									<option value="<?php echo $row['id'] ?>" <?php echo isset($j_title_id) && $j_title_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['j_title'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Ministry</label>
							<input class="form-control form-control-sm" id="ministry" name="ministry" type="text" required value="<?php echo isset($ministry) ? $ministry : '' ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Section</label>
							<input class="form-control form-control-sm" id="section" name="section" type="text" required value="<?php echo isset($section) ? $section : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Supervision Level ID</label>
							<input class="form-control form-control-sm" id="sup_lv_id" name="sup_lv_id" type="number" required value="<?php echo isset($sup_lv_id) ? $sup_lv_id : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Supervisor</label>
							<select name="supervisor_id" id="supervisor_id" class="form-control form-control-sm select2">
								<option value=""></option>
								<?php
								$supervisors = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM supervisor_list order by concat(lastname,', ',firstname,' ',middlename) asc");
								while ($row = $supervisors->fetch_assoc()) :
								?>
									<option value="<?php echo $row['id'] ?>" <?php echo isset($supervisor_id) && $supervisor_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>

						<div class="form-group">
							<label for="" class="control-label">Avatar</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<div class="form-group d-flex justify-content-center align-items-center">
							<img src="<?php echo isset($avatar) ? 'assets/uploads/' . $avatar : '' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
						</div>

						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) ? $email : '' ?>">
							<small id="#msg"></small>
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required" : '' ?>>
							<small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password" : '' ?></i></small>
						</div>
						<div class="form-group">
							<label class="label control-label">Confirm Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? 'required' : '' ?>>
							<small id="pass_match" data-status=''></small>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=supervisor_list'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	img#cimg {
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	$('[name="password"],[name="cpass"]').keyup(function() {
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if (cpass == '' || pass == '') {
			$('#pass_match').attr('data-status', '')
		} else {
			if (cpass == pass) {
				$('#pass_match').attr('data-status', '1').html('<i class="text-success">Password Matched.</i>')
			} else {
				$('#pass_match').attr('data-status', '2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})

	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#manage_supervisor').submit(function(e) {
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if ($('[name="password"]').val() != '' && $('[name="cpass"]').val() != '') {
			if ($('#pass_match').attr('data-status') != 1) {
				if ($("[name='password']").val() != '') {
					$('[name="password"],[name="cpass"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}
		$.ajax({
			url: 'ajax.php?action=save_supervisor',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				if (resp == 1) {
					alert_toast('Data successfully saved.', "success");
					setTimeout(function() {
						location.replace('index.php?page=supervisor_list')
					}, 750)
				} else if (resp == 2) {
					$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>
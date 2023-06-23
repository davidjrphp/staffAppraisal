<?php include 'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_designation" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="30%">
					<col width="45%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Job Title</th>
						<th>Job Purpose</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM job_description order by j_title asc ");
					while ($row = $qry->fetch_assoc()) :
					?>
						<tr>
							<th class="text-center"><?php echo $i++ ?></th>
							<td><b><?php echo $row['j_title'] ?></b></td>
							<td><b><?php echo $row['j_purpose'] ?></b></td>
							<td class="text-center">
								<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									Action
								</button>
								<div class="dropdown-menu" style="">
									<a class="dropdown-item view_description" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_designation">Edit</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_description" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
								</div>
							</td>


							<!--<td class="text-center">
								<div class="btn-group">
									<a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_designation">
										<i class="fas fa-edit"></i>
									</a>
									<button type="button" class="btn btn-danger btn-flat delete_designation" data-id="<?php echo $row['id'] ?>">
										<i class="fas fa-trash"></i>
									</button>
								</div>
							</td>-->
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#list').dataTable()
		$('.new_designation').click(function() {
			uni_modal("New Designation", "manage_designation.php")
		})
		$('.view_description').click(function() {
			uni_modal("<i class='fa fa-id-card'></i> Job Description Details", "view_job_description.php?id=" + $(this).attr('data-id'))
		})
		$('.manage_designation').click(function() {
			uni_modal("Manage Designation", "manage_designation.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_description').click(function() {
			_conf("Are you sure to delete this Job Description?", "delete_description", [$(this).attr('data-id')])
		})
	})


	/*$(document).ready(function() {
		$('#list').dataTable()
		$('.new_designation').click(function() {
			uni_modal("New Designation", "manage_designation.php")
		})
		$('.manage_designation').click(function() {
			uni_modal("Manage Designation", "manage_designation.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_designation').click(function() {
			_conf("Are you sure to delete this Designation?", "delete_designation", [$(this).attr('data-id')])
		})
	})*/

	function delete_designation($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_designation',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>
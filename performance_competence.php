<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table tabe-hover table-bordered" id="list">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th width="25%">Performance Average</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db_connect.php';
                    $i = 1;
                    $where = "";
                    if ($_SESSION['login_type'] == 0)
                        $where = " where p.employee_id = '{$_SESSION['login_id']}' ";
                    elseif ($_SESSION['login_type'] == 1)
                        $where = " where p.supervisor_id = {$_SESSION['login_id']} ";

                    $qry = $conn->query("SELECT p.*,concat(e.lastname,', ',e.firstname,' ',e.middlename) as name, (((p.mgt_skills + p.j_knowledge + p.qow + p.promptness + p.dependability + p.accountability + p.creativity + p.com_skills + p.courtesy + p.attitude + p.adaptability + p.team_work)/12)) as pa FROM performance_competence p inner join employee_list e on e.id = p.employee_id $where order by unix_timestamp(p.date_created) asc");
                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><b><?php echo ($row['name']) ?></b></td>
                            <td><b><?php echo number_format($row['pa'], 2) . "" ?></b></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item view_performance" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="./index.php?page=edit_performance&id=<?php echo $row['id'] ?>">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_evaluation" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                                </div>
                            </td>
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
        $('.view_performance').click(function() {
            uni_modal("Competencies/Attributes", "view_performance.php?id=" + $(this).attr('data-id'), 'mid-large')
        })
        $('.delete_evaluation').click(function() {
            _conf("Are you sure to delete this evaluation?", "delete_evaluation", [$(this).attr('data-id')])
        })
    })

    function delete_evaluation($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_evaluation',
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
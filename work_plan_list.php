<?php include 'db_connect.php' ?>
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <?php if ($_SESSION['login_type'] == 2) : ?>
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_work_plan"><i class="fa fa-plus"></i> Add New Work Plan</a>
                </div>
            <?php endif; ?>
            <?php if ($_SESSION['login_type'] == 1) : ?>
                <div class="card-tools">
                    <button class="btn btn-block btn-sm btn-default btn-flat border-primary" id="new_work_plan"><i class="fa fa-plus"></i> Add Work Plan</button>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <table class="table tabe-hover table-condensed" id="list">

                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Key Result Area</th>
                        <th>Targets</th>
                        <th>Principal Acc.</th>
                        <th>Schedule of Activities</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $where = "";
                    if ($_SESSION['login_type'] == 0)
                        $where = " where w.employee_id = '{$_SESSION['login_id']}' ";
                    elseif ($_SESSION['login_type'] == 1)
                        $where = " where e.supervisor_id = {$_SESSION['login_id']} ";


                    $qry = $conn->query("SELECT w.*,concat(e.lastname,', ',e.firstname,' ',e.middlename) as name FROM work_plan w inner join employee_list e on e.id = w.employee_id $where order by unix_timestamp(w.date_created) asc");
                    while ($row = $qry->fetch_assoc()) :
                        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                        $kra = strtr(html_entity_decode($row['kra_name']), $trans);
                        $kra = str_replace(array("<li>", "</li>"), array("", ", "), $kra);
                        $targets = strtr(html_entity_decode($row['targets']), $trans);
                        $targets = str_replace(array("<li>", "</li>"), array("", ", "), $targets);
                        $p_acc = strtr(html_entity_decode($row['p_accountabilty']), $trans);
                        $p_acc = str_replace(array("<li>", "</li>"), array("", ", "), $p_acc);
                        $schedule = strtr(html_entity_decode($row['activ_schedule']), $trans);
                        $schedule = str_replace(array("<li>", "</li>"), array("", ", "), $activ_schedule);

                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td>
                                <p><b><?php echo ucwords($row['kra_name']) ?></b></p>
                                <p class="truncate"><?php echo strip_tags($kra) ?></p>
                            </td>
                            <td>
                                <p><b><?php echo ucwords($row['targets']) ?></b></p>
                                <p class="truncate"><?php echo strip_tags($targets) ?></p>
                            </td>
                            <td>
                                <p><b><?php echo ucwords($row['p_accountability']) ?></b></p>
                                <p class="truncate"><?php echo strip_tags($p_acc) ?></p>
                            </td>
                            <td>
                                <p><b><?php echo ucwords($row['activ_schedule']) ?></b></p>
                                <p class="truncate"><?php echo strip_tags($activ_schedule) ?></p>
                            </td>
                            <td>
                                <?php
                                if ($row['status'] == 0) {
                                    echo "<span class='badge badge-info'>Pending</span>";
                                } elseif ($row['status'] == 1) {
                                    echo "<span class='badge badge-primary'>On-Progress</span>";
                                } elseif ($row['status'] == 2) {
                                    echo "<span class='badge badge-success'>Complete</span>";
                                }
                                if (strtotime($row['due_date']) < strtotime(date('Y-m-d'))) {
                                    echo "<span class='badge badge-danger mx-1'>Over Due</span>";
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu" style="">
                                    <?php if ($_SESSION['login_type'] == 2) : ?>
                                        <a class="dropdown-item manage_task" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_task" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                                        <div class="dropdown-divider"></div>
                                    <?php endif; ?>
                                    <?php if ($_SESSION['login_type'] == 0) : ?>
                                        <?php if ($row['status'] != 2) : ?>
                                            <a class="dropdown-item new_progress" data-pid='<?php echo $row['pid'] ?>' data-tid='<?php echo $row['id'] ?>' data-task='<?php echo ucwords($row['task']) ?>' href="javascript:void(0)">Add Progress</a>
                                            <div class="dropdown-divider"></div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <a class="dropdown-item view_progress" data-pid='<?php echo $row['pid'] ?>' data-tid='<?php echo $row['id'] ?>' data-task='<?php echo ucwords($row['task']) ?>' href="javascript:void(0)">View Progress</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    table p {
        margin: unset !important;
    }

    table td {
        vertical-align: middle !important
    }
</style>
<script>
    $(document).ready(function() {
        $('#list').dataTable()
        $('#new_work_plan').click(function() {
            uni_modal("<i class='fa fa-plus'></i> New Task", "manage_task.php", 'mid-large')
        })
        $('.manage_task').click(function() {
            uni_modal("<i class='fa fa-edit'></i> Edit Task", "manage_task.php?id=" + $(this).attr('data-id'), 'mid-large')
        })
        $('.new_progress').click(function() {
            uni_modal("<i class='fa fa-plus'></i> New Progress for: " + $(this).attr('data-task'), "manage_progress.php?tid=" + $(this).attr('data-tid'), 'mid-large')
        })
        $('.view_progress').click(function() {
            uni_modal("Progress for: " + $(this).attr('data-task'), "view_progress.php?id=" + $(this).attr('data-tid'), 'mid-large')
        })
        $('.delete_work_plan').click(function() {
            _conf("Are you sure to delete this Individual Work Plan?", "delete_employee", [$(this).attr('data-id')])
        })
    })

    function delete_task($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_work_plan',
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
<div class="col-lg-12">
    <div class="card card-outline card-success">
        <div class="card-header">
            <div class="card-tools">
                <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_work_plan"><i class="fa fa-plus"></i> Add New Work Plan</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table tabe-hover table-condensed" id="list">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Overall Score</th>
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
                        $where = " where w.supervisor_id = {$_SESSION['login_id']} ";

                    //$qry = $conn->query("SELECT * FROM work_plan WHERE employee_id = '{$_SESSION[' login_id']}'");
                    $qry = $conn->query("SELECT w.*,concat(e.lastname,', ',e.firstname,' ',e.middlename) as name FROM work_plan w inner join employee_list e on e.id = w.employee_id $where order by unix_timestamp(w.date_created) asc");
                    //$qry = $conn->query("SELECT w.*,concat(s.lastname,', ',s.firstname,' ',s.middlename) as name FROM work_plan w inner join supervisor_list s on s.id = w.supervisor_id $where order by unix_timestamp(w.date_created) asc");
                    while ($row = $qry->fetch_assoc()) :
                        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                        $name = strtr(html_entity_decode($row['name']), $trans);
                        $name = str_replace(array("<li>", "</li>"), array("", ", "), $name);
                        $overall_score = strtr(html_entity_decode($row['overall_score']), $trans);
                        $overall_score = str_replace(array("<li>", "</li>"), array("", ", "), $overall_score);

                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i ?></td>
                            <td>
                                <p class="truncate"><b><?php echo strip_tags($name) ?></b></p>
                            </td>
                            <td>
                                <p class="truncate"><?php echo strip_tags($overall_score) ?></p>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    Action
                                </button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item manage_comments" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Comments</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item delete_task" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit Rating</a>
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
        $('#list').dataTable();
        $('#new_work_plan').click(function() {
            uni_modal("<i class='fa fa-plus'></i> New Task", "manage_task.php", 'mid-large');
        });
        $('.manage_comments').click(function() {
            uni_modal("<i class='fa fa-view'></i> view comments", "view_comments.php?id=" + $(this).attr('data-id'), 'mid-large');
        });
        $('.new_progress').click(function() {
            uni_modal("<i class='fa fa-plus'></i> New Progress for: " + $(this).attr('data-task'), "manage_progress.php?tid=" + $(this).attr('data-tid'), 'mid-large');
        });
        $('.view_progress').click(function() {
            uni_modal("Progress for: " + $(this).attr('data-task'), "view_progress.php?id=" + $(this).attr('data-tid'), 'mid-large');
        });
        $('.delete_work_plan').click(function() {
            _conf("Are you sure to delete this Individual Work Plan?", "delete_employee", [$(this).attr('data-id')]);
        });
    });

    function delete_task($id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_work_plan',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
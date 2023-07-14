<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry = $conn->query("SELECT f.*, concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as name FROM follow_up_action f INNER JOIN employee_list e ON e.id = f.employee_id where f.id = $id");
    if ($qry && $qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $name = strtr(html_entity_decode($row['name']), $trans);
        $name = str_replace(array("<li>", "</li>"), array("", ", "), $name);
        $action_comment = strtr(html_entity_decode($row['action_comment']), $trans);
        $action_comment = str_replace(array("<li>", "</li>"), array("", ", "), $action_comment);
        $sign = strtr(html_entity_decode($row['sign']), $trans);
        $sign = str_replace(array("<li>", "</li>"), array("", ", "), $sign);
        $date = strtr(html_entity_decode($row['date']), $trans);
        $date = str_replace(array("<li>", "</li>"), array("", ", "), $date);
?>
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <dl>
                            <dt><b class="border-bottom border-primary">Name of Job Holder</b></dt>
                            <dd><?php echo ucwords($name) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Follow Up Action Comment</b></dt>
                            <dd><?php echo ucwords($action_comment) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Supervisor Signature</b></dt>
                            <dd><?php echo ucwords($sign) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Date</b></dt>
                            <dd><?php echo date("m d, Y", strtotime($date)) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "No data found.";
    }
}
?>
<style>
    #uni_modal .modal-footer {
        display: none
    }

    #uni_modal .modal-footer.display {
        display: flex
    }

    #post-field {
        max-height: 70vh;
        overflow: auto;
    }
</style>
<div class="modal-footer display p-0 m-0">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
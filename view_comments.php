<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("
        SELECT s.*, concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as name
        FROM score_comments s
        INNER JOIN employee_list e ON e.id = s.employee_id
        WHERE s.id = ?
    ");

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);

        $app_achieved = strtr(html_entity_decode($row['app_achieved']), $trans);
        $app_achieved = str_replace(array("<li>", "</li>"), array("", ", "), $app_achieved);
        $app_not_achieved = strtr(html_entity_decode($row['app_not_achieved']), $trans);
        $app_not_achieved = str_replace(array("<li>", "</li>"), array("", ", "), $app_not_achieved);
        $sign_1 = strtr(html_entity_decode($row['sign_1']), $trans);
        $sign_1 = str_replace(array("<li>", "</li>"), array("", ", "), $sign_1);
        $date1 = strtr(html_entity_decode($row['date1']), $trans);
        $date1 = str_replace(array("<li>", "</li>"), array("", ", "), $date1);
        $sup_achieved = strtr(html_entity_decode($row['sup_achieved']), $trans);
        $sup_achieved = str_replace(array("<li>", "</li>"), array("", ", "), $sup_achieved);
        $sup_not_achieved = strtr(html_entity_decode($row['sup_not_achieved']), $trans);
        $sup_not_achieved = str_replace(array("<li>", "</li>"), array("", ", "), $sup_not_achieved);
        $sign_2 = strtr(html_entity_decode($row['sign_2']), $trans);
        $sign_2 = str_replace(array("<li>", "</li>"), array("", ", "), $sign_2);
        $date2 = strtr(html_entity_decode($row['date2']), $trans);
        $date2 = str_replace(array("<li>", "</li>"), array("", ", "), $date2);
        $ministerial_contribution = strtr(html_entity_decode($row['ministerial_contribution']), $trans);
        $ministerial_contribution = str_replace(array("<li>", "</li>"), array("", ", "), $ministerial_contribution);
        $date3 = strtr(html_entity_decode($row['date3']), $trans);
        $date3 = str_replace(array("<li>", "</li>"), array("", ", "), $date3);
?>

        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <dl>
                            <dt><b class="border-bottom border-primary">Achieved</b></dt>
                            <dd><?php echo ($app_achieved) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Not Achieved</b></dt>
                            <dd><?php echo ($app_not_achieved) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Signature</b></dt>
                            <dd><?php echo ($sign_1) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Date</b></dt>
                            <dd><?php echo date("m d, Y", strtotime($date1)) ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl>
                            <dt><b class="border-bottom border-primary">Achieved (supervisor)</b></dt>
                            <dd><?php echo ($sup_achieved) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Not Achieved (supervisor)</b></dt>
                            <dd><?php echo ($sup_not_achieved) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Signature (supervisor)</b></dt>
                            <dd><?php echo ($sign_2) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Date</b></dt>
                            <dd><?php echo date("m d, Y", strtotime($date2)) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Ministerial Contribution</b></dt>
                            <dd><?php echo ($ministerial_contribution) ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Date</b></dt>
                            <dd><?php echo date("m d, Y", strtotime($date3)) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
<?php
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
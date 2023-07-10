<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT s.*,concat(e.lastname,', ',e.firstname,' ',e.middlename) as name FROM score_comments s inner join employee_list e on e.id = s.employee_id  where s.id = " . $_GET['id'])->fetch_array();
    foreach ($qry as $k => $v) {
        $$k = $v;
    }
}
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-6">
                <dl>
                    <dt><b class="border-bottom border-primary">Employee Name</b></dt>
                    <dd><?php echo ucwords($name) ?></dd>
                </dl>
                <dl>
                    <dt><b class="border-bottom border-primary">Achieved</b></dt>
                    <dd><?php echo ucwords($app_achieved) ?></dd>
                </dl>
                <dl>
                    <dt><b class="border-bottom border-primary">Not Achieved</b></dt>
                    <dd><?php echo ucwords($app_not_achieved) ?></dd>
                </dl>
                <dl>
                    <dt><b class="border-bottom border-primary">Signature</b></dt>
                    <dd><?php echo ucwords($sign1) ?></dd>
                </dl>
                <dl>
                    <dt><b class="border-bottom border-primary">Date</b></dt>
                    <dd><?php echo date("m d,Y", strtotime($date1)) ?></dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl>
                    <dt><b class="border-bottom border-primary">Achieved</b></dt>
                    <dd><?php echo ucwords($sup_achieved) ?></dd>
                </dl>
                <dl>
                    <dt><b class="border-bottom border-primary">Not Achieved</b></dt>
                    <dd><?php echo ucwords($sup_not_achieved) ?></dd>
                </dl>
                <dl>
                    <dt><b class="border-bottom border-primary">Signature</b></dt>
                    <dd><?php echo ucwords($sign2) ?></dd>
                </dl>
                <dl>
                    <dt><b class="border-bottom border-primary">Date</b></dt>
                    <dd><?php echo date("m d,Y", strtotime($date2)) ?></dd>
                </dl>
            </div>
            <div class="col-md-6">
                <dl>
                    <dt><b class="border-bottom border-primary">Ministerial Contribution</b></dt>
                    <dd><?php echo ucwords($ministrial_contribution) ?></dd>
                </dl>
                <dl>
                    <dt><b class="border-bottom border-primary">Date</b></dt>
                    <dd><?php echo date("m d,Y", strtotime($date3)) ?></dd>
                </dl>
                <dl>
                    <dt><b class="border-bottom border-primary">Status</b></dt>
                    <dd>
                        <?php
                        if ($status == 0) {
                            echo "<span class='badge badge-info'>Pending</span>";
                        } elseif ($status == 1) {
                            echo "<span class='badge badge-primary'>On-Progress</span>";
                        } elseif ($status == 2) {
                            echo "<span class='badge badge-success'>Complete</span>";
                        }
                        if (strtotime($due_date) < strtotime(date('Y-m-d'))) {
                            echo "<span class='badge badge-danger mx-1'>Over Due</span>";
                        }
                        ?>
                    </dd>
                </dl>
            </div>
        </div>

    </div>
</div>
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
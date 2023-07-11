<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $qry = $conn->query("SELECT p.*, concat(e.lastname, ', ', e.firstname, ' ', e.middlename) as name, (((p.mgt_skills + p.j_knowledge + p.qow + p.promptness + p.dependability + p.accountability + p.creativity + p.com_skills + p.courtesy + p.attitude + p.adaptability + p.team_work) / 12)) as pa FROM performance_competence p INNER JOIN employee_list e ON e.id = p.employee_id where p.id = $id");
    if ($qry) {
        $row = $qry->fetch_assoc();
        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
        $name = strtr(html_entity_decode($row['name']), $trans);
        $name = str_replace(array("<li>", "</li>"), array("", ", "), $name);
        $appraisal_date = strtr(html_entity_decode($row['date_created']), $trans);
        $appraisal_date = str_replace(array("<li>", "</li>"), array("", ", "), $appraisal_date);
        $mgt_skills = strtr(html_entity_decode($row['mgt_skills']), $trans);
        $mgt_skills = str_replace(array("<li>", "</li>"), array("", ", "), $mgt_skills);
        $j_knowledge = strtr(html_entity_decode($row['j_knowledge']), $trans);
        $j_knowledge = str_replace(array("<li>", "</li>"), array("", ", "), $j_knowledge);
        $qow = strtr(html_entity_decode($row['qow']), $trans);
        $qow = str_replace(array("<li>", "</li>"), array("", ", "), $qow);
        $promptness = strtr(html_entity_decode($row['promptness']), $trans);
        $promptness = str_replace(array("<li>", "</li>"), array("", ", "), $promptness);
        $dependability = strtr(html_entity_decode($row['dependability']), $trans);
        $dependability = str_replace(array("<li>", "</li>"), array("", ", "), $dependability);
        $accountability = strtr(html_entity_decode($row['accountability']), $trans);
        $accountability = str_replace(array("<li>", "</li>"), array("", ", "), $accountability);
        $creativity = strtr(html_entity_decode($row['creativity']), $trans);
        $creativity = str_replace(array("<li>", "</li>"), array("", ", "), $creativity);
        $com_skills = strtr(html_entity_decode($row['com_skills']), $trans);
        $com_skills = str_replace(array("<li>", "</li>"), array("", ", "), $com_skills);
        $courtesy = strtr(html_entity_decode($row['courtesy']), $trans);
        $courtesy = str_replace(array("<li>", "</li>"), array("", ", "), $courtesy);
        $attitude = strtr(html_entity_decode($row['attitude']), $trans);
        $attitude = str_replace(array("<li>", "</li>"), array("", ", "), $attitude);
        $adaptability = strtr(html_entity_decode($row['adaptability']), $trans);
        $adaptability = str_replace(array("<li>", "</li>"), array("", ", "), $adaptability);
        $team_work = strtr(html_entity_decode($row['team_work']), $trans);
        $team_work = str_replace(array("<li>", "</li>"), array("", ", "), $team_work);
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
                            <dt><b class="border-bottom border-primary">Appraisal Date</b></dt>
                            <dd><?php echo date("m d, Y", strtotime($appraisal_date)) ?></dd>
                        </dl>
                        <b>Ratings:</b>
                        <dl>
                            <dt><b class="border-bottom border-primary">Management/Supervisory Skills</b></dt>
                            <dd><?php echo $mgt_skills ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Job knowledge:</b></dt>
                            <dd><?php echo $j_knowledge ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Quality of Work</b></dt>
                            <dd><?php echo $qow ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Promptness:</b></dt>
                            <dd><?php echo $promptness ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl>
                            <dt><b class="border-bottom border-primary">Dependability</b></dt>
                            <dd><?php echo $dependability ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Accountability</b></dt>
                            <dd><?php echo $accountability ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Initiative and Creativity:</b></dt>
                            <dd><?php echo $creativity ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Communication skills:</b></dt>
                            <dd><?php echo $com_skills ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Tact and Courtesy:</b></dt>
                            <dd><?php echo $courtesy ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Attitude:</b></dt>
                            <dd><?php echo $attitude ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Adaptability:</b></dt>
                            <dd><?php echo $adaptability ?></dd>
                        </dl>
                        <dl>
                            <dt><b class="border-bottom border-primary">Team work:</b></dt>
                            <dd><?php echo $team_work ?></dd>
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
<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $employee_id = $_POST['employee_id'];
    $mgt_skills = $_POST['mgt_skills'];
    $j_knowledge = $_POST['j_knowledge'];
    $qow = $_POST['qow'];
    $promptness = $_POST['promptness'];
    $dependability = $_POST['dependability'];
    $accountability = $_POST['accountability'];
    $creativity = $_POST['creativity'];
    $com_skills = $_POST['com_skills'];
    $courtesy = $_POST['courtesy'];
    $attitude = $_POST['attitude'];
    $adaptability = $_POST['adaptability'];
    $team_work = $_POST['team_work'];

    // Perform database insertion
    include 'db_connect.php';
    $conn->query("INSERT INTO performance_competence (employee_id, mgt_skills, j_knowledge, qow, promptness, dependability, accountability, creativity, com_skills, courtesy, attitude, adaptability, team_work) 
                VALUES ('$employee_id', '$mgt_skills', '$j_knowledge', '$qow', '$promptness', '$dependability', '$accountability', '$creativity', '$com_skills', '$courtesy', '$attitude', '$adaptability', '$team_work')");


?>
    <script type="text/javascript">
        alert("Added Successfully.");
        window.location = "";
    </script>
<?php
}
?>
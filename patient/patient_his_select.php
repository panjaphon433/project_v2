<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");
$HN = $_SESSION['check'];

$sql = "SELECT  patient_history.idpatient_history, 
                patient.HN, 
                patient.patient_name , 
                patient.patient_lastname, 
                disease.disease_name,
                disease.iddisease,
                patient_history.detail, 
                patient_history.date_treatment, 
                admin.idadmin, 
                admin.admin_name, 
                admin.admin_lastname,
                patient_history.weight,
                patient_history.height,
                patient_history.bps,
                patient_history.bpd,
                patient_history.p
        FROM `patient_history` 
        INNER JOIN `patient` ON patient_history.HN = patient.HN 
        INNER JOIN `admin`ON patient_history.idadmin = admin.idadmin 
        LEFT JOIN `disease`ON patient_history.iddisease= disease.iddisease
        WHERE  `patient`.`HN` = '{$HN}'
        ORDER BY patient_history.date_treatment DESC;";

// echo $sql;
$result = $conn->query($sql);

$x = $result -> fetch_all(MYSQLI_ASSOC);
               
               
 echo json_encode($x);
 $result -> free_result();
$conn->close();
//INNER JOIN `disease`ON patient_history.iddisease= disease.iddisease

?>
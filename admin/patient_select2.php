<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");

// WHERE `HN`
$sql = "SELECT  patient.HN, 
                patient.patient_name, 
                patient_data.patient_nation, 
                patient_data.patient_race, 
                patient_data.patient_religion, 
                patient_data.patient_degree, 
                patient_data.patient_marital, 
                patient_data.patient_occupation, 
                patient_data.patient_sex, 
                patient_data.patient_right, 
                patient_data.patient_mom, 
                patient_data.patient_dad, 
                patient_data.patient_spouse, 
                patient_data.mom_idcard, 
                patient_data.dad_idcard, 
                patient_data.spouse_idcard 
        FROM `patient` LEFT JOIN `patient_data`ON patient.HN = patient_data.HN 
        WHERE patient.HN = '{$s->HN}';";
                //echo $sql;

$result = $conn->query($sql);
// SELECT * FROM `patient` WHERE `patient_name` LIKE '{$s->key}%' OR `patient_lastname` LIKE '{$s->key}%' OR `HN` LIKE '{$s->key}%';";
//echo $sql;

$x = $result -> fetch_all(MYSQLI_ASSOC);

echo json_encode($x);
$result -> free_result();
$conn->close();


?>
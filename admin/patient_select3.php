<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");


$sql = "SELECT p.village_no, d.disease_name, COUNT(*) AS total_patients
FROM patient p
JOIN disease d ON p.patient_disease = d.iddisease
GROUP BY p.village_no, d.disease_name
ORDER BY p.village_no, d.disease_name;
";

$result = $conn->query($sql);
$x2 = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($x2);   //ส่งสองตัว

$conn->close();

//where ข้างบน `patient_name` LIKE '{$s->key}%' OR `patient_lastname` LIKE '{$s->key}%' OR `patient`.`HN` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%' 

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");


$sql = "SELECT 
                patient.HN, 
                patient.patient_name , 
                patient.patient_lastname
        FROM `patient` 
        WHERE `HN` LIKE '%' ";
        //AND appointment.idappointment ='{$s->idappointment}';
$result = $conn->query($sql);
$x = $result -> fetch_all(MYSQLI_ASSOC);

echo json_encode($x);
$result -> free_result();
$conn->close();


?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input'));

// $a = $x->patient_birthday;
$conn = new mysqli("localhost", "root", "", "appointment");
$sql = "UPDATE `appointment` 
        SET `idappointment` = '{$x->idappointment}',
            `HN` = '{$x->HN}', 
            `idadmin` = '{$x->idadmin}',
            `appointment_date` = '{$x->patient_lastname}', 
            `appointment_time` = '{$x->patient_phone}',
            `appointment_location` = '{$x->patient_birthday}',
            `appointment_reason` = '{$x->patient_address}',
            `detail` = '{$x->detail}',
            `record_time` = '{$x->patient_blood}', 
            `status` = '{$x->patient_password}'
        WHERE `appointment`.`idappointment` = '{$x->idappointment}';";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
   
$conn->close();

?>
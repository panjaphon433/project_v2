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
            `appointment_date` = '{$x->appointment_date2}', 
            `appointment_time` = '{$x->appointment_time}',
            `appointment_location` = '{$x->appointment_location}',
            `appointment_reason` = '{$x->appointment_reason}',
            `detail` = '{$x->detail}',
            `record_time` = current_timestamp() , 
            `status` = '{$x->status}'
        WHERE `appointment`.`idappointment` = '{$x->idappointment}';";
$result = $conn->query($sql);
//echo $sql;
if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
   
$conn->close();

?>
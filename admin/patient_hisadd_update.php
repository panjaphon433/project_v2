<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input'));

// $a = $x->patient_birthday;
$conn = new mysqli("localhost", "root", "", "appointment");
$sql = "UPDATE `patient_history` 
        SET `idpatient_history` = '{$x->idpatient_history}',
            `HN` = '{$x->HN}', 
            `idadmin` = '{$x->idadmin}',
            `iddisease` = '{$x->iddisease}', 
            `detail` = '{$x->detail}',
            `record_time` = '{$x->record_time}',
        WHERE `patient_history`.`idpatient_history` = '{$x->idpatient_history}';";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
   
$conn->close();

?>
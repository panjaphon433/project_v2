<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input'));

// $a = $x->patient_birthday;
$conn = new mysqli("localhost", "root", "", "appointment");
$sql = "UPDATE `appointment` 
        SET  `status` = '{$x->aa}'
        WHERE `appointment`.`idappointment` = '{$x->bb}';";
       
$result = $conn->query($sql);
echo $sql;
if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
   
$conn->close();

?>
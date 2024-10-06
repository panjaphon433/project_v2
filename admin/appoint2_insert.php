<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input'));

$conn = new mysqli("localhost", "root", "", "appointment");
$sql = "INSERT INTO `appointment` 
                   (`idappointment`, 
                   `HN`, 
                   `idadmin`,
                   `appointment_date`, 
                   `appointment_time`,
                   `appointment_location`,
                   `appointment_reason`, 
                   `detail`, 
                   `record_time`,
                   `status`)
        VALUES    (NULL, 
                  '{$x->HN}', 
                  '{$x->name}', 
                  '{$x->appointment_date}', 
                  '{$x->appointment_time}', 
                  '{$x->appointment_location}',
                  '{$x->appointment_reason}', 
                  '{$x->detail}', 
                  '{$x->record_time}', 
                  '{$x->status}');";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
   
$conn->close();

?>
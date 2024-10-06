<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input'));

$conn = new mysqli("localhost", "root", "", "appointment");
$sql = $sql = "INSERT INTO `patient_history` 
                          (`idpatient_history`, 
                          `HN`, 
                          `idadmin`,
                          `iddisease`, 
                          `date_treatment`, 
                          `detail`,
                          `record_time`,
                           `weight`,
                           `height`,
                             `bps`,
                             `bpd`,
                             `p`)
                VALUES    (NULL, 
                          '{$x->HN}', 
                          '{$x->idadmin}', 
                          '{$x->iddisease}', 
                          '{$x->date_treatment2}', 
                          '{$x->detail}', 
                          current_timestamp() 
                           '{$x->weight}',
                          '{$x->height}',
                          '{$x->bps}',
                          '{$x->bpd}',
                       '{$x->p}' 
                          );";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
   
$conn->close();

?>
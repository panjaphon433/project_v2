<?php
session_start();
// echo $_SESSION ["check"];
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "appointment");

$x = json_decode(file_get_contents('php://input'));

$sql = "DELETE FROM patient_history WHERE idpatient_history ='{$x->idpatient_history}'" ;
  $result = $conn->query($sql);
  //echo $sql;

  if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }

$conn->close();


?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "appointment");

$x = json_decode(file_get_contents('php://input'));

$sql = "DELETE FROM patient WHERE HN='{$x->HN}';
        DELETE FROM patient_data WHERE HN='{$x->HN}';" ;
 $result = $conn->multi_query($sql);
 //echo $sql;
$result = true;
  if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }

$conn->close();


?>
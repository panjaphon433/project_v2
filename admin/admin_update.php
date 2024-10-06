<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input'));
//var_dump($x); exit();


//$a = $x->patient_birthday;
//$date = date_create($x->patient_birthday);
//date_add($date,date_interval_create_from_date_string("1 days"));
//$y = date_format($date,"yyyy-MM-dd");
//$y = $x[0]->patient_birthday2;

$conn = new mysqli("localhost", "root", "", "appointment");
$sql = "UPDATE `admin` SET 
                              `admin_name` = '{$x->admin_name}', 
                              `admin_lastname` = '{$x->admin_lastname}', 
                              `admin_idcard` = '{$x->admin_idcard}', 
                              `admin_position` = '{$x->admin_position}', 
                              `admin_username` = '{$x->admin_username}', 
                              `admin_password` = '{$x->admin_password}'
       WHERE `admin`.`admin_idcard` = '{$x[0]->admin_idcard}';";
$result = $conn->query($sql);

// echo $sql;

if ($result === TRUE ) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
   
$conn->close();

?>
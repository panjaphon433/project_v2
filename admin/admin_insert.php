<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input')); //รับข้อมูลจาก

//$q = date("d:m:Y");บวกวันเพิ่ม 
// $date = date_create($x->birthday);
// date_add($date,date_interval_create_from_date_string("1 days"));
// $y = date_format($date, "ํY-m-d");

$conn = new mysqli("localhost", "root", "", "appointment");
$sql = "INSERT INTO `admin` 
              (
                `admin_name`, 
                `admin_lastname`, 
                `admin_position`, 
                `admin_idcard`, 
                `admin_username`, 
                `admin_password`
                )
  VALUES 
      (
      '{$x->admin_name}', 
      '{$x->admin_lastname}',
      '{$x->admin_idcard}',
      '{$x->admin_position}',  
      '{$x->admin_username}',
      '{$x->admin_password}');";

 

$result = $conn->query($sql);
//echo $sql;
if ($result === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
         
$conn->close();

?>
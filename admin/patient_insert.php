<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input')); //รับข้อมูลจาก

//$q = date("d:m:Y");บวกวันเพิ่ม 
// $date = date_create($x->birthday);
// date_add($date,date_interval_create_from_date_string("1 days"));
// $y = date_format($date, "ํY-m-d");

$conn = new mysqli("localhost", "root", "", "appointment");
$sql1 = "SELECT 
              HN, 
              patient_name , 
              patient_lastname,
              patient_idcard          
        FROM `patient` 
        WHERE  `patient_idcard` LIKE '{$x->idcard}'; ";
//  echo $sql1;
 $result1 = $conn->query($sql1);  
 $row_cnt = $result1->num_rows; 

 if ($row_cnt == 1){
    echo json_encode(0); 
 } else {
  
 if($x->sex == 1 || $x->sex == "1"){
  $prefix = "นาย";
 }else{
  $prefix = "นาง";
 }
  $sql = "SET @a = (SELECT  MAX(CAST(HN AS INT)) + 1 FROM `patient`);
  INSERT INTO `patient` 
              (`HN`, 
               `patient_name`, 
               `patient_lastname`, 
               `patient_phone`, 
               `patient_address`,
               `patient_birthday`,
               `patient_idcard`, 
               `patient_blood`, 
               `patient_password`,
               `patient_prefix`
               ) 
  VALUES 
      (@a, 
      '{$x->name}', 
      '{$x->lastname}',
      '{$x->phone}', 
      '{$x->address}',
      '{$x->birthday2}', 
      '{$x->idcard}',
      '{$x->blood}',  
      '{$x->password}',
      '{$prefix }'
      
      );

  INSERT INTO `patient_data`
               (HN, 
               `patient_nation`, 
               `patient_race`, 
               `patient_religion`, 
               `patient_degree`,
               `patient_marital`,
               `patient_occupation`, 
               `patient_sex`,
               `patient_right`,
               `patient_mom`,  
               `mom_idcard`,
               `patient_dad`, 
               `dad_idcard`,
               `patient_spouse`,
               `spouse_idcard`)
    VALUES 
      (@a, 
      '{$x->nation}', 
      '{$x->race}',
      '{$x->religion}', 
      '{$x->degree}',
      '{$x->marital}', 
      '{$x->occupation}',  
      '{$x->sex}',
      '{$x->right}',
      '{$x->mom_name}',
      '{$x->mom_idcard}',
      '{$x->dad_name}',
      '{$x->dad_idcard}',
      '{$x->spouse_name}',
      '{$x->spouse_idcard}'); "; 

      $result = $conn->multi_query($sql);
      if ($result === TRUE) {
        echo json_encode(1);
      } else {
        echo json_encode(2);
      }
    }
          
//echo $sql;
// echo $sql2;
$conn->close();

?>
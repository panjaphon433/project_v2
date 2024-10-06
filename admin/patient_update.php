<?php
error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$x = json_decode(file_get_contents('php://input'));
//var_dump($x); exit();


//$a = $x->patient_birthday;
//$date = date_create($x->patient_birthday);
//date_add($date,date_interval_create_from_date_string("1 days"));
//$y = date_format($date,"yyyy-MM-dd");
//$y = $x[0]->patient_birthday2;


if ($x[0]->patient_prefix == 'ชาย') {
  $x[0]->patient_prefix = 'นาย';
}else{
  
}

$conn = new mysqli("localhost", "root", "", "appointment");
$sql = "UPDATE `patient` SET `HN` = '{$x[0]->HN}', 
                              `patient_name` = '{$x[0]->patient_name}', 
                              `patient_lastname` = '{$x[0]->patient_lastname}', 
                              `patient_phone` = '{$x[0]->patient_phone}',
                              `patient_birthday` = '{$x[0]->patient_birthday2}',
                              `patient_idcard` = '{$x[0]->patient_idcard}',
                              `patient_address` = '{$x[0]->patient_address}', 
                              `patient_blood` = '{$x[0]->patient_blood}', 
                              `patient_password` = '{$x[0]->patient_password}',
                              `patient_phone` = '{$x[0]->patient_phone}',
                              `patient_prefix` = '{$x[0]->patient_prefix}',
                              `village_no` = '{$x[0]->village_no}',
                              `weight` = '{$x[0]->weight}',
                              `height` = '{$x[0]->height}',
                              `bps` = '{$x[0]->bps	}',
                              `bpd` = '{$x[0]->bpdc	}',
                              `p` = '{$x[0]->p	}',
                              `waistline` = '{$x[0]->waistline}'
                              
                              
       WHERE `patient`.`HN` = '{$x[0]->HN}';";
// echo $sql;
$result = $conn->query($sql);

$sql2 = "UPDATE `patient_data` SET `HN` = '{$x[0]->HN}', 
                              `patient_nation` = '{$x[1]->patient_nation}', 
                              `patient_race` = '{$x[1]->patient_race}', 
                              `patient_religion` = '{$x[1]->patient_religion}',
                              `patient_degree` = '{$x[1]->patient_degree}',
                              `patient_marital` = '{$x[1]->patient_marital}', 
                              `patient_occupation` = '{$x[1]->patient_occupation}', 
                              `patient_sex` = '{$x[1]->patient_sex}',
                              `patient_right` = '{$x[1]->patient_right}',
                              `patient_mom` = '{$x[1]->patient_mom}',
                              `mom_idcard` = '{$x[1]->mom_idcard}',
                              `patient_dad` = '{$x[1]->patient_dad}',
                              `dad_idcard` = '{$x[1]->dad_idcard}',
                              `patient_spouse` = '{$x[1]->patient_spouse}', 
                              `spouse_idcard` = '{$x[1]->spouse_idcard}'
       WHERE `patient_data`.`HN` = '{$x[0]->HN}';";
$result1 = $conn->query($sql2);

// echo $sql2;

if ($result === TRUE && $result1 === TRUE) {
    echo json_encode(1);
  } else {
    echo json_encode(0);
  }
   
$conn->close();

?>
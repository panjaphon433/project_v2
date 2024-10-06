<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");
//if(($s->key) == NULL ){ echo "a";} else {echo $s->key ;}
//if(($s->date) == NULL){ echo "b";} else {echo $s->date ;}

//var_dump($s); เช็ค ตัวแปร 
$sql = "SELECT  appointment.idappointment, 
                patient.HN, 
                patient.patient_name, 
                patient.patient_lastname, 
                appointment.appointment_date, 
                appointment_time.time_name, 
                appointment_location.location_name, 
                appointment_reason.reason_name, 
                admin.admin_name, admin.admin_lastname,
                appointment.appointment_time,
                appointment.appointment_location,
                appointment.appointment_reason,
                admin.idadmin, 
                admin.admin_name, 
                admin.admin_lastname 
                FROM `appointment`
                INNER JOIN `patient`ON appointment.HN=patient.HN 
                LEFT JOIN `admin`ON appointment.idadmin=admin.idadmin 
                LEFT JOIN `appointment_time`ON appointment.appointment_time=appointment_time.id_time 
                LEFT JOIN `appointment_location`ON appointment.appointment_location=appointment_location.idlocation 
                LEFT JOIN `appointment_reason`ON appointment.appointment_reason=appointment_reason.idreason
               ";
                //  ORDER BY  appointment.appointment_date DESC;";
                if(($s->key)!= NULL & ($s->date) != NULl  ){ // เลือก ทุกอย่าง ค่าไม่ว่าง ให้แสดง 
                    $sql .= " WHERE (patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%' ) AND `appointment_date` = '{$s->date}' AND `status` = '{$s->status}';"; 
                }
                else if(($s->key) != NULL & ($s->date) != NULl ){ //เลือกแค่ key + date เหมือนแสดง 
                    $sql .= " WHERE (patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%') AND `appointment_date` = '{$s->date}';"; 
                }
                else if(($s->key) != NULL  ){ //เลือกแค่ key + status เหมือนแสดง 
                    $sql .= " WHERE (patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%');"; 
                }
                else if(($s->date) != NULL & ($s->status) != NULl ){ //เลือกแค่ date + status เหมือนแสดง 
                    $sql .= " WHERE `appointment_date` = '{$s->date}';"; 
                }
                else if(($s->key)== NULL & ($s->date) == NULl ){ // ไม่เลือกอะไรเลย แสดงหมด
                    $sql .= " WHERE 1"; 
                }
                else if(($s->key) != NULL ){ //เลือกแค่ key แสดงแค่เหมือน key  
                    $sql .= " WHERE (patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%' );"; 
                }
                else if(($s->date) != NULL) // เลือกแค่ date แสดงแค่เหมือน date 
                { 
                    $sql .= " WHERE (`appointment_date` = '{$s->date}' );"; 
                }
                
                //echo $sql;
        
$result = $conn->query($sql);
$x = $result -> fetch_all(MYSQLI_ASSOC);


echo json_encode($x);
$result -> free_result();
$conn->close();


?>
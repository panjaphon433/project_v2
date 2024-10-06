<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");
//if(($s->key) == NULL ){ echo "a";} else {echo $s->key ;}
//if(($s->date) == NULL){ echo "b";} else {echo $s->date ;}

//var_dump($s); เช็ค ตัวแปร 
//set key เป็น null ถ้ามัน null ไม่มีข้อมูลให้แสดงทั้งหมดที่หน้า view 
$s->key = "";
$sql = "SELECT  appointment.idappointment, 
                patient.HN, 
                patient.patient_name, 
                patient.patient_lastname, 
                patient.patient_phone, 
                appointment.appointment_date, 
                appointment_time.time_name, 
                appointment_location.location_name, 
                appointment_reason.reason_name, 
                appointment_status.status_name,
                appointment.appointment_time,
                appointment.status,
                appointment.appointment_location,
                appointment.appointment_reason,
                appointment.detail,
                admin.idadmin, 
                admin.admin_name, 
                admin.admin_lastname
                FROM `appointment`
                INNER JOIN `patient`ON appointment.HN=patient.HN 
                LEFT JOIN `admin`ON appointment.idadmin=admin.idadmin 
                LEFT JOIN `appointment_time`ON appointment.appointment_time=appointment_time.id_time 
                LEFT JOIN `appointment_location`ON appointment.appointment_location=appointment_location.idlocation 
                LEFT JOIN `appointment_reason`ON appointment.appointment_reason=appointment_reason.idreason
                LEFT JOIN `appointment_status`ON appointment.status=appointment_status.idstatus";
                //  ORDER BY  appointment.appointment_date DESC;";
                if(($s->key) != NULL){
                    $w1 = "(patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%' )";
                }else{
                    $w1 = 1;
                }
                if(($s->date) != NULL){
                    $w2 = "(appointment_date = '{$s->date}')";
                }else{$w2 =1;}
                // if(($s->status) != NULL){ ใช้ทุกค่าที่มี null ก็ใช้ 
                    $w3 = "(status = '{$s->status}')";
                // }else{
                //     $w3 = '(status = "")';} 
                if(($s->time) != NULL){
                    $w4 = "(appointment_time = '{$s->time}')";
                }else{$w4 = 1;}
                $where = " WHERE " . $w1 . " AND " . $w2 . " AND " . $w3 . " AND " . $w4 ;
                $sql .= $where;
                
                  
                //echo $sql;
        
$result = $conn->query($sql);
$x = $result -> fetch_all(MYSQLI_ASSOC);


echo json_encode($x);
$result -> free_result();
$conn->close();


?>
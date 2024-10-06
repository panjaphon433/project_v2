<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");

$sql_1 = "SELECT  appointment.idappointment, 
                patient.HN, 
                patient.patient_name, 
                patient.patient_lastname, 
                patient.patient_phone, 
                appointment.appointment_date, 
                appointment_time.time_name,      
                appointment_reason.reason_name, 
                appointment_status.status_name,
                appointment.appointment_time,
                appointment.status,
                appointment.appointment_reason";

$sql_2 = " FROM `appointment`
                INNER JOIN `patient`ON appointment.HN=patient.HN 
                LEFT JOIN `appointment_time`ON appointment.appointment_time=appointment_time.id_time 
                LEFT JOIN `appointment_reason`ON appointment.appointment_reason=appointment_reason.idreason
                LEFT JOIN `appointment_status`ON appointment.status=appointment_status.idstatus";

// ตรวจสอบค่า date
if (empty($s->date) || $s->date == "") {
    $w2 = 1; // ถ้าไม่มีวันที่ให้ค้นหาทุกวันที่
} else {
    $w2 = "(appointment_date = '{$s->date}')";
}

// ตรวจสอบค่า month
if (empty($s->month) || $s->month == "") {
    $w1 = 1; // ถ้าไม่มีเดือนให้ค้นหาทุกเดือน
} else {
    $w1 = "(appointment_date LIKE '{$s->month}%')";
}

// ตรวจสอบค่า status
if (empty($s->status) || $s->status == "") {
    $w3 = 1; // ถ้าไม่มีสถานะให้ค้นหาทุกสถานะ
} else {
    $w3 = "(status = '{$s->status}')";
}

// ตรวจสอบค่า time
if (empty($s->time) || $s->time == "") {
    $w4 = 1; // ถ้าไม่มีเวลานัดหมายให้ค้นหาทุกเวลา
} else {
    $w4 = "(appointment_time = '{$s->time}')";
}

$where = " WHERE " . $w1 . " AND " . $w2 . " AND " . $w3 . " AND " . $w4;
$sql_2 .= $where;

// รัน SQL คำสั่งแรกเพื่อดึงข้อมูลหลัก
$result = $conn->query($sql_1 . $sql_2);
$x = $result->fetch_all(MYSQLI_ASSOC);
$result->free_result();

// คำสั่ง SQL สำหรับการนับจำนวนข้อมูลตามวันที่และสถานะ
$sql_3 = " SELECT  appointment.appointment_date, appointment_status.status_name, COUNT(*) AS CNT ";
$sql_4 = " GROUP BY appointment.appointment_date, appointment_status.status_name ";
$sql_5 = $sql_3 . $sql_2 . $sql_4;

$result = $conn->query($sql_5);
$x2 = $result->fetch_all(MYSQLI_ASSOC);

// คำสั่ง SQL สำหรับการนับจำนวนข้อมูลตามเดือน
$sql_3 = ' SELECT TRIM(RIGHT (SUBSTRING_INDEX(`appointment_date`, "-", 2), 2 ))AS Month , COUNT(*) AS CNT ';
$sql_4 = " GROUP BY Month ";
$sql_5 = $sql_3 . $sql_2 . $sql_4;

$result = $conn->query($sql_5);
$x3 = $result->fetch_all(MYSQLI_ASSOC);

// ส่งผลลัพธ์ทั้งหมดกลับเป็น JSON
echo json_encode([$x, $x2, $x3]);

$conn->close();

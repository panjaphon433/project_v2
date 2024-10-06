<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// รับข้อมูล JSON จาก client
$s = json_decode(file_get_contents('php://input'));

// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$conn = new mysqli("localhost", "root", "", "appointment");

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query สำหรับ admin โดยไม่ใช้ prepare
$sql_admin = "SELECT  
                admin_username, 
                admin_password,
                admin_position,
                idadmin	
            FROM admin 
            WHERE admin_username = '{$s->admin_username}' 
            AND admin_password = '{$s->admin_password}';";

// SQL query สำหรับ user (patient) โดยไม่ใช้ prepare
$sql_user = "SELECT  
                HN,
                patient_idcard, 
                patient_password,
                patient_name
            FROM patient 
            WHERE patient_idcard = '{$s->admin_username}' 
            AND patient_password = '{$s->admin_password}';";

// query สำหรับ admin
$result_admin = $conn->query($sql_admin);
$row_cnt_admin = $result_admin->num_rows;

// query สำหรับ user
$result_user = $conn->query($sql_user);
$row_cnt_user = $result_user->num_rows;

if ($row_cnt_admin == 1) {

    $sql_clear_date = "UPDATE appointment
                                SET status = 2
                                WHERE (status IS NULL OR status = 0) 
                                AND appointment_date < CURDATE();";

    $conn->query($sql_clear_date);


    $x = $result_admin->fetch_assoc();
    $_SESSION["check"] = $x["idadmin"];
    $_SESSION["check_position"] = $x["admin_position"];
    $response = array(
        "status" => 1,
        "position" => $x["admin_position"]
    );
    echo json_encode($response);
} elseif ($row_cnt_user == 1) {
    $x = $result_user->fetch_assoc();
    
    $_SESSION["check"] = $x["HN"];
    $_SESSION["name"] = $x["patient_name"];
    $_SESSION["IDCard"] = $x["patient_idcard"];
    $response = array(
        "status" => 1,
        "position" => $x["patient_name"]
    );
    echo json_encode($response);
} else {
    $response = array("status" => 0, "message" => "Invalid credentials");
    echo json_encode($response);
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

<?php

error_reporting(0   );
$input = json_decode(file_get_contents('php://input'));
$email = $input->email;
$user = $input->user;

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('location: index.php');
    exit();
} else {

    // Query เพื่อดึงข้อมูลผู้ใช้ตาม HN ที่ได้รับ
    $conn = new mysqli("localhost", "root", "", "appointment");

    $sql = "SELECT * FROM patient WHERE HN =  $input->hn";
    $result = mysqli_query($conn, $sql); //สมมติว่าใช้ mysqli

    // ตรวจสอบว่าผู้ใช้นี้มีข้อมูลหรือไม่
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // ตรวจสอบว่ามี token อยู่ในข้อมูลผู้ใช้หรือไม่
        if (!empty($row['token'])) {
            $sToken = $row['token']; // ใช้ token จากฐานข้อมูล

            $sMessage = "แจ้งเตือนการนัดหมาย \n";
            $sMessage .= "คุณ: " . $row['patient_name'] . " " . $row['patient_lastname'] . "\n";
            $sMessage .= "เบอร์โทรศัพท์: " . $row['patient_phone'] . "\n";
            $sMessage .= "สถานที่นัดหมาย: " . $input->data->location_name . "\n";
            $sMessage .= "วันที่นัดหมาย: " . $input->data->appointment_date . "\n";
            $sMessage .= "เวลาที่นัดหมาย: " . $input->data->time_name . "\n";
            $sMessage .= "กรุณาติดต่อโรงพยาบาลเพื่อยืนยันการนัดหมายของคุณ \n";

            $chOne = curl_init();
            curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($chOne, CURLOPT_POST, 1);
            curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
            $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($chOne);

            // ตรวจสอบความผิดพลาดจากการส่งแจ้งเตือน
            if (curl_error($chOne)) {
                echo 'error:' . curl_error($chOne);
            } else {
                $result_ = json_decode($result, true);
                echo json_encode($result_['status']);
            }
            curl_close($chOne);
        } else {
            // กรณีที่ไม่มี Token ให้แจ้งกลับไปที่ Controller
            echo json_encode(['status' => 'error', 'message' => 'ผู้ใช้ไม่มี Token']);
        }
    } else {
        // กรณีที่ไม่พบผู้ใช้
        echo json_encode(['status' => 'error', 'message' => 'ไม่พบข้อมูลผู้ใช้']);
    }
}

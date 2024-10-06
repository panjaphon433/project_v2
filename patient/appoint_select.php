<?php
session_start();
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");


$sql = "SELECT  appointment.idappointment, 
                patient.HN, 
                patient.patient_name , 
                patient.patient_lastname, 
                appointment.appointment_date, 
                appointment.appointment_time, 
                appointment_time.time_name,
                appointment.appointment_location, 
                appointment_location.location_name,
                appointment.appointment_reason, 
                appointment_reason.reason_name,
                appointment.record_time, 
                appointment.status, 
                appointment_status.status_name,
                admin.admin_name, 
                admin.admin_lastname
        FROM `appointment` 
        INNER JOIN `patient` ON appointment.HN = patient.HN 
        INNER JOIN `admin`ON appointment.idadmin = admin.idadmin 
        INNER JOIN `appointment_time`ON appointment.appointment_time = appointment_time.id_time 
        INNER JOIN `appointment_location`ON appointment.appointment_location = appointment_location.idlocation 
        INNER JOIN `appointment_reason`ON appointment.appointment_reason = appointment_reason.idreason
        LEFT JOIN `appointment_status`ON appointment.status = appointment_status.idstatus
        WHERE  `patient`.`HN` LIKE '{$_SESSION["check"]}' 
        ORDER BY appointment.appointment_date DESC ;";
        //echo $sql;
$result = $conn->query($sql);

$x = $result -> fetch_all(MYSQLI_ASSOC);
                
                
        echo json_encode($x);
        $result -> free_result();
$conn->close();


?>
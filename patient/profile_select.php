<?php
session_start();
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");

// WHERE `HN`

$sql = "SELECT  patient.HN, 
                patient.patient_name, 
                TIMESTAMPDIFF(year, patient_birthday, now())+1 AS Age ,
                patient.patient_lastname,
                patient.patient_birthday,
                patient.patient_idcard,
                patient.patient_birthday,
                patient.patient_address,
                patient.patient_phone,
                patient.patient_blood,
                patient.patient_blood,
                patient.patient_password
        FROM `patient` 
        WHERE patient.HN LIKE '{$_SESSION["check"]}';";
                //echo $sql;

$result = $conn->query($sql);
// SELECT * FROM `patient` WHERE `patient_name` LIKE '{$s->key}%' OR `patient_lastname` LIKE '{$s->key}%' OR `HN` LIKE '{$s->key}%';";
//echo $sql;

$x = $result -> fetch_all(MYSQLI_ASSOC);

echo json_encode($x);
$result -> free_result();
$conn->close();


?>
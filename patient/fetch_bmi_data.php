<?php
session_start();
if ($_SESSION == NULL) {
  header("location:../patientlogin.php");
  exit();
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "appointment");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT patient.HN, patient.patient_name, patient.patient_lastname, patient.weight, patient.heigth 
        FROM patient 
        JOIN appointment ON patient.HN = appointment.HN 
        WHERE appointment.idappointment = '{$_SESSION["check"]}'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $patients = [];
    while($row = $result->fetch_assoc()) {
        $bmi = round($row['weight'] / (($row['heigth'] / 100) ** 2), 1); // Calculate BMI
        $row['bmi'] = $bmi; // Add BMI to the data
        $patients[] = $row;
    }
    echo json_encode($patients);
} else {
    echo json_encode([]);
}

$conn->close();
?>

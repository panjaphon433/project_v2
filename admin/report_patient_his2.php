<?php
session_start();
// echo $_SESSION ["check"];

?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");


$sql_1 = " SELECT  patient_history.idpatient_history, 
                patient.HN, 
                patient.patient_name , 
                patient.patient_lastname, 
                disease.disease_name,
                disease.iddisease,
                patient_history.detail, 
                patient_history.date_treatment, 
                admin.idadmin, 
                admin.admin_name, 
                admin.admin_lastname";
$sql_2 =        " FROM `patient_history` 
                INNER JOIN `patient` ON patient_history.HN = patient.HN 
                INNER JOIN `admin`ON patient_history.idadmin = admin.idadmin 
                LEFT JOIN `disease`ON patient_history.iddisease= disease.iddisease";
  
                $w3 = "(patient_history.iddisease = '{$s->disease}')";
                $where = " WHERE " . $w3;
                $sql_2 .= $where;
                //WHERE `patient_history`.`iddisease` LIKE '{$s->disease}'";
//echo $sql;
$result = $conn->query($sql_1.$sql_2);
$x = $result -> fetch_all(MYSQLI_ASSOC);


// echo json_encode($x);
$result -> free_result();
$sql_3 = " SELECT  disease.disease_name, patient_history.date_treatment , admin.admin_name, admin.admin_lastname , COUNT(*) AS CNT ";
$sql_4 = "GROUP BY disease.disease_name, patient_history.date_treatment , admin.admin_name, admin.admin_lastname";
$sql_5 = $sql_3 . $sql_2 . $sql_4 ;
// echo $sql_5;

$result = $conn->query($sql_5);
$x2 = $result -> fetch_all(MYSQLI_ASSOC);
echo json_encode([$x,$x2]);
$conn->close();





?>
        
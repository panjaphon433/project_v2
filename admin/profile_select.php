<?php
session_start();
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");

// WHERE `HN`

$sql = "SELECT  idadmin , 
                admin_name,
                admin_lastname,
                admin_position,
                admin_idcard,
                admin_username,
                admin_password
        FROM `admin` 
        WHERE `admin`.`idadmin` LIKE '{$_SESSION["check"]}';";
        //        echo $sql;

$result = $conn->query($sql);
// SELECT * FROM `patient` WHERE `patient_name` LIKE '{$s->key}%' OR `patient_lastname` LIKE '{$s->key}%' OR `HN` LIKE '{$s->key}%';";
//echo $sql;

$x = $result -> fetch_all(MYSQLI_ASSOC);

echo json_encode($x);
$result -> free_result();
$conn->close();


?>
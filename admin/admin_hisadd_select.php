<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$s = json_decode(file_get_contents('php://input')); //รับ
$conn = new mysqli("localhost", "root", "", "appointment");


$sql =  "SELECT   
                idadmin, 
                admin.admin_name , 
                admin.admin_lastname
        FROM `admin` 
        ";
                //echo $sql;
$result = $conn->query($sql);
$x = $result -> fetch_all(MYSQLI_ASSOC);

echo json_encode($x);
$result -> free_result();
$conn->close();


?>
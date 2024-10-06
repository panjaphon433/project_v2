<?php 
    header('Content-Type: application/json');

    require_once 'gt.php';

    $sqlQuery = "SELECT * FROM graph ORDER BY high ";
    $result = mysqli_query($conn, $sqlQuery);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($data);

?>
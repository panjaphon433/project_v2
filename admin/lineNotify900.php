
<?php

$sToken = "fqLIMZUOjhQ002WfezKx35kbVT8jiHc5qg4z5OgGUgO";
$sMessage = "โรงพยาบาลส่งเสริมสุขภาพตำบลแม่กา\n";
$sMessage .= "ชื่อ \n";
$sMessage .= "การนัดหมาย \n";
$sMessage .= "เวลานัดหมาย \n";
$sMessage .= "โปรดเข้าไปที่ http://localhost/appoint-project/patient/appoint.php\n";
$sMessage .= "เมนู > การนัดหมาย > แล้วตรวจสอบการนัดหมาย \n";


$chOne = curl_init(); 
curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt( $chOne, CURLOPT_POST, 1); 
curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 

//Result error 
if(curl_error($chOne)) 
{ 
    echo 'error:' . curl_error($chOne); 
} 
else { 
    $result_ = json_decode($result, true); 
    echo "status : ".$result_['status']; echo "message : ". $result_['message'];
} 
curl_close( $chOne );   


?>

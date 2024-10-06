<?php
session_start();
if ($_SESSION == NULL) {
  header("location:../patientlogin.php");
  exit();
}
//echo $_SESSION["check"]; ตัวแกร check HN จะถูกใช้ตลอด
// if ($_SESSION == NULL) {
//   header("location:../patientlogin.php");
//   exit();
// }
?>
<!doctype html>
<html ng-app="patientApp" lang="th">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="appoint.js"></script>
    <title>แนะนำสุขภาพ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-image: url('/appoint-project/admin/images/lio.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
        }

        .video-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
        }

        iframe {
            width: 560px;
            height: 315px;
        }

        .video-title {
            font-size: 1.2em;
            margin-top: 10px;
            text-align: center;
        }

        .main-content {
            text-align: center;
            padding: 20px;
        }
        
    </style>
  </head>
<body >
    <?php include 'nav.php';?>
    <div class="main-content">
        <h1>แนะนำการดูแลสุขภาพ</h1>
    </div>

    
<div class="video-item">
    <iframe src="https://www.youtube.com/embed/ZM7AS5-w_cE" frameborder="0" allowfullscreen></iframe>
      <div class="text-bg-light p-3">แนวทางการดูแลรักษาโรคเบาหวาน</div>
    
</div>

<div class="video-item">
<
    <iframe src="https://www.youtube.com/embed/4Qi4sr_1E1M" frameborder="0" allowfullscreen></iframe>
      <div class="text-bg-light p-3">แนวทางการดูแลรักษาโรคความดันโลหิต</div>
   
</div>

<div class="video-item">
    <iframe src="https://www.youtube.com/embed/fR3wUaFcobM" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาไตเรื้อรัง</div>
    
</div>


<div class="video-item">
 
    <iframe src="https://www.youtube.com/embed/SXFoZHLg6CQ" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาโรคหัวใจ</div>
    
    
</div>

<div class="video-item">
    <iframe src="https://www.youtube.com/embed/NRm-uYrrb0s" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการรักษาโรคปอด</div>
    
</div>


<div class="video-item">
    <iframe src="https://www.youtube.com/embed/9qkBzTiK0Mg" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาโรคทางเดินอาหาร</div>
    
</div>


<div class="video-item">
    <iframe src="https://www.youtube.com/embed/D449QcTab4A" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาโรคซึมเศร้า</div>
    
</div>

<div class="video-item">
    <iframe src="https://www.youtube.com/embed/n70glotYT7Y" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาโรคอ้วน</div>
    
</div>

<div class="video-item">
    <iframe src="https://www.youtube.com/embed/r_QwlyAWmIk" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาโรคเหงือกและฟัน</div>
    
</div>

<div class="video-item">
    <iframe src="https://www.youtube.com/embed/_EKbGxTH9Zw" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาโรคมะเร็ง</div>
    
</div>

<div class="video-item">
    <iframe src="https://www.youtube.com/embed/kca7GiH7FUI" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาโรคทางเดินหารใจเรื้อรัง</div>
    
  
</div>

<div class="video-item">
    <iframe src="https://www.youtube.com/embed/WpH48hLeBAo" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาโรคหลอดเลือดในสมอง</div>
    
</div>




<div class="video-item">
    <iframe src="https://www.youtube.com/embed/bLOswhfITuk" frameborder="0" allowfullscreen></iframe>
    <div class="video-title">แนวทางการดูแลรักษาโรคเก้าฑ์</div>
   
</div>



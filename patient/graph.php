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
  <script src="graph.js"></script>
  <title>สถิติผู้ป่วย</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


  <!-- ChatJS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


  <style>
    .tbody-content {
      text-align: center;
    }

    .head-content th {
      background-color: #333a73;
      color: #fff;
    }

    .head-content {
      text-align: center;
    }
    
  </style>
</head>
<style>
  body {
    /* background-image: url('/appoint-project/admin/images/lio.png'); */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    /* ความสูงเต็มหน้าจอ */
    margin: 0;
  }
</style>

</head>

<body ng-controller="GraphController">
  <?php include 'nav.php'; ?>
  <br>

  <div class="container-fluid" ng-init="select();">
    <h2 class="text-center">สถิติค่า BMI</h2>
    <div id="chartsContainer" class="row">

    </div>



  </div>




</body>


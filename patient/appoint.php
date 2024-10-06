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
    <title>หน้าการนัดหมาย</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
    <style>
    .tbody-content{
      text-align: center;
    }
    .head-content th{
      background-color: #333a73;
      color: #fff;
    }
    .head-content{
      text-align: center;
    }
  </style>
  </head>
  <style>
        body {
            background-image: url('/appoint-project/admin/images/lio.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /* ความสูงเต็มหน้าจอ */
  margin: 0;
        }
    </style>
</head>
<body>

  <body ng-controller="AppointshowController">
    <?php include 'nav.php';?>
    <br>
      <h1 class="fw-bold">การนัดหมาย: รหัสผู้ป่วย {{list[0].HN}} ชื่อ-นามสกุล {{list[0].patient_name}} {{list[0].patient_lastname}}</h1>
     
      <div class = "container">
        <br/><br/>
        <table class="table table-hover table-striped">
                <thead class="table-head">
                  <tr class="head-content">
                    <th>ลำดับ</th>
                    <th>วันที่นัดหมาย</th>
                    <th>เวลานัดหมาย</th>
                    <th>สถานที่นัดหมาย</th>
                    <th>สาเหตุการนัด</th>
                    <th>สิ่งที่ต้องปฏิบัติ</th>
                    <th>แพทย์ผู้นัด</th>
                    <th>สถานะการนัดหมาย</th>
                  </tr>
                </thead>
                <tbody ng-init="select(<?php  echo $_SESSION['check']; ?>);" class="tbody-content">                 
                  <tr ng-repeat = 'val in list track by $index' class="tbody-content"> 
                    <td>{{$index+1}}</td>
                    <td>{{val.appointment_date | date:'dd-MM-yyyy'}}</td>
                    <td>{{val.time_name}}</td>
                    <td>{{val.location_name}}</td>
                    <td>{{val.reason_name}}</td>
                    <td>{{val.detail}}</td>
                    <td>{{val.admin_name}}   {{val.admin_lastname}}</td>
                    <td>{{val.status_name}}</td>
                  </tr> 
                </tbody>
        </table>
      </div>   
      </div> 
    </div>
    
      <!-- Button trigger modal เอาไว้ใส่ย้อยกลับ หรืออะไรเอา-->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
   เพิ่มการนัดหมาย 
  </button> -->

   <!-- Modal popup-->
   <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{a}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>
 
</body>
</html>
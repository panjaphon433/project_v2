<?php
session_start();
// echo $_SESSION ["check"];
if ($_SESSION == NULL) {
  header("location:../adminlogin.php");
  exit();
}
// else if ($_SESSION["admin_position"] != "แพทย์" ) {
//   header("location:../admin/patient_his.php");
//   exit();
// }
?>
<!doctype html>
<html ng-app="patientApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="appoint2.js"></script>
  <title>ประวัติการนัดหมาย</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>

  </style>


</head>

<body ng-controller="Appoint2Controller"  ng-init="select2()">
  <?php include 'navbar_admin.php'; ?>

  <!-- Main container -->
  <div class="container my-4">
    <!-- Header section -->
    <div class="text-center mb-4">
      <h1 class="display-5">รายงานการนัดหมาย</h1>
    </div>

    <!-- Search filters -->
    <div class="row g-3 mb-4">
      <div class="col-md-3 col-sm-6">
        <b>ค้นหาเดือน:</b>
        <input ng-model="s.month0" type="month" class="form-control" placeholder="กรุณากรอกเดือน" />
      </div>
      <div class="col-md-3 col-sm-6">
        <b>ค้นหาวันที่นัดหมาย:</b>
        <input ng-model="s.date0" type="date" class="form-control" placeholder="กรุณากรอกวันเดือนปีที่นัด" />
      </div>
      <div class="col-md-3 col-sm-6">
        <b>เลือกเวลานัดหมาย:</b>
        <select class="form-select" ng-model="s.time">
          <option value="">เลือกช่วงเวลา</option>
          <option value="1">ช่วงเช้า เวลา 08:00 น. - 12:00 น.</option>
          <option value="2">ช่วงบ่าย เวลา 13:00 น. - 16:00 น.</option>
        </select>
      </div>
      <div class="col-md-3 col-sm-6">
        <b>เลือกสถานะการนัดหมาย:</b>
        <select class="form-select" ng-model="s.status">
          <option value="">ยังไม่มาตามนัด</option>
          <option value="1">มาตามนัดหมายแล้ว</option>
          <option value="2">ไม่มาตามนัด</option>
        </select>
      </div>
    </div>

    <!-- Action buttons -->
    <div class="d-flex justify-content-between mb-4">
      <button class="btn btn-primary" ng-click="select2()">แสดงข้อมูลการนัดหมาย</button>
      <input type="button" class="btn btn-primary" onclick="javascript:print()" value="สั่งพิมพ์รายงานการนัดหมาย">
    </div>

    <!-- Appointment Table -->
    <div class="table-responsive">
      <table class="table table-hover table-striped">
        <thead class="table-secondary">
          <tr>
            <th>ลำดับ</th>
            <th>HN</th>
            <th>ชื่อ-สกุลผู้ป่วย</th>
            <th>เบอร์โทรติดต่อ</th>
            <th>วันที่นัดหมาย</th>
            <th>เวลานัดหมาย</th>
            <th>สาเหตุการนัด</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat='val in list track by $index'>
            <td>{{$index+1}}</td>
            <td>{{val.HN}}</td>
            <td>{{val.patient_name}} {{val.patient_lastname}}</td>
            <td>{{val.patient_phone}}</td>
            <td>{{val.appointment_date | date:'yyyy-MM-dd'}}</td>
            <td>{{val.time_name}}</td>
            <td>{{val.reason_name}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Appointment Statistics -->
    <div class="mt-5">
      <h2 class="h4">สถิติการนัดหมาย</h2>
      <table class="table table-hover table-striped">
        <thead class="table-secondary">
          <tr>
            <th>วันที่นัดหมาย</th>
            <th>จำนวนการนัดหมายทั้งหมด</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat='val in list2'>
            <td>{{val.appointment_date}}</td>
            <td>{{val.CNT}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Monthly Report -->
    <div class="mt-5">
      <h2 class="h4">รายงานการนัดหมายประจำเดือน</h2>
      <table class="table table-hover table-striped">
        <thead class="table-secondary">
          <tr>
            <th>ประจำเดือน</th>
            <th>จำนวนการนัดหมายทั้งหมด</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat='val in list3'>
            <td>{{val.Month}}</td>
            <td>{{val.CNT}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการนัดหมาย</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{a}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>



</html>
<?php
session_start();
// echo $_SESSION ["check"];

// echo $_SESSION ["check"];
if ($_SESSION == NULL) {
  header("location:../adminlogin.php");
  exit();
}
?>


<!doctype html>
<html ng-app="adminApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="profile.js"></script>
  <title>หน้าโปรไฟล์</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <style>
    body {
      background-image: url('/appoint-project/admin/images/lio.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      height: 100vh;
      margin: 0;
    }

    /* General Styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.profile-container {
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.profile-card {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  padding: 20px;
}

.profile-header {
  display: flex;
  align-items: center;
}

.profile-header img {
  border-radius: 50%;
  width: 100px;
  height: 100px;
  margin-right: 20px;
}

.profile-details {
  flex-grow: 1;
}

.profile-details h2 {
  margin: 0 0 10px;
  font-size: 24px;
}

.profile-details p {
  margin: 5px 0;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin: -10px;
}

.col-md-6 {
  flex: 1 1 50%;
  padding: 10px;
}

.card {
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 20px;
}

.card h5 {
  font-size: 18px;
  margin-bottom: 10px;
}

/* Responsive for smaller screens */
@media (max-width: 768px) {
  .profile-header {
    flex-direction: column;
    text-align: center;
  }

  .profile-header img {
    margin: 0 auto 10px;
  }

  .col-md-6 {
    flex: 1 1 100%;
  }

  .card {
    padding: 15px;
  }

  .profile-details h2 {
    font-size: 20px;
  }
}

/* Responsive for larger screens */
@media (min-width: 1200px) {
  .profile-container {
    padding: 40px;
  }

  .profile-header img {
    width: 120px;
    height: 120px;
  }

  .profile-details h2 {
    font-size: 28px;
  }

  .card {
    padding: 30px;
  }
}

  </style>
</head>

  <body ng-controller="AdminshowController" ng-init="select()">
    <?php include 'navbar_admin.php'; ?>
    <br>
    <!-- <h1 class="fw-bold">เจ้าหน้าที่ที่เข้าสู่ระบบ: {{list[0].admin_name}} {{list[0].admin_lastname}} {{list[0].admin_position}}</h1> -->



    <div class="profile-container">
    <div class="profile-card">
      <div class="profile-header">
        <img src="https://cdn.pixabay.com/photo/2013/07/13/13/38/man-161282_640.png" alt="Profile Picture">
        <div class="profile-details">
          <h2>ชื่อ-สกุล: {{list[0].admin_name}} {{list[0].admin_lastname}}</h2>
          <p>เลขประจำตัวประชาชน: {{list[0].admin_idcard}}</p>
          <p>ตำแหน่ง : {{list[0].admin_position}}</p>
          <p>ชื่อผู้ใช้งาน: {{list[0].admin_username}}</p>
          <p>รหัสผ่าน: {{list[0].admin_password}}</p>
      
        </div>
      </div>
    </div>

 

  <!-- Modal popup-->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="popup" data-keyboard="false" data-backdrop="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- <button type="button" class="btn btn-secondary" ng-click="test()">Close</button> -->

</body>

</html>
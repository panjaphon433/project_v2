<?php
session_start();
if ($_SESSION == NULL) {
  header("location:../patientlogin.php");
  exit();
}
?>


<!doctype html>
<html ng-app="patientApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="profile.js"></script>
  <title>หน้าโปรไฟล์</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <style>
    body {
      background-image: url('/appoint-project/admin/images/lio.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      height: 100%;
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
</head>

<body ng-controller="PatientshowController" ng-init="select();">
  <?php include 'nav.php'; ?>
  <br>
  <!-- <h3 class="fw-bold">เข้าสู่ระบบโดย: รหัสผู้ป่วย {{list[0].HN}} ชื่อ-สกุล {{list[0].patient_name}} {{list[0].patient_lastname}}</h3> -->

  <div class="profile-container">
    <div class="profile-card">
      <div class="profile-header">
        <img src="https://cdn.pixabay.com/photo/2020/02/02/03/36/business-4811925_640.png" alt="Profile Picture">
        <div class="profile-details">
          <h2>ชื่อ-สกุล: {{list[0].patient_name}} {{list[0].patient_lastname}}</h2>
          <p>รหัสผู้ป่วย (HN): {{list[0].HN}}</p>
          <p>วันเกิด: {{list[0].patient_birthday | date:'yyyy-MM-dd'}}</p>
          <p>อายุ: {{list[0].Age}}</p>
          <p>เบอร์โทรศัพท์: {{list[0].patient_phone}}</p>
          <p>ที่อยู่: {{list[0].patient_address}}</p>
        </div>
      </div>
    </div>

    <div class="profile-card" ng-init="select2(list[0].HN)">
      <h3 class="mb-3">ข้อมูลเพิ่มเติม</h3>

      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="card p-3 shadow-sm">
            <h5 class="fw-bold">ข้อมูลส่วนตัว</h5>
            <p><strong>HN:</strong> {{list2[0].HN}}</p>
            <p><strong>ชื่อ:</strong> {{list2[0].patient_name}}</p>
            <p><strong>เพศ:</strong>
              <span ng-switch on="list2[0].patient_sex">
                <span ng-switch-when="1">ชาย</span>
                <span ng-switch-when="2">หญิง</span>
              </span>
            </p>
            <p><strong>สัญชาติ:</strong>
              <span ng-switch on="list2[0].patient_nation">
                <span ng-switch-when="1">ไทย</span>
                <span ng-switch-when="2">อื่น ๆ</span>
              </span>
            </p>
            <p><strong>เชื้อชาติ:</strong>
              <span ng-switch on="list2[0].patient_race">
                <span ng-switch-when="1">ไทย</span>
                <span ng-switch-when="2">อื่น ๆ</span>
              </span>
            </p>
            <p><strong>ศาสนา:</strong>
              <span ng-switch on="list2[0].patient_religion">
                <span ng-switch-when="1">ศาสนาพุทธ</span>
                <span ng-switch-when="2">ศาสนาคริสต์</span>
                <span ng-switch-when="3">ศาสนาอิสลาม</span>
              </span>
            </p>
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <div class="card p-3 shadow-sm">
            <h5 class="fw-bold">สถานภาพและการศึกษา</h5>
            <p><strong>วุฒิการศึกษา:</strong>
              <span ng-switch on="list2[0].patient_degree">
                <span ng-switch-when="1">ประถมศึกษา</span>
                <span ng-switch-when="2">มัธยมศึกษา</span>
                <span ng-switch-when="3">อาชีวศึกษา</span>
                <span ng-switch-when="4">อุดมศึกษา</span>
              </span>
            </p>
            <p><strong>สถานภาพสมรส:</strong>
              <span ng-switch on="list2[0].patient_marital">
                <span ng-switch-when="1">จดทะเบียนสมรส</span>
                <span ng-switch-when="2">โสด</span>
              </span>
            </p>
            <p><strong>อาชีพ:</strong>
              <span ng-switch on="list2[0].patient_occupation">
                <span ng-switch-when="1">ค้าขาย</span>
                <span ng-switch-when="2">เกษตรกร</span>
                <span ng-switch-when="3">ธุรกิจส่วนตัว</span>
                <span ng-switch-when="4">ข้าราชการ</span>
                <span ng-switch-when="5">นักเรียน</span>
                <span ng-switch-when="6">อื่น ๆ</span>
              </span>
            </p>
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <div class="card p-3 shadow-sm">
            <h5 class="fw-bold">ข้อมูลครอบครัว</h5>
            <p><strong>ชื่อมารดา:</strong> {{list2[0].patient_mom}}</p>
            <p><strong>บัตรประจำตัวประชาชนมารดา:</strong> {{list2[0].mom_idcard}}</p>
            <p><strong>ชื่อบิดา:</strong> {{list2[0].patient_dad}}</p>
            <p><strong>บัตรประจำตัวประชาชนบิดา:</strong> {{list2[0].dad_idcard}}</p>
            <p><strong>ชื่อคู่สมรส:</strong> {{list2[0].patient_spouse}}</p>
            <p><strong>บัตรประจำตัวประชาชนคู่สมรส:</strong> {{list2[0].spouse_idcard}}</p>
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <div class="card p-3 shadow-sm">
            <h5 class="fw-bold">สิทธิและสิทธิประโยชน์</h5>
            <p><strong>สิทธิ:</strong>
              <span ng-switch on="list2[0].patient_right">
                <span ng-switch-when="1">เด็กทารก (30 บาทเดิม)</span>
                <span ng-switch-when="2">ช่วงอายุ 12 - 59 ปี (30 บาทเดิม)</span>
                <span ng-switch-when="3">ผู้สูงอายุ (อายุ 60 ปีบริบูรณ์ขึ้นไป)</span>
                <span ng-switch-when="4">บุคคลในครอบครัวของผู้นำชุมชน</span>
                <span ng-switch-when="5">อื่น ๆ</span>
              </span>
            </p>
          </div>
        </div>
      </div>
    </div>


 
  </div>


  </div>
  </div>


  <!-- Modal show data patient-->
  <div class="modal fade" id="aaa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">ข้อมูลผู้ป่วยเพิ่มเติม</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-hover">
            <thead class="header-content">
              <tr class="head-content">
                <th class="text-end" rowspan="2">HN</th>
                <th class="text-end" rowspan="2">ชื่อ</th>
                <th class="text-end" rowspan="2">เพศ</th>
                <th class="text-end" rowspan="2">สัญชาติ</th>
                <th class="text-end" rowspan="2">เชื้อชาติ</th>
                <th class="text-end" rowspan="2">ศาสนา</th>
                <th class="text-end" rowspan="2">วุฒิการศึกษา</th>
                <th class="text-end" rowspan="2">สถานภาพสมรส</th>
                <th class="text-end" rowspan="2">อาชีพ</th>
                <th class="text-end" rowspan="2">สิทธิ</th>
                <th class="text-end" rowspan="2">ชื่อมารดา</th>
                <th class="text-end" rowspan="2">บัตรประจำตัวประชาชนมารดา</th>
                <th class="text-end" rowspan="2">ชื่อบิดา</th>
                <th class="text-end" rowspan="2">บัตรประจำตัวประชาชนบิดา</th>
                <th class="text-end" rowspan="2">ชื่อคู่สมรส</th>
                <th class="text-end" rowspan="2">บัตรประจำตัวประชาชนคู่สมรส</th>
              </tr>

            </thead>
            <tbody class="tbody-content">
              <tr ng-repeat='val in list2'>
                <td>{{val.HN}}</td>
                <td>{{val.patient_name}}</td>
                <td ng-switch on="val.patient_sex">
                  <span ng-switch-when="1">ชาย</span>
                  <span ng-switch-when="2">หญิง</span>
                </td>
                <td ng-switch on="val.patient_nation">
                  <span ng-switch-when="1">ไทย</span>
                  <span ng-switch-when="2">อื่น ๆ</span>
                </td>
                <td ng-switch on="val.patient_race">
                  <span ng-switch-when="1">ไทย</option>
                    <span ng-switch-when="2">อื่น ๆ</option>
                </td>
                <td ng-switch on="val.patient_religion">
                  <span ng-switch-when="1">ศาสนาพุทธ</span>
                  <span ng-switch-when="2">ศาสนาคริสต์</span>
                  <span ng-switch-when="3">ศาสนาอิสลาม</span>
                </td>
                <td ng-switch on="val.patient_degree">
                  <span ng-switch-when="1">ประถมศึกษา</span>
                  <span ng-switch-when="2">มัธยมศึกษา</span>
                  <span ng-switch-when="3">อาชีวศึกษา</span>
                  <span ng-switch-when="4">อุดมศึกษา</span>
                </td>
                <td ng-switch on="val.patient_marital">
                  <span ng-switch-when="1">จดทะเบียนสมรส</span>
                  <span ng-switch-when="2">โสด</span>
                </td>
                <td ng-switch on="val.patient_occupation">
                  <span ng-switch-when="1">ค้าขาย</span>
                  <span ng-switch-when="2">เกษตรกร</span>
                  <span ng-switch-when="3">ธุรกิจส่วนตัว</span>
                  <span ng-switch-when="4">ข้าราชการ</span>
                  <span ng-switch-when="5">นักเรียน</span>
                  <span ng-switch-when="6">อื่น ๆ</span>
                </td>
                <td ng-switch on="val.patient_right">
                  <span ng-switch-when="1">เด็กทารก ( 30 บาทเดิม )</span>
                  <span ng-switch-when="2">ช่วงอายุ 12 - 59 ปี ( 30 บาทเดิม )</span>
                  <span ng-switch-when="3">ผู้สูงอายุ ( อายุ 60 ปีบริบูรณ์ขึ้นไป )</span>
                  <span ng-switch-when="4">บุคคลในครอบครัวของผู้นำชุมชน (กำนัน,สารวัตรกำนัน,ผญบ.,ผช.,แพทย์ประจำหมู่บ้าน)</span>
                  <span ng-switch-when="5">อื่น ๆ</span>
                </td>
                <td>{{val.patient_mom}}</td>
                <td>{{val.mom_idcard}}</td>
                <td>{{val.patient_dad}}</td>
                <td>{{val.dad_idcard}}</td>
                <td>{{val.patient_spouse}}</td>
                <td>{{val.spouse_idcard}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>











  <!-- <div>  -->
  <!-- <th rowspan="2">HN</th>
          <th rowspan="2">ชื่อ</th>
          <th rowspan="2">นามสกุล</th>
          <th rowspan="2">วัน/เดือน/ปีเกิด</th>
          <th rowspan="2">อายุ</th>
          <th rowspan="2">เลขประจำตัวประชาชน</th>
          <th rowspan="2">ที่อยู่</th>
          <th rowspan="2">เบอร์โทรศัพท์</th>
          <th rowspan="2">กรุ๊ปเลือด</th>
          <th rowspan="2">เพศ</th>
          <th rowspan="2">สัญชาติ</th>
          <th rowspan="2">เชื้อชาติ</th>
          <th rowspan="2">ศาสนา</th>
          <th rowspan="2">วุฒิการศึกษา</th>
          <th rowspan="2">สถานภาพสมรส</th>
          <th rowspan="2">อาชีพ</th>
          <th rowspan="2">สิทธิ</th>
          <th rowspan="2">ชื่อมารดา</th>
          <th rowspan="2">บัตรประจำตัวประชาชนมารดา</th>
          <th rowspan="2">ชื่อบิดา</th>
          <th rowspan="2">บัตรประจำตัวประชาชนบิดา</th>
          <th rowspan="2">ชื่อคู่สมรส</th>
          <th rowspan="2">บัตรประจำตัวประชาชนคู่สมรส</th>
          <th rowspan="2">รหัสผ่าน</th>
        </tr>
      </thead>
      <tbody ng-init="select();" class="tbody-content">
        <tr ng-repeat='val in list' class="tbody-content">
          <td>{{val.HN}}</td>
          <td>{{val.patient_name}}</td>
          <td>{{val.patient_lastname}}</td>
          <td>{{val.patient_birthday | date:'yyyy-MM-dd'}}</td>
          <td>{{val.Age}}</td>
          <td>{{val.patient_idcard}}</td>
          <td>{{val.patient_address}}</td>
          <td>{{val.patient_phone}}</td>
          <td>{{val.patient_blood}}</td>
          <td>{{val.HN}}</td>
          <td>{{val.patient_name}}</td>
          <td ng-switch on="val.patient_sex">
            <span ng-switch-when="1">ชาย</span>
            <span ng-switch-when="2">หญิง</span>
          </td>
          <td ng-switch on="val.patient_nation">
            <span ng-switch-when="1">ไทย</span>
            <span ng-switch-when="2">อื่น ๆ</span>
          </td>
          <td ng-switch on="val.patient_race">
            <span ng-switch-when="1">ไทย</option>
              <span ng-switch-when="2">อื่น ๆ</option>
          </td>
          <td ng-switch on="val.patient_religion">
            <span ng-switch-when="1">ศาสนาพุทธ</span>
            <span ng-switch-when="2">ศาสนาคริสต์</span>
            <span ng-switch-when="3">ศาสนาอิสลาม</span>
          </td>
          <td ng-switch on="val.patient_degree">
            <span ng-switch-when="1">ประถมศึกษา</span>
            <span ng-switch-when="2">มัธยมศึกษา</span>
            <span ng-switch-when="3">อาชีวศึกษา</span>
            <span ng-switch-when="4">อุดมศึกษา</span>
          </td>
          <td ng-switch on="val.patient_marital">
            <span ng-switch-when="1">จดทะเบียนสมรส</span>
            <span ng-switch-when="2">โสด</span>
          </td>
          <td ng-switch on="val.patient_occupation">
            <span ng-switch-when="1">ค้าขาย</span>
            <span ng-switch-when="2">เกษตรกร</span>
            <span ng-switch-when="3">ธุรกิจส่วนตัว</span>
            <span ng-switch-when="4">ข้าราชการ</span>
            <span ng-switch-when="5">นักเรียน</span>
            <span ng-switch-when="6">อื่น ๆ</span>
          </td>
          <td ng-switch on="val.patient_right">
            <span ng-switch-when="1">เด็กทารก ( 30 บาทเดิม )</span>
            <span ng-switch-when="2">ช่วงอายุ 12 - 59 ปี ( 30 บาทเดิม )</span>
            <span ng-switch-when="3">ผู้สูงอายุ ( อายุ 60 ปีบริบูรณ์ขึ้นไป )</span>
            <span ng-switch-when="4">บุคคลในครอบครัวของผู้นำชุมชน (กำนัน,สารวัตรกำนัน,ผญบ.,ผช.,แพทย์ประจำหมู่บ้าน)</span>
            <span ng-switch-when="5">อื่น ๆ</span>
          </td>
          <td>{{val.patient_mom}}</td>
          <td>{{val.mom_idcard}}</td>
          <td>{{val.patient_dad}}</td>
          <td>{{val.dad_idcard}}</td>
          <td>{{val.patient_spouse}}</td>
          <td>{{val.spouse_idcard}}</td>
          <td>{{val.patient_password}}</td>
        </tr>
      </tbody>
    </table>
    <table>
      
    </table>
  </div>
  </div>
  </div> -->


  <!-- Modal popup-->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="popup" data-keyboard="false" data-backdrop="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
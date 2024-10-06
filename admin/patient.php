<?php
session_start();
// echo $_SESSION ["check"];
if ($_SESSION == NULL) {
  header("location:../adminlogin.php");
  exit();
}
?>
<!doctype html>
<html ng-app="patientApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="patient.js"></script>
  <title>ข้อมูลผู้ป่วย</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <!-- Favicon
  <link href="img/favicon.ico" rel="icon"> -->

  <!-- Google Web Fonts -->
  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Red+Rose:wght@600;700&display=swap" rel="stylesheet"> -->

  <!-- Icon Font Stylesheet -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css"> -->

  <!-- Libraries Stylesheet -->
  <!-- <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> -->

  <!-- Customized Bootstrap Stylesheet -->
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- Template Stylesheet -->
  <!-- <link href="css/style.css" rel="stylesheet"> -->
  <style>
    /* CSS สำหรับการจัดระเบียบฟอร์ม */

    /* CSS สำหรับการปรับรูปแบบฟอร์ม */
    body {
      background-image: url('/appoint-project/admin/images/lio.png');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      height: 100vh;
      /* ความสูงเต็มหน้าจอ */
      margin: 0;
    }

    .left {
      background-color: #f0f0f0;
      padding: 20px;
    }

    .right {
      background-color: #e0e0e0;
      padding: 20px;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 50vh;
    }

    .header {
      margin-bottom: 20px;
    }

    .title {
      margin-top: 5px;
      font-weight: bold;
    }

    thead {
      text-align: center;

    }

    /* .table-head{
      background-color: #333a73;
    } */
    .head-content th {
      background-color: #333a73;
      color: #fff;
    }

    .search-patient {
      border: 1px solid #ccc;
      /* ใส่เส้นขอบ */
      border-radius: 10px;
      /* ทำมุมขอบโค้ง */
      padding: 5px;
      /* ระยะห่างระหว่างข้อความและกรอบ */
      background-color: rgba(255, 255, 255, 0.7);
      /* สีพื้นหลังแบบจาง */
    }

    .btn-primary {
      border-radius: 10px;
      /* ทำมุมขอบโค้ง */
    }

    .btn-primary:hover {
      background-color: #333a73;

    }

    .tbody-content {
      text-align: center;
    }

    .btn-edit-delete {
      display: flex;
      gap: 5px;
      /* ระยะห่างระหว่างปุ่ม */
    }

    .header-content {
      text-align: center;
    }
  </style>
</head>

<body ng-controller="PatientController">
  <?php include 'navbar_admin.php'; ?>
  <div class="container">
    <div class="header">
      <h1 class="title">ข้อมูลผู้ป่วย</h1>
    </div>
    <!-- content table -->
    <div class="container-body">
      <b> ค้นหาข้อมูล :</b> <input type="text" placeholder="ค้นหาข้อมูลผู้ป่วย" ng-model="s.key" class="search-patient" />
      <button class="btn btn-primary" ng-click="select()">ค้นหา</button>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right; background-color:#32CD32;">
        <i class="bi bi-person-plus"></i>เพิ่มผู้ป่วยรายใหม่
      </button>

      <br /><br />

      <table class="table table-hover table-striped">
        <thead class="table-head">
          <tr class="head-content">
            <th rowspan="2">HN</th>
            <th rowspan="2">คำนำหน้า</th>
            <th rowspan="2">ชื่อ</th>
            <th rowspan="2">นามสกุล</th>
            <th rowspan="2">ปี/เดือน/วันเกิด</th>
            <th rowspan="2">อายุ</th>
            <th rowspan="2">เลขประจำตัวประชาชน</th>
            <th rowspan="2">ที่อยู่</th>
            <!-- <th rowspan="2">เบอร์โทรศัพท์</th>
          <th rowspan="2">กรุ๊ปเลือด</th> -->
            <th rowspan="2">รหัสผ่าน</th>
            <th rowspan="2">น้ำหนัก(กก.)</th>
            <th rowspan="2">ส่วนสูง(ซม.)</th>
            <th rowspan="2">รอบเอว(ซม.)</th>
            <!-- <th rowspan="2">ความดัน(pbd)</th> -->

            <th rowspan="2">รายละเอียด</th>
            <th rowspan="2">การจัดการ</th>


          </tr>
        </thead>
        <tbody ng-init="select();" class="tbody-content">
          <tr ng-repeat='val in list'>
            <td>{{val.HN}}</td>
            <td>{{val.patient_prefix}}</td>
            <td>{{val.patient_name}} </td>
            <td>{{val.patient_lastname}}</td>
            <td>{{val.patient_birthday | date:'yyyy-MM-dd'}}</td>
            <td>{{val.Age}}</td>
            <td>{{val.patient_idcard}}</td>
            <td>{{val.patient_address}}</td>
            <!-- <td>{{val.patient_phone}}</td>
          <td>{{val.patient_blood}}</td> -->
            <td>{{val.patient_password}}</td>



            <td>{{val.weight}}</td>
            <td>{{val.height}}</td>
            <td>{{val.waistline}}</td>
            <!-- <td>{{val.bps	}}</td> -->



            <td><button type="button" class="btn btn-light" style="width: 7rem;" data-bs-toggle="modal" ng-click="select2(val.HN)" data-bs-target="#aaa">

                รายละเอียด</button></td>

            <td>
              <div class="btn-edit-delete">
                <!-- <a href="" class="btn btn-dark mb-3 text-white">แก้ไข</a> -->
                <button type="button" class="btn btn-warning" style="width: 7rem;" data-bs-toggle="modal" ng-click="showupdatefrom(val)" data-bs-target="#updateModal"><i class="bi bi-pen"></i>แก้ไข</button>
                <button type="button" class="btn btn-danger" style="width: 7rem;" data-bs-toggle="modal" ng-click="confirmDelete(val)" data-bs-target="#popupDelete"><i class="bi bi-trash"></i>ลบ</button>
              </div>
            </td>


          </tr>


        </tbody>
      </table>
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
                <th class="text-end" rowspan="2">สิทธิการรักษา</th>
                <th class="text-end" rowspan="2">ชื่อมารดา</th>
                <th class="text-end" rowspan="2">บัตรประจำตัวประชาชนมารดา</th>
                <th class="text-end" rowspan="2">ชื่อบิดา</th>
                <th class="text-end" rowspan="2">บัตรประจำตัวประชาชนบิดา</th>
                <th class="text-end" rowspan="2">ชื่อคู่สมรส</th>
                <th class="text-end" rowspan="2"></th>บัตรประจำตัวประชาชนคู่สมรส
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

  <!-- Modal Update-->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">แก้ไขข้อมูลผู้ป่วย</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex justify-content-center aligh items-center vh-100">
          <form class="d-flex flex-column">
            <!-- <div class="mb-3">
            <label htmlFor="idpatient" Class="form-lable">
             ID:
            </label>
            <input ng-model = "f2.idpatient"
              type="text"
              class="form-control"
              placeholder="กรุณากรอกเลขประจำตัวผู้ป่วย"
            />
          </div> -->
            <div class="mb-3">
              <label htmlFor="HN" Class="form-lable">
                <b>HN:</b>
              </label>
              <input ng-model="f2.HN" type="text" class="form-control" placeholder="กรุณากรอกเลขประจำตัวผู้ป่วย" />
            </div>



            <div class="mb-3 d-flex">
              <div class="flex-grow-1 me-3">
                <label for="name" class="form-label"><b>ชื่อผู้ป่วย:</b></label>
                <input ng-model="f2.patient_name" type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้ป่วย">
              </div>

              <div class="flex-grow-1">
                <label for="lastname" class="form-label"><b>นามสกุลผู้ป่วย:</b></label>
                <input ng-model="f2.patient_lastname" type="text" class="form-control" placeholder="กรุณากรอกนามสกุลผู้ป่วย">
              </div>
            </div>

            <!-- <div class="mb-3">
            <label htmlFor="birthday" Class="form-lable">
              วัน/เดือน/ปีเกิด:
            </label>
            <input ng-model = "f2.patient_birthday"
              type="date"
              placeholder="dd-mm-yyyy" value="{{f2.patient_birthday | date:'yyyy-MM-dd'}}" min="1886-01-01" max="2025-12-31"
              class="form-control"
              
            />
          </div> -->
            <div class="mb-3">
              <label htmlFor="birthday" Class="form-lable">
                <b>เดือน/วัน/ปีเกิด:</b>
              </label>
              <input ng-model="f2.patient_birthday" type="date" placeholder="ดด-วว-ปปปป" min="1886-01-01" max="2024-01-01" class="form-control" />
            </div>
            <div class="mb-3">
              <label htmlFor="idcard" Class="form-lable">
                <b>เลขประจำตัวประชาชน:</b>
              </label>
              <input ng-model="f2.patient_idcard" ui-mask="9-9999-99999-99-9" ui-mask-placeholder-char=" " clear-on-blur-placeholder="true" type="text" class="form-control" placeholder="กรุณากรอกเลขประจำตัวประชาชนผู้ป่วย" />
            </div>

            <div class="mb-3">
              <label htmlFor="f2.weight" Class="form-lable">
                <b>น้ำหนัก(กก.):</b>
              </label>
              <input ng-model="f2.weight" type="text" class="form-control" placeholder="กรุณากรอกน้ำหนัก" />
            </div>
            <div class="mb-3">
              <label htmlFor="f2.height" Class="form-lable">
                <b>ส่วนสูง(ซม.):</b>
              </label>
              <input ng-model="f2.height	" type="text" class="form-control" placeholder="กรุณากรอกส่วนสูง" />
            </div>
            <div class="mb-3">
              <label htmlFor="f2.waistline" Class="form-lable">
                <b>รอบเอว(ซม.):</b>
              </label>
              <input ng-model="f2.waistline" type="text" class="form-control" placeholder="กรุณากรอกรอบเอว" />
            </div>
            <div class="mb-3">
              <label htmlFor="f2.bps" Class="form-lable">
                <b>ความดัน(bps/หัวใจบีบตัว ):</b>
              </label>
              <input ng-model="f2.bps" type="text" class="form-control" placeholder="กรุณากรอกความดัน" />

            </div>
            <div class="mb-3">
              <label htmlFor="f2.bpd" Class="form-lable">
                <b>ความดัน(bpd/หัวใจคลายตัว):</b>
              </label>
              <input ng-model="f2.bpd" type="text" class="form-control" placeholder="กรุณากรอกความดัน" />
            </div>

            <div class="mb-3">
              <label htmlFor="sex" Class="form-lable">
                <b>เพศ:</b>
              </label>
              <select class="form-select" ng-model="f3.patient_sex">
                <option value="1" ng-selected="'1' == f3.patient_sex">ชาย</option>
                <option value="2" ng-selected="'2' == f3.patient_sex">หญิง</option>
              </select>
            </div>
            <div class="mb-3">
              <label htmlFor="
                      height" Class="form-lable">
                <b>เบอร์โทรศัพท์:</b>
              </label>

              </label>
              <input ng-model="f2.patient_phone" ui-mask="999-9999999" ui-mask-placeholder-char=" " clear-on-blur-placeholder="true" type="tel" class="form-control" placeholder="กรุณากอกเบอร์โทรศัพท์ของผู้ป่วย" />
            </div>
            <div class="mb-3">
              <label htmlFor="address" Class="form-lable">
                <b>ที่อยู่:</b>
              </label>
              <input ng-model="f2.patient_address" type="text" class="form-control" placeholder="กรุณากรอกที่อยู่" />
            </div>
            <div class="mb-3">
              <label htmlFor="blood" Class="form-lable">
                <b>กรุ๊ปเลือด:</b>
              </label>
              <select class="form-select" ng-model="f2.patient_blood">
                <option value="A" ng-selected="'A' == f2.patient_blood">A เอ</option>
                <option value="B" ng-selected="'B' == f2.patient_blood">B บี</option>
                <option value="AB" ng-selected="'AB' == f2.patient_blood">AB เอบี</option>
                <option value="O" ng-selected="'O' == f2.patient_blood">O โอ</option>
              </select>
            </div>
            <div class="mb-3">
              <label htmlFor="nation" Class="form-lable">
                <b>สัญชาติ:</b>
              </label>
              <select class="form-select" ng-model="f3.patient_nation">
                <option value="1" ng-selected="'1' == f3.patient_nation">ไทย</option>
                <option value="2" ng-selected="'2' == f3.patient_nation">อื่น ๆ</option>
              </select>
              <!-- <input ng-model = "f2.patient_nation"
              type="text"
              class="form-control"
              placeholder="กรุณากรอกสัญชาติ"
            /> -->
            </div>
            <div class="mb-3">
              <label htmlFor="race" Class="form-lable">
                <b>เชื้อชาติ:</b>
              </label>
              <select class="form-select" ng-model="f3.patient_race">
                <option value="1" ng-selected="'1' == f3.patient_race">ไทย</option>
                <option value="2" ng-selected="'2' == f3.patient_race">อื่น ๆ</option>
              </select>
              <!-- <input ng-model = "f2.patient_race"
              type="text"
              class="form-control"
              placeholder="กรุณากรอกเชื้อชาติ"
            /> -->
            </div>
            <div class="mb-3">
              <label htmlFor="religion" Class="form-lable">
                <b>ศาสนา:</b>
              </label>
              <select class="form-select" ng-model="f3.patient_religion">
                <option value="1" ng-selected="'1' == f3.patient_religion">ศาสนาพุทธ</option>
                <option value="2" ng-selected="'2' == f3.patient_religion">ศาสนาคริสต์</option>
                <option value="3" ng-selected="'3' == f3.patient_religion">ศาสนาอิสลาม</option>
              </select>
            </div>
            <div class="mb-3">
              <label htmlFor="degree" Class="form-lable">
                <b>วุฒิการศึกษา:</b>
              </label>
              <select class="form-select" ng-model="f3.patient_degree">
                <option value="1" ng-selected="'1' == f3.patient_degree">ประถมศึกษา</option>
                <option value="2" ng-selected="'2' == f3.patient_degree">มัธยมศึกษา</option>
                <option value="3" ng-selected="'3' == f3.patient_degree">อาชีวศึกษา</option>
                <option value="4" ng-selected="'4' == f3.patient_degree">อุดมศึกษา</option>
              </select>
            </div>
            <div class="mb-3">
              <label htmlFor="marital" Class="form-lable">
                <b>สถานภาพสมรส:</b>
              </label>
              <select class="form-select" ng-model="f3.patient_marital">
                <option value="1" ng-selected="'1' == f3.patient_marital">จดทะเบียนสมรส</option>
                <option value="2" ng-selected="'2' == f3.patient_marital">โสด</option>
              </select>
            </div>
            <div class="mb-3">
              <label htmlFor="occupation" Class="form-lable">
                <b>อาชีพ:</b>
              </label>
              <select class="form-select" ng-model="f3.patient_occupation">
                <option value="1" ng-selected="'1' == f3.patient_occupation">ค้าขาย</option>
                <option value="2" ng-selected="'2' == f3.patient_occupation">เกษตรกร</option>
                <option value="3" ng-selected="'3' == f3.patient_occupation">ธุรกิจส่วนตัว</option>
                <option value="4" ng-selected="'4' == f3.patient_occupation">ข้าราชการ</option>
                <option value="5" ng-selected="'5' == f3.patient_occupation">นักเรียน</option>
                <option value="6" ng-selected="'6' == f3.patient_occupation">อื่น ๆ</option>
              </select>
            </div>
            <div class="mb-3">
              <label htmlFor="right" Class="form-lable">
                <b>สิทธิการรักษา:</b>
              </label>
              <select class="form-select" ng-model="f3.patient_right">
                <option value="1" ng-selected="'1' == f3.patient_right">เด็กทารก ( 30 บาทเดิม )</option>
                <option value="2" ng-selected="'2' == f3.patient_right">ช่วงอายุ 12 - 59 ปี ( 30 บาทเดิม )</option>
                <option value="3" ng-selected="'3' == f3.patient_right">ผู้สูงอายุ ( อายุ 60 ปีบริบูรณ์ขึ้นไป )</option>
                <option value="4" ng-selected="'4' == f3.patient_right">บุคคลในครอบครัวของผู้นำชุมชน (กำนัน,สารวัตรกำนัน,ผญบ.,ผช.,แพทย์ประจำหมู่บ้าน)</option>
                <option value="5" ng-selected="'5' == f3.patient_right">อื่น ๆ</option>
              </select>
            </div>
            <div class="mb-3">
              <label htmlFor="mom_name" Class="form-lable">
                <b>ชื่อมารดา:</b>
              </label>
              <input ng-model="f3.patient_mom" type="text" class="form-control" placeholder="กรุณากรอกชื่อมารดา" />
            </div>
            <div class="mb-3">
              <label htmlFor="mom_idcard" Class="form-lable">
                <b>บัตรประจำตัวประชาชนมารดา:</b>
              </label>
              <input ng-model="f3.mom_idcard" type="text" class="form-control" placeholder="กรุณากรอกบัตรประจำตัวประชาชนมารดา" />
            </div>
            <div class="mb-3">
              <label htmlFor="dad_name" Class="form-lable">
                <b>ชื่อบิดา:</b>
              </label>
              <input ng-model="f3.patient_dad" type="text" class="form-control" placeholder="กรุณากรอกชื่อบิดา" />
            </div>
            <div class="mb-3">
              <label htmlFor="dad_idcard" Class="form-lable">
                <b>บัตรประจำตัวประชาชนบิดา:</b>
              </label>
              <input ng-model="f3.dad_idcard" type="text" class="form-control" placeholder="กรุณากรอกบัตรประจำตัวประชาชนบิดา" />
            </div>
            <div class="mb-3">
              <label htmlFor="spouse_name" Class="form-lable">
                <b>ชื่อคู่สมรส:</b>
              </label>
              <input ng-model="f3.patient_spouse" type="text" class="form-control" placeholder="กรุณากรอกชื่อคู่สมรส" />
            </div>
            <div class="mb-3">
              <label htmlFor="spouse_idcard" Class="form-lable">
                <b>บัตรประจำตัวประชาชนคู่สมรส:</b>
              </label>
              <input ng-model="f3.spouse_idcard" type="text" class="form-control" placeholder="กรุณากรอกบัตรประจำตัวประชาชนคู่สมรส" />
            </div>



            <div class="mb-3">
              <label htmlFor="password" Class="form-lable">
                <b>รหัสผ่าน:</b>
              </label>
              <input ng-model="f2.patient_password" type="text" class="form-control" placeholder="กรุณากรอกรหัสผ่าน" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="button" ng-click="update()" class="btn btn-success" data-bs-dismiss="modal">บันทึกข้อมูลผู้ป่วย</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal insert-->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content modal-lg modal-dialog-scrollable">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">เพิ่มข้อมูลผู้ป่วยรายใหม่</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="d-flex justify-content-center aligh items-center vh-100">

            <div class="card w-100">
              <div class="left">
                <h1 class="text-center fw-bold">ข้อมูล</h1>
                <div class="card-body">
                  <form class="d-flex flex-column">
                    <div class="form-row">
                      <div class="row g-3">
                        <div class="form-group  col-sm-4 mb-3 ">
                          <label htmlFor="name" Class="form-lable">
                            ชื่อผู้ป่วย:
                          </label>
                          <input ng-model="f.name" type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้ป่วย" required />
                        </div>
                        <div class="form-group  col-sm-4 mb-3">
                          <label htmlFor="lastname" Class="form-lable">
                            นามสกุลผู้ป่วย:
                          </label>
                          <input ng-model="f.lastname" type="text" class="form-control" placeholder="กรุณากรอกนามสกุลผู้ป่วย" required />
                        </div>
                        <div class=" form-group col-sm-4 mb-3">
                          <label htmlFor="idcard" Class="form-lable">
                            เลขประจำตัวประชาชน:
                          </label>

                          <input ng-model="f.idcard"
                            type="text"
                            class="form-control"
                            title="กรุณากรอกเฉพาะตัวเลข 13 หลัก"
                            placeholder="กรุณากรอกเลขประจำตัวประชาชนผู้ป่วย"
                            maxlength="13"
                            required
                            ng-keyup="clearIfNotNumber()" />


                        </div>
                        <div class="mb-3">
                          <label htmlFor="sex" Class="form-lable">
                            เพศ:
                          </label>
                          <select class="form-select" ng-model="f.sex">
                            <option value="">เลือกเพศ...</option>
                            <option value="1">ชาย</option>
                            <option value="2">หญิง</option>
                          </select>

                        </div>
                        <div class="mb-3">
                          <label htmlFor="birthday" Class="form-lable">
                            เดือน/วัน/ปีเกิด:
                          </label>
                          <input ng-model="f.birthday" type="date" class="form-control" placeholder="ดด-วว-ปปปป" min="1886-01-01" max="2025-12-31" required />
                        </div>
                        <div class="mb-3">
                          <label htmlFor="phone" Class="form-lable">
                            เบอร์โทรศัพท์:
                          </label>
                          <input ng-model="f.phone"
                            type="text"
                            class="form-control"
                            placeholder="XXX XXXXXXX"
                            maxlength="10"
                            ng-keyup="clearIfNotNumber()"
                            required />

                        </div>
                        <div class="mb-3">
                          <label htmlFor="address" Class="form-lable">
                            ที่อยู่:
                          </label>
                          <input ng-model="f.address" type="text" class="form-control" placeholder="12 หมู่.. ตำบล... อำเภอ... จังหวัด..." required />
                        </div>
                        <div class="mb-3">
                          <label htmlFor="blood" Class="form-lable">
                            กรุ๊ปเลือด:
                          </label>
                          <select class="form-select" ng-model="f.blood">
                            <option value="">เลือกกรุ๊ปเลือด...</option>
                            <option value="A">A เอ</option>
                            <option value="B">B บี</option>
                            <option value="AB">AB เอบี</option>
                            <option value="O">O โอ</option>
                          </select>
                        </div>
                        <div class="form-group  col-sm-4 mb-3">
                          <label htmlFor="nation" Class="form-lable">
                            สัญชาติ:
                          </label>
                          <select class="form-select" ng-model="f.nation">
                            <option value="">เลือกสัญชาติ...</option>
                            <option value="1">ไทย</option>
                            <option value="2">อื่น ๆ</option>
                          </select>

                        </div>
                        <div class="form-group  col-sm-4 mb-3">
                          <label htmlFor="race" Class="form-lable">
                            เชื้อชาติ:
                          </label>
                          <select class="form-select" ng-model="f.race">
                            <option value="">เลือกเชื้อชาติ...</option>
                            <option value="1">ไทย</option>
                            <option value="2">อื่น ๆ</option>
                          </select>

                        </div>
                        <div class="form-group  col-sm-4 mb-3">
                          <label htmlFor="religion" Class="form-lable">
                            ศาสนา:
                          </label>
                          <select class="form-select" ng-model="f.religion">
                            <option value="">เลือกศาสนา...</option>
                            <option value="1">ศาสนาพุทธ</option>
                            <option value="2">ศาสนาคริสต์</option>
                            <option value="3">ศาสนาอิสลาม</option>
                          </select>

                        </div>
                        <div class="mb-3">
                          <label htmlFor="degree" Class="form-lable">
                            วุฒิการศึกษา:
                          </label>
                          <select class="form-select" ng-model="f.degree">
                            <option value="">เลือกระดับการศึกษา...</option>
                            <option value="1">ประถมศึกษา</option>
                            <option value="2">มัธยมศึกษา</option>
                            <option value="3">อาชีวศึกษา</option>
                            <option value="4">อุดมศึกษา</option>
                          </select>

                        </div>
                        <div class="mb-3">
                          <label htmlFor="marital" Class="form-lable">
                            สถานภาพสมรส:
                          </label>
                          <select class="form-select" ng-model="f.marital">
                            <option value="">เลือกสถานภาพสมรส...</option>
                            <option value="1">จดทะเบียนสมรส</option>
                            <option value="2">โสด</option>
                          </select>

                        </div>
                        <div class="mb-3">
                          <label htmlFor="occupation" Class="form-lable">
                            อาชีพ:
                          </label>
                          <select class="form-select" ng-model="f.occupation">
                            <option value="">เลือกอาชีพ...</option>
                            <option value="1">ค้าขาย</option>
                            <option value="2">เกษตรกร</option>
                            <option value="3">ธุรกิจส่วนตัว</option>
                            <option value="4">ข้าราชการ</option>
                            <option value="5">นักเรียน</option>
                            <option value="6">อื่น ๆ</option>
                          </select>

                        </div>
                        <div class="mb-3">
                          <label htmlFor="right" Class="form-lable">
                            สิทธิการรักษา:
                          </label>
                          <select class="form-select" ng-model="f.right">
                            <option value="">เลือกสิทธิการรักษา...</option>
                            <option value="1">เด็กทารก ( 30 บาทเดิม )</option>
                            <option value="2">ช่วงอายุ 12 - 59 ปี ( 30 บาทเดิม )</option>
                            <option value="3">ผู้สูงอายุ ( อายุ 60 ปีบริบูรณ์ขึ้นไป )</option>
                            <option value="4">บุคคลในครอบครัวของผู้นำชุมชน (กำนัน,สารวัตรกำนัน,ผญบ.,ผช.,แพทย์ประจำหมู่บ้าน)</option>
                            <option value="5">อื่น ๆ</option>
                          </select>


                        </div>
                        <div class="mb-3">
                          <label htmlFor="mom_name" Class="form-lable">
                            ชื่อมารดา:
                          </label>
                          <input ng-model="f.mom_name" type="text" class="form-control" placeholder="กรุณากรอกชื่อมารดา" />
                        </div>
                        <div class="mb-3">
                          <label htmlFor="mom_idcard" Class="form-lable">
                            บัตรประจำตัวประชาชนมารดา:
                          </label>
                          <input 
                          
                            ng-model="f.mom_idcard"
                            type="text" 
                            class="form-control"
                            placeholder="X XXXX XXXXX XX X"
                            maxlength="13"
                            ng-keyup="clearIfNotNumber()" />
                        </div>
                        <div class="mb-3">
                          <label htmlFor="dad_name" Class="form-lable">
                            ชื่อบิดา:
                          </label>
                          <input ng-model="f.dad_name" type="text" class="form-control" placeholder="กรุณากรอกชื่อบิดา" />
                        </div>
                        <div class="mb-3">
                          <label htmlFor="dad_idcard" Class="form-lable">
                            บัตรประจำตัวประชาชนบิดา:
                          </label>
                          <input ng-model="f.dad_idcard"
                            type="text"
                            class="form-control"
                            placeholder="X XXXX XXXXX XX X"
                            ng-keyup="clearIfNotNumber()"
                            maxlength="13" />
                        </div>
                        <div class="mb-3">
                          <label htmlFor="spouse_name" Class="form-lable">
                            ชื่อคู่สมรส:
                          </label>
                          <input ng-model="f.spouse_name" type="text" class="form-control" placeholder="กรุณากรอกชื่อคู่สมรส" />
                        </div>
                        <div class="mb-3">
                          <label htmlFor="spouse_idcard" Class="form-lable">
                            บัตรประจำตัวประชาชนคู่สมรส:
                          </label>
                          <input ng-model="f.spouse_idcard"
                            type="text"
                            class="form-control"
                            placeholder="X XXXX XXXXX XX X"
                            ng-keyup="clearIfNotNumber()"
                            maxlength="13" />
                        </div>
                        <div class="mb-3">
                          <label htmlFor="password" Class="form-lable">
                            รหัสผ่าน:
                          </label>
                          <input ng-model="f.password" type="text" class="form-control" placeholder="กรุณากรอกรหัสผ่าน" required />
                        </div>
                      </div>
                    </div>
                  </form>
                </div>

              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="button" ng-click="insert()" class="btn btn-success">เพิ่มข้อมูลผู้ป่วย</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal popup-->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="popup1" data-keyboard="false" data-backdrop="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ข้อความแจ้งเตือน</h5>
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

  <div class="modal fade" id="popupInsert" data-keyboard="false" data-backdrop="true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ข้อความแจ้งเตือน</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{b}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>
  <!-- <button type="button" class="btn btn-secondary" ng-click="test()">Close</button> -->
  <!-- Modal -->

  <!-- ลบข้อมูล-->
  <div class="modal fade" id="popupDelete" aria-hidden="true" aria-labelledby="popupDeleteLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="popupDeleteLabel">ลบข้อมูล</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้ .. <br> HN:{{goingTodelete.HN}} ชื่อ-สกุล:{{goingTodelete.patient_name}} {{goingTodelete.patient_lastname}}
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#popupDelete2" data-bs-toggle="modal" ng-click="delete(goingTodelete.HN)">ลบ</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="popupDelete2" aria-hidden="true" aria-labelledby="popupDeleteLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="popupDeleteLabel2">การแจ้งเตือน</h1>
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
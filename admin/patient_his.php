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
  <script src="patient_his.js"></script>
  <title>ประวัติการรักษาพยาบาล</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


  <style>
    body {
            background-image: url('/appoint-project/admin/images/lio.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /* ความสูงเต็มหน้าจอ */
  margin: 0;
        }
     .container{
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 50h;
    }
    .header{
      margin-bottom: 20px;
    }
    .title{
      margin-top: 5px;
      font-weight: bold;
    }
    thead{
     text-align: center;
     
    }
    .head-content th{
      background-color: #333a73;
      color: #fff;
    }
    
    .search-patient {
      border: 1px solid #ccc; /* ใส่เส้นขอบ */
      border-radius: 10px; /* ทำมุมขอบโค้ง */
      padding: 5px; /* ระยะห่างระหว่างข้อความและกรอบ */
      background-color: rgba(255, 255, 255, 0.7); /* สีพื้นหลังแบบจาง */
    }
    .btn-primary{
      border-radius: 10px; /* ทำมุมขอบโค้ง */
    }
    .btn-primary:hover{
      background-color: #333a73;

    }
    .tbody-content{
      text-align: center;
    }
    .btn-edit-delete {
      display: flex;
      gap: 5px; /* ระยะห่างระหว่างปุ่ม */
    }
    .header-content{
      text-align: center;
    }
  </style>
</head>

<body ng-controller="Patient_hisController">
  <?php include 'navbar_admin.php'; ?>
  <div class="container">
    <div class="header">
    <h1 class="title">ประวัติการรักษา</h1>
    </div>
  <div class="container-body" ng-init="select()">
    <b>ค้นหาข้อมูล : </b><input type="text" class="search-patient" placeholder="ค้นหาข้อมูลประวัติการรักษา" ng-model="s.key" />
    <button class="btn btn-primary" ng-click="select();">ค้นหา</button>
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">
            เพิ่มประวัติการรักษาพยาบาล
      </button>  ถ้ามากกว่าก้แสดง ไม่มีไม่แสดงเลยก่อนค้นหา -->
    <br /><br />
    <table class="table table-hover table-striped" ng-show="list.length > 0" >
      <thead class="table-head">
        <tr class="head-content">
          <th>ลำดับ</th>
          <th>HN</th>
          <th>ชื่อ-สกุล</th>
          <th>โรคที่ป่วย</th>
          <th>รายละเอียดการรักษา</th>
          <!-- <th>รายละเอียดการแพ้ยา</th> -->
          <th>วันที่ทำการรักษา</th>
          <th>แพทย์ผู้ทำการรักษา</th>
          <th>การจัดการ</th>
        </tr>
      </thead>
      
      <tbody  class="tbody-content">
        <tr ng-repeat='val in list track by $index'>
          <td>{{$index+1}}</td>
          <td>{{val.HN}}</td>
          <td>{{val.patient_name}} {{val.patient_lastname}}</td>
          <td>{{val.disease_name}}</td>
          <td>{{val.detail}}</td>
          <!-- <td> 
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" ng-click= "select2(val.HN)" data-bs-target="#aaa" >ข้อมูลการแพ้ยา</button>
                    </td> -->
         
          <td>{{val.date_treatment | date:'yyyy-MM-dd'}}</td>
          <td>{{val.admin_name}} {{val.admin_lastname}} </td>
          <td>
            <div class="btn-edit-delete">

            <button type="button" class="btn btn-warning" data-bs-toggle="modal" ng-click="showupdatefrom(val)" data-bs-target="#updateModal"><i class="bi bi-pen"></i>แก้ไข</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" ng-click="confirmDelete(val)" data-bs-target="#popupDelete"><i class="bi bi-trash"></i>ลบ</button>

            </div>

          </td>
        </tr>
      </tbody>
    </table>


    <table class="table table-hover table-striped" ng-hide="list.length > 0" >
      <thead class="table-head">
        <tr class="head-content">
          <th>ลำดับ</th>
          <th>HN</th>
          <th>ชื่อ-สกุล</th>
          <th>โรคที่ป่วย</th>
          <th>รายละเอียด</th>
          <!-- <th>รายละเอียดการแพ้ยา</th> -->
          <th>วันที่ทำการรักษา</th>
          <th>แพทย์ผู้ทำการรักษา</th>
          <th>การจัดการ</th>
        </tr>
      </thead>
      <tbody  class="tbody-content">
        <tr ng-repeat='val in list3 track by $index'>
          <td>{{$index+1}}</td>
          <td>{{val.HN}}</td>
          <td>{{val.patient_name}} {{val.patient_lastname}}</td>
          <td>{{val.disease_name}}</td>
          <td>{{val.detail}}</td>
          <!-- <td> 
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" ng-click= "select2(val.HN)" data-bs-target="#aaa" >ข้อมูลการแพ้ยา</button>
                    </td> -->
          <td>{{val.date_treatment | date:'yyyy-MM-dd'}}</td>
          <td>{{val.admin_name}} {{val.admin_lastname}} </td>
          <td>
            <?php
            if ($_SESSION["check_position"] == "แพทย์") { ?>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" ng-click="showupdatefrom(val)" data-bs-target="#updateModal"><i class="bi bi-pen"></i>แก้ไข</button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" ng-click="confirmDelete(val)" data-bs-target="#popupDelete"><i class="bi bi-trash"></i>ลบ</button>
            <?php } else {
              echo "ไม่มีสิทธิ์แก้ไขข้อมูลประวัติการรักษา";
            } ?>
          </td>
        </tr>
      </tbody>
    </table>


  </div>
  </div>
  </div>
  </div>

  <!-- Modal show data allergy patient-->
  <!-- <div class="modal fade" id="aaa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">ข้อมูลผู้ป่วยเพิ่มเติม</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-hover" striped>
          <thead>
            <tr>
              <th>HN</th>
              <th>ชื่อ-สกุล</th>
              <th>ประวัติการแพ้ยา</th>     
            </tr>
          </thead>
          <tbody>
      
            <tr ng-repeat = 'val in list2'>
              <td>{{val.HN}}</td>
              <td>{{val.patient_name}} {{val.patient_lastname}}</td>
              <td>{{val.allergy_name}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->

  <!-- Modal Insert-->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">เพิ่มประวัติการรักษาพยาบาล</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <div class="d-flex justify-content-center aligh items-center vh-100">
            <div class="card w-100">
              <h1 class="text-center">ข้อมูลประวัติการรักษาพยาบาล</h1>
              <div class="card-body">
                <form>
                  <div class="mb-3">
                    <label htmlFor="HN" Class="form-lable">
                      HN:
                    </label>
                    <input ng-model="f2.HN" type="text" class="form-control" placeholder="กรุณากรอกเลขประจำตัวผู้ป่วย" />
                  </div>
                  <div class="mb-3">
                    <label htmlFor="name" Class="form-lable">
                      ผู้ป่วย : {{f2.patient_name}} {{f2.patient_lastname}}
                    </label>
                  </div>
                  <div class="mb-3">
                    <label htmlFor="disease" Class="form-lable">
                      โรคที่ป่วย:
                    </label>
                    <select class="mb-3" ng-model="f2.iddisease">
                      <option value="1">โรคหัวใจ</option>
                      <option value="2">โรคความดันโลหิตสูง</option>
                      <option value="3">โรคเบาหวาน</option>
                      <option value="4">โรคไขมันฯ</option>
                      <option value="5">โรคเกาท์</option>
                      <option value="6">โรคหลอดเลือดสมอง</option>
                      <option value="7">โรคระบบทางเดินหายใจเรื้อรัง</option>
                      <option value="8">โรคไตเรื้อรัง</option>
                      <option value="9">โรคตับแข็ง</option>
                      <option value="10">โรคตา</option>
                      <option value="11">โรคฟันและเหงือก</option>
                      <option value="12">โรคอ้วน</option>
                      <option value="13">โรคเกี่ยวกับระบบทางเดินอาหาร</option>
                      <option value="14">โรคซึมเศร้าและวิตกกังวล</option> 
                      <option value="15">โรคปอด</option>
                      <option value="16">โรคมะเร็ง</option>
                      <option value="17">โรคอื่นๆ</option>
                    </select>
                    <!-- <input ng-model = "f2.iddisease"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกโรคที่ป่วย" 
                        /> -->
                  </div>
                  <div class="mb-3">
                    <label htmlFor="detail" Class="form-lable">
                      รายละเอียดการรักษา:
                    </label>
                    <input ng-model="f2.detail" type="text" class="form-control" placeholder="กรุณากรอกรายละเอียด" />
                  </div>
                  <div class="mb-3">
                    <label htmlFor="treatment" Class="form-lable">
                      วันที่ทำการรักษา:
                    </label>
                    <input ng-model="f2.date_treatment" type="date" class="form-control" placeholder="กรุณากรอกวันที่ทำการรักษา" />
                  </div>
                  <!-- <div class="mb-3">
                        <label htmlFor="allergy" Class="form-lable">
                         ประวัติการแพ้ยา:
                        </label>
                        <input ng-model = "f2.allergy"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกวันที่ทำการรักษา"  
                        />
                      </div> -->
                  <div class="mb-3">
                    <label htmlFor="admin" Class="form-lable">
                      แพทย์ผู้ทำการรักษา:
                    </label>
                    <select class="mb-3" ng-model="f2.idadmin">
                      <option ng-repeat="x in adminlist" ng-value="{{x.idadmin}}">{{x.admin_name}} {{x.admin_lastname}}</option>
                    </select>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" ng-click="insert()" class="btn btn-primary" data-bs-dismiss="modal">เพิ่มข้อมูล</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Update-->
  <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">ประวัติการรักษา</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-center aligh items-center vh-100">
            <div class="card w-100">
              <h1 class="text-center">ข้อมูลการเข้ารับการรักษา</h1>
              <div class="card-body">
                <form>
                  <div class="mb-3">
                    <label htmlFor="HN" Class="form-lable">
                      HN:
                    </label>
                    <input ng-model="f3.HN" disabled type="text" class="form-control" placeholder="กรุณากรอกเลขประจำตัวผู้ป่วย" />
                  </div>
                  <div class="mb-3 d-flex">
                    <div class="flex-grow-1 me-3">
                    <label htmlFor="name" Class="form-lable">
                      ชื่อผู้ป่วย:
                    </label>
                    <input ng-model="f3.patient_name" disabled type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้ป่วย" />
                    </div>
                    <div class="flex-grow-1">
                      <label htmlFor="lastname" Class="form-lable">
                        นามสกุลผู้ป่วย:
                      </label>
                      <input ng-model="f3.patient_lastname" disabled type="text" class="form-control" placeholder="กรุณากรอกนามสกุลผู้ป่วย" />
                    </div>
                  </div>
                  <div class="mb-3">
                    <label htmlFor="disease" Class="form-lable">
                      โรคที่ป่วย:
                    </label>
                    <select class="form-select" ng-model="f3.iddisease">
                      <option value="1" ng-selected="'1' == f3.iddisease">โรคหัวใจ</option>
                      <option value="2" ng-selected="'2' == f3.iddisease">โรคความดันโลหิตสูง</option>
                      <option value="3" ng-selected="'3' == f3.iddisease">โรคเบาหวาน</option>
                      <option value="4" ng-selected="'4' == f3.iddisease">โรคไขมันฯ</option>
                      <option value="5" ng-selected="'5' == f3.iddisease">โรคเกาท์</option>
                      <option value="6" ng-selected="'6' == f3.iddisease">โรคหลอดเลือดสมอง</option>
                      <option value="7" ng-selected="'7' == f3.iddisease">โรคระบบทางเดินหายใจเรื้อรัง</option>
                      <option value="8" ng-selected="'8' == f3.iddisease">โรคไตเรื้อรัง</option>
                      <option value="9" ng-selected="'9' == f3.iddisease">โรคตับแข็ง</option>
                      <option value="10"ng-selected="'10' == f3.iddisease">โรคตา</option>
                      <option value="11"ng-selected="'11' == f3.iddisease">โรคฟันและเหงือก</option>
                      <option value="12"ng-selected="'12' == f3.iddisease">โรคอ้วน</option>
                      <option value="13"ng-selected="'13' == f3.iddisease">โรคเกี่ยวกับระบบทางเดินอาหาร</option>
                      <option value="14"ng-selected="'14' == f3.iddisease">โรคซึมเศร้าและวิตกกังวล</option> 
                      <option value="15"ng-selected="'15' == f3.iddisease">โรคปอด</option>
                      <option value="16"ng-selected="'16' == f3.iddisease">โรคมะเร็ง</option>
                      <option value="17"ng-selected="'17' == f3.iddisease">โรคอื่นๆ</option>
                      
                    </select>
                    <!-- <input ng-model = "f2.iddisease"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกโรคที่ป่วย" 
                        /> -->
                  </div>
                  <div class="mb-3">
                    <label htmlFor="detail" Class="form-lable">
                      รายละเอียดการรักษา:
                    </label>
                    <input ng-model="f3.detail" type="text" class="form-control" placeholder="กรุณากรอกรายละเอียด" />
                  </div>
                  <div class="mb-3">
                    <label htmlFor="treatment" Class="form-lable">
                      วันที่ทำการรักษา:
                    </label>
                    <input ng-model="f3.date_treatment" type="date" class="form-control" placeholder="กรุณากรอกวันที่ทำการรักษา" />
                  </div>

                  <div class="mb-3">
              <label htmlFor="f3.weight" Class="form-lable">
                <b>น้ำหนัก:</b>
              </label>
              <input ng-model="f3.weight" type="text" class="form-control" placeholder="กรุณากรอกน้ำหนัก" />
            </div>

                   <div class="mb-3">
              <label htmlFor="f3.height" Class="form-lable">
                <b>ส่วนสูง:</b>
              </label>
              <input ng-model="f3.height	" type="text" class="form-control" placeholder="กรุณากรอกส่วนสูง" />
            </div>

            <div class="mb-3">
              <label htmlFor="f3.waistline" Class="form-lable">
                <b>รอบเอว:</b>
              </label>
              <input ng-model="f3.waistline" type="text" class="form-control" placeholder="กรุณากรอกรอบเอว" />
            </div>
            
            <div class="mb-3">
              <label htmlFor="f3.bps" Class="form-lable">
                <b>ความดัน:</b>
              </label>
              <input ng-model="f3.bps" type="text" class="form-control" placeholder="กรุณากรอกความดัน" />
            </div>

                  <div class="mb-3">
                    <label htmlFor="admin" Class="form-lable">
                      แพทย์ผู้ทำการรักษา:
                    </label>
                    <select class="form-select" ng-model="f3.idadmin">
                      <option ng-repeat="x in adminlist" ng-value="x.idadmin" ng-selected="x.idadmin == f3.idadmin">{{x.admin_name}} {{x.admin_lastname}}</option>
                    </select>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="button" ng-click="update()" class="btn btn-success" data-bs-dismiss="modal">บันทึกข้อมูลการรักษา</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal popup-->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5  fw-bold" id="exampleModalLabel">แจ้งเตือน</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <b>{{a}}</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ลบข้อมูล-->
  <div class="modal fade" id="popupDelete" aria-hidden="true" aria-labelledby="popupDeleteLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="popupDeleteLabel">ลบข้อมูล</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <b>คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้ ..</b><br> HN: {{goingTodelete.HN}} ชื่อ-สกุล: {{goingTodelete.patient_name}} {{goingTodelete.patient_lastname}}
        </div>
        <div class="modal-footer">
         
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button class="btn btn-danger" data-bs-target="#popupDelete2" data-bs-toggle="modal" ng-click="delete(goingTodelete.idpatient_history)">ลบ</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="popupDelete2" aria-hidden="true" aria-labelledby="popupDeleteLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="popupDeleteLabel2">การแจ้งเตือน</h1>
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
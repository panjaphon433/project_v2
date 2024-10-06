<?php
session_start();
if ($_SESSION == NULL) {
  header("location:../patientlogin.php");
  exit();
}

// ตัวแกร check HN จะถูกใช้ตลอด
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
  <body ng-controller="Patient_hisController">
    <?php include 'nav.php';?>
    <br>
    <div class = "container" ng-init="select()">
      <h1 class="fw-bold">ประวัติการรักษา: รหัสผู้ป่วย {{list[0].HN}} ชื่อ-นามสกุล {{list[0].patient_name}} {{list[0].patient_lastname}}</h1>
        <br/><br/>
        <table class="table table-hover table-striped">
                <thead class="table-head">
                  <tr class="head-content">
                    <th>ลำดับ</th>
                    <th>โรคที่ป่วย</th>
                    <th>รายละเอียดการรักษา</th>
                    <th>ส่วนสูง</th>
                    <th>น้ำหนัก</th>
                    
                    <!-- <th>รายละเอียดการแพ้ยา</th> -->
                    <th>วันที่ทำการรักษา</th>
                    <th>แพทย์ผู้ทำการรักษา</th>
                  </tr>
                </thead>
                <tbody  class="tbody-content">
                  <tr ng-repeat = 'val in list track by $index' class="tbody-content">
                    <td>{{$index+1}}</td>
                    <td>{{val.disease_name}}</td>
                    <td>{{val.detail}}</td>
                    <td>{{val.height}}</td>
                    <td>{{val.weight}}</td>
                    
                    <!-- <td> 
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" ng-click= "select2(val.HN)" data-bs-target="#aaa" >ข้อมูลการแพ้ยา</button>
                    </td> -->
                    <td>{{val.date_treatment | date:'yyyy-MM-dd'}}</td>
                    <td>{{val.admin_name}}   {{val.admin_lastname}}</td>
                    
          
                  </tr>
        </tbody>
        </table>
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
          <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มประวัติการรักษาพยาบาล</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center aligh items-center vh-100">
                <div class="card w-50">
                  <h1 class="text-center">ข้อมูลประวัติการรักษาพยาบาล</h1>
                  <div class="card-body">
                    <form >
                       <div class="mb-3">
                        <label htmlFor="HN" Class="form-lable">
                          HN:
                        </label>
                        <input ng-model = "f2.HN"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกเลขประจำตัวผู้ป่วย"
                        />
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
                        <select class="mb-3" ng-model = "f2.iddisease">
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
                          รายละเอียด:
                        </label>
                        <input ng-model = "f2.detail"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกรายละเอียด"
                        />
                      </div>
                      <div class="mb-3">
                        <label htmlFor="treatment" Class="form-lable">
                         วันที่ทำการรักษา:
                        </label>
                        <input ng-model = "f2.date_treatment"   
                          type="date"
                          class="form-control"
                          placeholder="กรุณากรอกวันที่ทำการรักษา"  
                        />
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
                        <select class="mb-3" ng-model = "f2.idadmin">
                          <option ng-repeat="x in adminlist" ng-value="{{x.idadmin}}">{{x.admin_name}}  {{x.admin_lastname}}</option>
                        </select>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" ng-click ="insert()" class="btn btn-primary" data-bs-dismiss="modal">เพิ่มข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
   
  
   <!-- Modal popup-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">แจ้งเตือน</h1>
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
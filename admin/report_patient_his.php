<?php
session_start();
// echo $_SESSION ["check"];
if ($_SESSION == NULL) {
  header("location:../adminlogin.php");
  exit();
}
?>
<!doctype html>
<html ng-app="patientApp" lang="th" xmlns="http://www.w3.org/1999/xhtml" >
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="patient_his.js"></script>
    <title>ประวัติการรักษาพยาบาล</title>
    <link href="http://cdn.syncfusion.com/24.2.3/js/web/flat-azure/ej.web.all.min.css" rel="stylesheet" /> 
    <script src="http://cdn.syncfusion.com/js/assets/external/jquery-3.0.0.min.js"></script>
    <script src="http://cdn.syncfusion.com/js/assets/external/jsrender.min.js"></script>
    <script src="http://cdn.syncfusion.com/js/assets/external/angular.min.js"></script>
    <script src="http://cdn.syncfusion.com/24.2.3/js/web/ej.web.all.min.js"></script>
    <script src="http://cdn.syncfusion.com/24.2.3/js/common/ej.widget.angular.min.js"></script>

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
      min-height: 50vh;
    }
    .header{
      margin-bottom: 20px;
    }
    .title{
      margin-top: 5px;
      font-weight: bold;
      text-align: center;
    }
    thead{
     text-align: center;
     
    } /* CSS สำหรับการจัดระเบียบฟอร์ม */

    /* CSS สำหรับการปรับรูปแบบฟอร์ม */
    .head-content th{
      background-color: #333a73;
      color: #fff;
    }
    .tbody-content{
      text-align: center;
    }
    .header-content{
      text-align: center;
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
  </style>

  </head>

  <body ng-controller="Patient_hisController">
    <?php include 'navbar_admin.php';?>
    <div class="container-fluid">
      <div class="header">
      <h1 class = "title">รายงานประวัติการรักษาพยาบาล</h1>
    <div class = "container-body">
      <b>โรคที่ผู้ป่วยเข้าทำการรักษา: </b><select class="mb-3 search-patient" ng-model = "s.disease" > 
                          <option value="" >เลือกโรค...</option>
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
        <?php
        echo "<input type='button' class='btn btn-primary' style='float:right;' onclick='javascript:print()' value='สั่งพิมพ์รายงาน'>";
        ?>
      <button class="btn btn-primary" ng-click="select2();">แสดงข้อมูลประวัติผู้ป่วย</button>
      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">
            เพิ่มประวัติการรักษาพยาบาล
      </button> -->
        <br/><br/>
        <table class="table table-hover table-striped">
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
                  </tr>
                </thead>
                <tbody ng-init="select2();" class="tbody-content">
                  <tr ng-repeat = 'val in list track by $index' class="tbody-content">
                    <td>{{$index+1}}</td>
                    <td>{{val.HN}}</td>
                    <td>{{val.patient_name}} {{val.patient_lastname}}</td>
                    <td>{{val.disease_name}}</td>
                    <td>{{val.detail}}</td>
                    <!-- <td> 
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" ng-click= "select2(val.HN)" data-bs-target="#aaa" >ข้อมูลการแพ้ยา</button>
                    </td> -->
                    <td>{{val.date_treatment | date:'yyyy-MM-dd'}}</td>
                    <td>{{val.admin_name}}  {{val.admin_lastname}} </td>
                  </tr>
        </tbody>
        </table>
        <br>
        <h2 class="title">สถิติโรคของผู้ป่วยที่เข้ารับการรักษาพยาบาล</h2>
        <table  class="table table-hover table-striped">
            <head class="table-head">
              <tr class="header-content">
              <th>วันที่รักษา</th>
              <th>โรค</th>
              <th>แพทย์ผู้ทำการรักษา</th>
              <th>จำนวนผู้ป่วยที่เป็นโรคดังกล่าว</th>
              </tr>
            </head>
            <tr ng-repeat = 'val in list2' class="tbody-content">
              <th>{{val.date_treatment}}</th>
              <th>{{val.disease_name}}</th>
              <th>{{val.admin_name}} {{val.admin_lastname}}</th>
              <th>{{val.CNT}}</th>
            </tr>
        </table>
        <!-- <h2>จำนวนสถิติ</h2>
        <table  class="table table-hover" striped>
            <head>
              <tr>
              <th>วันที่รักษา</th>
              <th>โรค</th>
              <th>แพทย์ผู้ทำการรักษา</th>
              <th>จำนวนผู้ป่วยที่เป็นโรคดังกล่าว</th>
              </tr>
            </head>
            <tr ng-repeat = 'val in list2'>
              <th>{{val.date_treatment}}</th>
              <th>{{val.disease_name}}</th>
              <th>{{val.admin_name}} {{val.admin_lastname}}</th>
              <th>{{val.CNT}}</th>
            </tr>
        </table> -->
      </div>   
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

   <!-- Modal popup-->
   <!-- Button trigger modal -->
<!-- Modal -->
<!-- Button trigger modal -->
<!-- Modal -->
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content-fluid">
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
 
 <!-- ลบข้อมูล-->
 <div class="modal fade" id="popupDelete" aria-hidden="true" aria-labelledby="popupDeleteLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="popupDeleteLabel">ลบข้อมูล</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้ ..<br> HN: {{goingTodelete.HN}} ชื่อ-สกุล: {{goingTodelete.patient_name}} {{goingTodelete.patient_lastname}} 
         </div> 
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#popupDelete2" data-bs-toggle="modal" ng-click="delete(goingTodelete.HN)">ลบ</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
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
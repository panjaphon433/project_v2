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
    <script src="appoint.js"></script>
    <title>การนัดหมาย</title>
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
    /* .header{
      margin-bottom: 20px;
    } */
    .title{
      margin-top: 5px;
      font-weight: bold;
      text-align: center;
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
    
    .header-content{
      text-align: center;
    }
    </style>
  </head>
  <body ng-controller="AppointController">
  <?php include 'navbar_admin.php';?>
  <div class="container-fluid">
    <div class="header">
    <h1 class="title">การนัดหมาย</h1>
    </div>
  
    
    <div class = "container-body" ng-init="select()">
	   <b> ค้นหาข้อมูล : </b><input type="text" placeholder="ค้นหาข้อมูลผู้ป่วย" ng-model="s.key" class="search-patient" /> 
      <button class="btn btn-primary" ng-click="select()">ค้นหา</button>
      <a  class="btn btn-primary" href="appoint2.php" style="float:right;">
      แสดงข้อมูลการนัดหมาย 
      </a>
        <br/><br/>
        <table class="table table-hover table-striped" >
                <thead class="table-head">
                  <tr class="head-content">
                    <th>ลำดับ</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุลผู้ป่วย</th>
                    <th>จัดการ</th>
                  </tr>
                </thead>
                <tbody class="tbody-content">

                  <tr ng-repeat = 'val in list track by $index'>
                    <td>{{$index+1}}</td> 
                    <td>{{val.HN}}</td>
                    <td>{{val.patient_name}} {{val.patient_lastname}}</td>
                    <td>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" ng-click= "showupdatefrom_app(val)"data-bs-target="#staticBackdrop">เพิ่มการนัดหมาย </button>
                    </td>   
                  </tr>
                  
        </tbody>
        </table>
      </div>   
      </div>
      </div> 
    </div>
    
      <!-- Button trigger modal -->

  
  <!-- Modal insert-->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content modal-lg modal-dialog-scrollable">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">เพิ่มข้อมูลการนัดหมาย</h1>
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         

        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center aligh items-center vh-100">
                <div class="card w-100">
                  <h1 class="text-center">ข้อมูลการนัดหมาย</h1>
                  <div class="card-body">
                    <form >
                      <div class="mb-3">
                       <label htmlFor="HN" Class="form-lable">
                         HN:
                       </label>
                       <input ng-model = "f2.HN" disabled 
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
                       <label htmlFor="date" Class="form-lable">
                         วัน/เดือน/ปีที่นัด:
                       </label>
                       <input ng-model = "f2.appointment_date1"
                         type="date"
                         class="form-control"
                         placeholder="กรุณากรอกวันเดือนปีที่นัด"  min= "{{f2.appointment_date0 | date:'yyyy-MM-dd'}}" require
                       />                       
                     </div>
                     <div class="mb-3"> <!-- เช้า บ่าย -->
                       <label htmlFor="time" >
                         เวลานัด:
                       </label>
                       <select class="form-select"ng-model = "f2.appointment_time" require> 
                         <option value="1">ช่วงเช้า เวลา 08:00 น. - 12:00 น.</option>
                         <option value="2">ช่วงบ่าย เวลา 13:00 น. - 16:00 น.</option>
                       </select>
                     </div>
                     <div class="mb-3">
                       <label htmlFor="reason" >
                         สาเหตุการนัด:
                       </label>
                       <select class="form-select" ng-model = "f2.appointment_reason" require>
                         <option value="1">รับยา</option>
                         <option value="2">ฟังผล (Follow Up)</option>
                         <option value="3">ทำแผล / ล้างแผล</option>
                         <option value="4">เจาะเลือด (ตรวจโรคฯ)</option>
                         <option value="5">ตรวจน้ำตาล (DTX)</option>
                         <option value="6">วัดความดันฯ</option>
                         <option value="7">แพทย์แผนไทย</option>
                         <option value="8">ทันตกรรม</option>
                         <option value="9">อื่นๆ</option>
                       </select>
                     </div>
                     <div class="mb-3">
                       <label htmlFor="detail" >
                         สิ่งที่ต้องปฏิบัติ:
                       </label>
                       <input ng-model = "f2.detail"
                         type="text"
                         class="form-control"
                         placeholder="สิ่งที่ผู้ป่วยต้องปฏิบัติตาม"
                       />
                     </div>
                     <div class="mb-3">   <!-- select menu ห้องยา ห้องทันต ห้องทำแผล อะไรงี้-->
                       <label htmlFor="location" Class="form-lable">
                         สถานที่นัดหมาย:
                       </label>
                       <select class="form-select" ng-model = "f2.appointment_location">
                         <option value="1">ห้องรับยา</option>
                         <option value="2">คลินิคทันตกรรม </option>
                         <option value="3">ห้องทำแผล / ล้างแผล</option>
                         <option value="4">คลินิคแพทย์แผนไทย</option>    
                         <option value="5">ห้องตรวจโรค</option> 
                         <option value="6">อื่นๆ</option>  
                       </select>
                     </div>
                     <div class="mb-3">
                       <label htmlFor="admin" Class="form-lable" >
                         ผู้นัด:
                       </label>
                       <select class="form-select" ng-model = "f2.idadmin" require>
                          <option ng-repeat="x in adminlist" ng-value= "x.idadmin" ng-selected="x.idadmin == f2.idadmin">{{x.admin_name}}  {{x.admin_lastname}}</option>
                        </select>
                         <!-- ตัวแปรรับมาจาก "admin" login php-->
                         
                     </div>
                   </form>
                  </div>
                </div>                      
              </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
          

          <button type="button" ng-click="insert()" class="btn btn-success" data-bs-dismiss="modal">เพิ่มข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Update-->
  <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">การนัดหมาย</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center aligh items-center vh-100">
                <div class="card w-50">
                  <h1 class="text-center">ข้อมูล</h1>
                  <div class="card-body">
                    <form >
                      <!-- <div class="mb-3">
                        <label htmlFor="HN" Class="form-lable">
                          HN:
                        </label>
                        <input ng-model = "f.HN"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกเลขประจำตัวผู้ป่วย"
                        />
                      </div>
                      <div class="mb-3">
                        <label htmlFor="name" Class="form-lable">
                          ชื่อผู้ป่วย:
                        </label>
                        <input ng-model = "f.name"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกชื่อผู้ป่วย"       
                        />
                      </div> -->
                      <!-- <div class="mb-3">
                        <label htmlFor="lastname" Class="form-lable">
                          นามสกุลผู้ป่วย:
                        </label>
                        <input ng-model = "f.lastname"
                          type="text" 
                          class="form-control"
                          placeholder="กรุณากรอกนามสกุลผู้ป่วย"
                        />
                      </div> -->
                      <div class="mb-3">
                        <label htmlFor="date" Class="form-lable">
                          วัน/เดือน/ปีที่นัด:
                        </label>
                        <input ng-model = "f2.appointment_date"
                          type="date"
                          class="form-control"
                          placeholder="กรุณากรอกวันเดือนปีที่นัด"  min="2024-01-01" 
                        />
                      </div>
                      <div class="mb-3">
                        <label htmlFor="time" Class="form-lable">
                          เวลานัด:
                        </label>
                        <input ng-model = "f2.appointment_date"
                          type="time"
                          class="form-control"
                          placeholder="กรุณาเวลานัดหมาย"
                        />
                      </div>
                      <div class="mb-3">
                        <label htmlFor="reason" Class="form-lable">
                          สาเหตุการนัด:
                        </label>
                        <select class="mb-3">
                          <option value="0">รับยา</option>
                          <option value="1">ฟังผล (Follow Up)</option>
                          <option value="2">ทำแผล / ล้างแผล</option>
                          <option value="3">เจาะเลือด (ตรวจโรคฯ)</option>
                          <option value="4">ตรวจน้ำตาล (DTX)</option>
                          <option value="5">วัดความดันฯ</option>
                          <option value="6">แพทย์แผนไทย</option>
                          <option value="7">ทันตกรรม</option>
                          <option value="8">อื่นๆ</option>
                        </select>
                        <input ng-model = "f2.appointment_reason"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกสาเหตุการนัดหมาย"
                          
                        />
                      </div>
                      <div class="mb-3">
                        <label htmlFor="location" Class="form-lable">
                          สถานที่นัดหมาย:
                        </label>
                        <input ng-model = "f2.appointment_location"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกสถานที่นัดหมาย"
                        />
                      </div>
                      <div class="mb-3">
                        <label htmlFor="admin" Class="form-lable">
                          ผู้นัด:
                        </label>
                        <input ng-model = "f2.idadmin"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกผู้นัด"
                        />
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" ng-click ="update()" class="btn btn-primary" data-bs-dismiss="modal">แก้ไขข้อมูลผู้ป่วย</button>
        </div>
      </div>
    </div>
  </div>
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
        <b>{{a}}</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ng-click="show()">แสดงข้อมูล</button>
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ใบนัดหมาย</button> -->
      </div>
    </div>
  </div>
</div>







</body>
</html>
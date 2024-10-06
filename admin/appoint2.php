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
    /* .table-head{
      background-color: #333a73;
    } */
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
    .btn-edit-delete {
      display: flex;
      gap: 5px; /* ระยะห่างระหว่างปุ่ม */
    }
  </style>
  </head>
  <body ng-controller="Appoint2Controller">
    <?php include 'navbar_admin.php';?>
    <div class="container">
      <div class="header">
      <h1 class="title">การนัดหมาย</h1>
      </div>
    
    
    <div class = "container-body">
	   <b> ค้นหาข้อมูล :</b> <input type="text" placeholder="ค้นหาข้อมูลการนัดหมาย" ng-model="s.key" class="search-patient"/>
      <input ng-model = "s.date0"
                          type="date"
                           class="mb-3" 
                          placeholder="กรุณากรอกวันเดือนปีที่นัด"  
      
                        />
                        <select class="mb-3" ng-model = "s.status"> 
                         <option value="" >ยังไม่มาตามนัด</option>
                          <option value="1" >มาตามนัดหมายแล้ว</option>
                          <option value="2" >ไม่มาตามนัด</option>
                        </select>  
                        <select class="mb-3" ng-model = "s.time"> 
                         <option value="" ></option>
                          <option value="1">ช่วงเช้า เวลา 08:00 น. - 12:00 น.</option>
                        
                          <option value="2">ช่วงบ่าย เวลา 13:00 น. - 16:00 น.</option>
>

                        </select>                 
      <button class="btn btn-primary" ng-click="select()">แสดงข้อมูลการนัดหมาย</button>
        <br/><br/>
        <table class="table table-hover table-striped" ng-show="list.length > 0" >
                <thead class="table-head">
                  <tr class="head-content">
                    <th rowspan="2">ลำดับ</th>
                    <th rowspan="2">HN</th>
                    <th rowspan="2">ชื่อ-สกุลผู้ป่วย</th>
                    <th rowspan="2">เบอร์โทรติดต่อ</th>
                    <th rowspan="2">วันที่นัดหมาย</th>
                    <th rowspan="2">เวลานัดหมาย</th>
                    <th rowspan="2">สถานที่นัดหมาย</th>
                    <th rowspan="2">สาเหตุการนัด</th>
                    <th rowspan="2">สิ่งที่ต้องปฏิบัติ</th>
                    <th rowspan="2">แพทย์ผู้นัด</th>
                    <th rowspan="2">สถานะการนัดหมาย</th>
                    <th rowspan="2">จัดการ</th>
                  </tr>
                </thead>
                <tbody ng-init="select();" class="tbody-content">
                  <tr ng-repeat = 'val in list track by $index'>
                    <td>{{$index+1}}</td>
                    <td>{{val.HN}}</td>
                    <td>{{val.patient_name}}   {{val.patient_lastname}}</td>
                    <td>{{val.patient_phone}}</td>
                    <td>{{val.appointment_date | date:'dd-MM-yyyy'}}</td>
                    <td>{{val.time_name}}</td>
                    <td>{{val.location_name}}</td>
                    <td>{{val.reason_name}}</td>
                    <td>{{val.detail}}</td>
                    <td>{{val.admin_name}}   {{val.admin_lastname}}</td>
                    <td>
                      <select class="mb-3" style="width: 7rem;" ng-model = "val.status" ng-change ="switchStatus(val.status,val.idappointment)"> 
                        <option value="" ></option>
                        <option value="1" ng-selected="'1' == val.status">มาตามนัดหมายแล้ว</option>
                        <option value="2" ng-selected="'2' == val.status">ไม่มาตามนัด <br> หมายเหตุ อสม.ส่งยาให้</option>
                      </select>
                      <!-- <button type="button" className="btn btn-warning" data-bs-toggle="modal" ng-click= "switchStatus(val.status,val.idappointment)" >บันทึก</button> -->
                    </td>
                    <td>
                      <div class="btn-edit-delete">

                      
                      <button type="button" style="width: 7rem;" class="btn btn-warning" data-bs-toggle="modal" ng-click= "showupdatefrom_app(val)" data-bs-target="#updateModal" >แก้ไข</button>
                      <button type="button" style="width: 7rem;" class="btn btn-primary" ng-click= "appoint(val)">ใบนัดหมาย</button>
                      <button type="button" style="width: 7rem;" class="btn btn-success" ng-click="sendLine(val)">แจ้งเตือนไลน์</button>
                      <!-- <button type="button" className="btn btn-danger" data-bs-toggle="modal" ng-click= "delete(val.idappointment)">ลบ</button> -->
                      </div>
                    </td>   
                    
                  </tr>
              
        </tbody>
        </table>

        <table class="table table-hover" ng-hide="list.length > 0" striped>
                <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุลผู้ป่วย</th>
                    <th>เบอร์โทรติดต่อ</th>
                    <th>วันที่นัดหมาย</th>
                    <th>เวลานัดหมาย</th>
                    <th>สถานที่นัดหมาย</th>
                    <th>สาเหตุการนัด</th>
                    <th>สิ่งที่ต้องปฏิบัติ</th>
                    <th>แพทย์ผู้นัด</th>
                    <th>สถานะการนัดหมาย</th>
                    <th>จัดการ</th>
                  </tr>
                </thead>
                <tbody ng-init="select3();">
                  <tr ng-repeat = 'val in list3 track by $index'>
                    <td>{{$index+1}}</td>
                    <td>{{val.HN}}</td>
                    <td>{{val.patient_name}}   {{val.patient_lastname}}</td>
                    <td>{{val.patient_phone}}</td>
                    <td>{{val.appointment_date | date:'yyyy-MM-dd'}}</td>
                    <td>{{val.time_name}}</td>
                    <td>{{val.location_name}}</td>
                    <td>{{val.reason_name}}</td>
                    <td>{{val.detail}}</td>
                    <td>{{val.admin_name}}   {{val.admin_lastname}}</td>
                    <td>
                      <select class="mb-3" ng-model = "val.status" ng-change ="switchStatus(val.status,val.idappointment)"> 
                        <option value="" ></option>
                        <option value="1" ng-selected="'1' == val.status">มาตามนัดหมายแล้ว</option>
                        <option value="2" ng-selected="'2' == val.status">ไม่มาตามนัด <br> หมายเหตุ อสม.ส่งยาให้</option>
                      </select>
                      <!-- <button type="button" className="btn btn-warning" data-bs-toggle="modal" ng-click= "switchStatus(val.status,val.idappointment)" >บันทึก</button> -->
                    </td>
                    <td>
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" ng-click= "showupdatefrom_app(val)" data-bs-target="#updateModal" >แก้ไข</button>
                      <button type="button" class="btn btn-primary" ng-click= "appoint(val)">ใบนัดหมาย</button>
                      <!-- <button type="button" className="btn btn-danger" data-bs-toggle="modal" ng-click= "delete(val.idappointment)">ลบ</button> -->
                    </td>   
                  </tr>
              
        </tbody>
        </table>
      </div>   
      </div> 
    </div>
    </div>
    
      <!-- Button trigger modal เอาไว้ใส่ย้อยกลับ หรืออะไรเอา-->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
   เพิ่มการนัดหมาย 
  </button> -->
  
  <!-- Modal insert-->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content modal-lg modal-dialog-scrollable">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">ข้อมูลการนัดหมาย</h1>
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
                        <input ng-model = "f2.HN"
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกเลขประจำตัวผู้ป่วย"
                        />
                      </div>
                      <div class="mb-3">
                        <label htmlFor="name" Class="form-lable">
                          ผู้ป่วย : {{f2.patient_name}}     {{f2.patient_lastname}}
                        </label>
                      </div>     
                      <div class="mb-3">
                        <label htmlFor="phone" Class="form-lable">
                          เบอร์โทรติดต่อ : 
                        </label>
                        <input ng-model = "f2.patient_phone"
                        type="text"
                        class="form-control"
                        placeholder="กรุณากอกเบอร์โทรศัพท์ของผู้ป่วย"
                        />
                      </div>            
                      <div class="mb-3">
                        <label htmlFor="date" Class="form-lable">
                          วัน/เดือน/ปีที่นัด:
                        </label>
                        <input ng-model = "f2.appointment_date"
                          type="date"
                          class="form-control"
                          placeholder="กรุณากรอกวันเดือนปีที่นัด"   min="2024-01-01" 
                        />
                      </div>
                      <div class="mb-3"> <!-- เช้า บ่าย -->
                        <label htmlFor="time" >
                          เวลานัด:
                        </label>
                        <select class="form-select" ng-model = "f2.appointment_time">
                          <option value="1">ช่วงเช้า เวลา 08:00 น. - 12:00 น.</option>
                          <option value="2">ช่วงบ่าย เวลา 13:00 น. - 16:00 น.</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label htmlFor="reason" >
                          สาเหตุการนัด:
                        </label>
                        <select class="form-select" ng-model = "f2.appointment_reason">
                          <option value="1">รับยา</option>
                          <option value="2">ฟังผล (Follow Up)</option>
                          <option value="3">ทำแผล / ล้างแผล</option>
                          <option value="4">เจาะเลือด (ตรวจโรคฯ)</option>
                          <option value="5">ตรวจน้ำตาล (DTX)</option>
                          <option value="6">วัดความดันฯ</option>
                          <option value="7">แพทย์แผนไทย</option>
                          <option value="8">ทันตกรรม</option>
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
                          <option value="4">ห้องตรวจโรค</option>   
                        </select>
                      </div>
                      <div class="mb-3">
                        <label htmlFor="admin" Class="form-lable">
                          ผู้นัด:
                        </label>
                        <input ng-model = "f2.admin" 
                          type="text"
                          class="form-control"
                          placeholder="กรุณากรอกผู้นัด" value="{{admin}}" 
                        />
                          <!-- ตัวแปรรับมาจาก "admin" login php-->
                      </div>
                      <div class="mb-3">   <!-- select menu สถานะ ไปสร้าง table -->
                        <label htmlFor="location" Class="form-lable">
                          สถานะการนัดหมาย:
                        </label>
                        <select class="form-select" ng-model = "f2.status">
                          <option value="1">มาตามนัดหมายแล้ว</option>
                          <option value="2">ไม่มาตามนัด</option>
                        </select>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" ng-click ="insert()" class="btn btn-primary" data-bs-dismiss="modal">เพิ่มข้อมูลการนัดหมาย</button>
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
                <div class="card w-100">
                  <h1 class="text-center">ข้อมูล</h1>
                  <div class="card-body">
                    <form >
                      <div class="mb-3">
                       <label htmlFor="HN" Class="form-lable">
                         HN:
                       </label>
                       <input ng-model = "f3.HN" disabled
                         type="text"
                         class="form-control"
                         placeholder="กรุณากรอกเลขประจำตัวผู้ป่วย"
                       />
                     </div>
                     <div class="mb-3">
                       <label htmlFor="name" Class="form-lable">
                         ผู้ป่วย : {{f3.patient_name}}     {{f3.patient_lastname}}
                       </label>
                     </div>            
                     <div class="mb-3">
                      <label htmlFor="phone" Class="form-lable">
                        เบอร์โทรติดต่อ : 
                      </label>
                      <input ng-model = "f3.patient_phone"
                      type="text"
                      class="form-control"
                      placeholder="กรุณากอกเบอร์โทรศัพท์ของผู้ป่วย"
                      />
                    </div>          
                     <div class="mb-3">
                       <label htmlFor="date" Class="form-lable">
                         วัน/เดือน/ปีที่นัด: 
                       </label>
                       <input ng-model = "f3.appointment_date"
                         type="date"
                         class="form-control"
                         placeholder="กรุณากรอกวันเดือนปีที่นัด"  min="2024-01-01" 
                       />
                     </div>
                     <div class="mb-3"> <!-- เช้า บ่าย -->
                       <label htmlFor="time" >
                         เวลานัด: 
                       </label>
                       <select class="form-select" ng-model = "f3.appointment_time">
                         <option value="1" ng-selected="'1' == f3.appointment_time" >ช่วงเช้า เวลา 08:00 น. - 12:00 น.</option>
                         <option value="2" ng-selected="'2' == f3.appointment_time" >ช่วงบ่าย เวลา 13:00 น. - 16:00 น.</option>
                       </select>
                     </div>
                     <div class="mb-3">
                       <label htmlFor="reason" >
                         สาเหตุการนัด: 
                       </label>
                       <select class="form-select" ng-model = "f3.appointment_reason">
                         <option value="1" ng-selected="'1' == f3.appointment_reason" >รับยา</option>
                         <option value="2" ng-selected="'2' == f3.appointment_reason">ฟังผล (Follow Up)</option>
                         <option value="3" ng-selected="'3' == f3.appointment_reason">ทำแผล / ล้างแผล</option>
                         <option value="4" ng-selected="'4' == f3.appointment_reason">เจาะเลือด (ตรวจโรคฯ)</option>
                         <option value="5" ng-selected="'5' == f3.appointment_reason">ตรวจน้ำตาล (DTX)</option>
                         <option value="6" ng-selected="'6' == f3.appointment_reason">วัดความดันฯ</option>
                         <option value="7" ng-selected="'7' == f3.appointment_reason">แพทย์แผนไทย</option>
                         <option value="8" ng-selected="'8' == f3.appointment_reason">ทันตกรรม</option>
                       </select>
                     </div>
                     <div class="mb-3">
                       <label htmlFor="detail" >
                         สิ่งที่ต้องปฏิบัติ:
                       </label>
                       <input ng-model = "f3.detail"
                         type="text"
                         class="form-control"
                         placeholder="สิ่งที่ผู้ป่วยต้องปฏิบัติตาม"
                       />
                     </div>
                     <div class="mb-3">   <!-- select menu ห้องยา ห้องทันต ห้องทำแผล อะไรงี้-->
                       <label htmlFor="location" Class="form-lable">
                         สถานที่นัดหมาย: 
                       </label>
                       <select class="form-select" ng-model = "f3.appointment_location">
                         <option value="1" ng-selected="'1' == f3.appointment_location">ห้องรับยา</option>
                         <option value="2" ng-selected="'2' == f3.appointment_location">คลินิคทันตกรรม </option>
                         <option value="3" ng-selected="'3' == f3.appointment_location">ห้องทำแผล / ล้างแผล</option>
                         <option value="4" ng-selected="'4' == f3.appointment_location">คลินิคแพทย์แผนไทย</option>    
                         <option value="4" ng-selected="'5' == f3.appointment_location">ห้องตรวจโรค</option>   
                       </select>
                     </div>
                     <!-- <div class="mb-3">
                       <label htmlFor="admin" Class="form-lable">
                         ผู้นัด:
                       </label>
                       <input ng-model = "f3.admin" 
                         type="text"
                         class="form-control"
                         placeholder="กรุณากรอกผู้นัด" value="{{admin}}" 
                       />
                         //ตัวแปรรับมาจาก "admin" login php
                     </div> -->
                     <div class="mb-3">
                       <label htmlFor="admin" Class="form-lable">
                         ผู้นัด:
                       </label>
                       <select class="form-select" ng-model = "f3.idadmin">
                          <option ng-repeat="x in adminlist" ng-value= "x.idadmin" ng-selected="x.idadmin == f3.idadmin">{{x.admin_name}}  {{x.admin_lastname}}</option>
                        </select>
                         <!-- ตัวแปรรับมาจาก "admin" login php-->
                     </div>

                     <!-- <div class="mb-3">   
                      <label htmlFor="location" Class="form-lable">
                        สถานะการนัดหมาย:
                      </label>
                      <select class="mb-3" ng-model = "f3.status">
                        <option value="1">มาตามนัดหมายแล้ว</option>
                        <option value="2">ไม่มาตามนัด</option>
                      </select>
                    </div> -->
                   </form>
                  </div>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="button" ng-click ="update()" class="btn btn-success" data-bs-dismiss="modal">บันทึกข้อมูลการนัดหมาย</button>
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
 




</body>
</html>
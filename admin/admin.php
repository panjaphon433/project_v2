<?php
session_start();
// echo $_SESSION ["check"];
?>
<!doctype html>
<html ng-app="patientApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="admin.js"></script>
  <title>ข้อมูลเจ้าหน้าที่</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    /* CSS สำหรับการจัดระเบียบฟอร์ม */

    /* CSS สำหรับการปรับรูปแบบฟอร์ม */
    body {
            background-image: url('/appoint-project/admin/images/lio.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /* ความสูงเต็มหน้าจอ */
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
    .container{
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 80vh;
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
    .btn-edit-delete {
      display: flex;
      gap: 5px; /* ระยะห่างระหว่างปุ่ม */
    }
    .header-content{
      text-align: center;
    }
  </style>
</head>

<body ng-controller="AdminController">
  <?php include 'navbar_admin.php'; ?>
  <div class="container">
    <div class="header">
    <h1 class ="title">ข้อมูลเจ้าหน้าที่</h1>
  <div class="container-body">
    <b>ค้นหาข้อมูล : </b><input type="text" placeholder="ค้นหาข้อมูลเจ้าหน้าที่" ng-model="s.key" class="search-patient"/>
    <button class="btn btn-primary" ng-click="select()">แสดงข้อมูลเจ้าหน้าที่</button>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">
      <i class="bi bi-person-plus"></i>เพิ่มเจ้าหน้าที่
    </button>
    <br /><br />

    <table class="table table-hover table-striped">
      <thead class="table-head">
        <tr class="head-content">  
          <th>ลำดับ</th>
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>ตำแหน่ง</th>
          <th>เลขประจำตัวประชาชน</th>
          <th>ชื่อผู้ใช้</th>
          <th>รหัสผ่าน</th>
          <th>การจัดการ</th>
        </tr>
      </thead>
      <tbody ng-init="select();" class="tbody-content">
        <tr ng-repeat='val in list track by $index' class="tbody-content">
          <td>{{$index+1}}</td> 
          <td>{{val.admin_name}} </td>
          <td>{{val.admin_lastname}}</td>
          <td>{{val.admin_position}}</td>
          <td>{{val.admin_idcard}}</td>
          <td>{{val.admin_username}}</td>
          <td>{{val.admin_password}}</td>
          <td>
            <!-- <a href="" class="btn btn-dark mb-3 text-white">แก้ไข</a> -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" ng-click="showupdatefrom(val)" data-bs-target="#updateModal"><i class="bi bi-pen"></i>แก้ไข</button>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" ng-click="confirmDelete(val)" data-bs-target="#popupDelete"><i class="bi bi-trash"></i>ลบ</button>
          </td>
        </tr>


      </tbody>
    </table>
  </div>
  </div>
  </div>
  </div>


  <!-- Modal Update-->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">แก้ไขข้อมูลเจ้าหน้าที่</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="d-flex flex-column">
            <div class="mb-3 d-flex">
                <div class="flex-grow-1 me-3">
                    <label htmlFor="name" Class="form-lable"><b>ชื่อ:</b></label>
                    <input ng-model="f2.admin_name" type="text" class="form-control" placeholder="กรุณากรอกชื่อ" />
                </div>
                <div class="flex-grow-1">
                    <label htmlFor="lastname" Class="form-lable"><b> นามสกุล:</b> </label>
                    <input ng-model="f2.admin_lastname" type="text" class="form-control" placeholder="กรุณากรอกนามสกุล" />
                </div>
            </div>
            <div class="mb-3">
              <label htmlFor="position" Class="form-lable">
                ตำแหน่ง:
              </label>
              <input ng-model="f2.admin_position" type="text" class="form-control" placeholder="กรุณากรอกตำแหน่ง" />
            </div>

            <div class="mb-3">
              <label htmlFor="idcard" Class="form-lable">
                เลขประจำตัวประชาชน:
              </label>
              <input ng-model="f2.admin_idcard" ui-mask="9-9999-99999-99-9" ui-mask-placeholder-char=" " clear-on-blur-placeholder="true" type="text" class="form-control" placeholder="กรุณากรอกเลขประจำตัวประชาชน" />
            </div>
            <div class="mb-3">
              <label htmlFor="password" Class="form-lable">
                ชื่อผู้ใช้งาน:
              </label>
              <input ng-model="f2.admin_username" type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้ใช้งาน" />
            </div>
            <div class="mb-3">
              <label htmlFor="password" Class="form-lable">
                รหัสผ่าน:
              </label>
              <input ng-model="f2.admin_password" type="text" class="form-control" placeholder="กรุณากรอกรหัสผ่าน" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="button" ng-click="update()" class="btn btn-success" data-bs-dismiss="modal">บันทึกข้อมูลเจ้าหน้าที่</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal insert-->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content modal-lg modal-dialog-scrollable">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">เพิ่มข้อมูลเจ้าหน้าที่รายใหม่</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-center aligh items-center vh-100">
            <!-- <div class="card w-70"> -->
            <div class="card w-100">
              <div class="left">
                <h1 class="text-center fw-bold">ข้อมูล</h1>
                <div class="card-body">
                  <form class="d-flex flex-column">
                    <div class="mb-3 d-flex">
                        <div class="flex-grow-1 me-3">
                            <label htmlFor="name" Class="form-lable"> <b>ชื่อ:</b></label>
                            <input ng-model="f.admin_name" type="text" class="form-control" placeholder="กรุณากรอกชื่อ" />
                        </div>
                        <div class="flex-grow-1">
                            <label htmlFor="lastname" Class="form-lable"><b>นามสกุล:</b></label>
                            <input ng-model="f.admin_lastname" type="text" class="form-control" placeholder="กรุณากรอกนามสกุล" />
                        </div>
                    </div>
                    <div class="mb-3">
                      <label htmlFor="position" Class="form-lable">
                        ตำแหน่ง:
                      </label>
                      <input ng-model="f.admin_position" type="text" class="form-control" placeholder="กรุณากรอกตำแหน่ง" />
                    </div>

                    <div class="mb-3">
                      <label htmlFor="idcard" Class="form-lable">
                        เลขประจำตัวประชาชน:
                      </label>
                      <input ng-model="f.admin_idcard" ui-mask="9-9999-99999-99-9" ui-mask-placeholder-char=" " clear-on-blur-placeholder="true" type="text" class="form-control" placeholder="กรุณากรอกเลขประจำตัวประชาชน" />
                    </div>
                    <div class="mb-3">
                      <label htmlFor="username" Class="form-lable">
                        ชื่อผู้ใช้งาน:
                      </label>
                      <input ng-model="f.admin_username" type="text" class="form-control" placeholder="กรุณากรอกชื่อผู้ใช้งาน" />
                    </div>
                    <div class="mb-3">
                      <label htmlFor="password" Class="form-lable">
                        รหัสผ่าน:
                      </label>
                      <input ng-model="f.admin_password" type="text" class="form-control" placeholder="กรุณากรอกรหัสผ่าน" />
                    </div>
                  </form>
                </div>

              </div>
              <!-- </div> -->
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="button" ng-click="insert()" class="btn btn-success">เพิ่มข้อมูลเจ้าหน้าที่</button>
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
          <h5 class="modal-title" id="exampleModalLabel">ช้อความแจ้งเตือน</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">ช้อความแจ้งเตือน</h5>
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
          <b>คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้ .. </b><br>  <b>ชื่อ-สกุล:</b>{{goingTodelete.admin_name}} {{goingTodelete.admin_lastname}}
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-target="#popupDelete2" data-bs-toggle="modal" ng-click="delete(goingTodelete.admin_idcard)">ลบ</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
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
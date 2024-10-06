<!DOCTYPE html>
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
  </head>
   <body ng-controller="Appoint2Controller">
    <?php include 'navbar_admin.php';?>
    <h1 class>ประวัติการนัดหมาย</h1>
    <table class="table table-hover" striped>
                <thead>
                  <tr>
                    <th>ลำดับ</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุลผู้ป่วย</th>
                    <th>เบอร์โทรติดต่อ</th>
                    <th>วันที่นัดหมาย</th>
                    <th>สถานะการนัดหมาย</th>
                    <th>จัดการ</th>
                    
                  </tr>
                </thead>
                <tbody>

                  <tr ng-repeat = 'val in list track by $index'>
                    <td>{{$index+1}}</td>
                    <td>{{val.HN}}</td>
                    <td>{{val.patient_name}}   {{val.patient_lastname}}</td>
                    <td>{{val.patient_phone}}</td>
                    <td>{{val.appointment_date | date:'yyyy-MM-dd'}}</td>
                    <td>
                      <select class="mb-3" ng-model = "val.status" ng-change ="switchStatus(val.status,val.idappointment)"> 
                        <option value="" ></option>
                        <option value="1" ng-selected="'1' == val.status">มาตามนัดหมายแล้ว</option>
                        <option value="2" ng-selected="'2' == val.status">ไม่มาตามนัด <br> หมายเหตุ อสม.ส่งยาให้</option>
                      </select>
                      <!-- <button type="button" className="btn btn-warning" data-bs-toggle="modal" ng-click= "switchStatus(val.status,val.idappointment)" >บันทึก</button> -->
                    </td>  
                  </tr>
              
        </tbody>
        </table>
   </body>
</html>
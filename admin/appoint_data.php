
<?php
session_start();
// echo $_SESSION ["check"];
if ($_SESSION == NULL) {
  header("location:../login.php");
  exit();
}
// else if ($_SESSION["admin_position"] != "แพทย์" ) {
//   header("location:../admin/patient_his.php");
//   exit();
// }
?><!doctype html>
<html ng-app="patientApp" lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="appoint2.js"></script>
    <title>ใบนัดหมาย</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<style>
    body {
            background-image: url('/appoint-project/admin/images/lio.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /* ความสูงเต็มหน้าจอ */
  margin: 0;
        }
    .center_screen {
        position: absolute;
        /* top: 45%;
        left: 45%; */
        /* margin-top: -50px;
        margin-left: -50px; */
        width: auto;
        height: auto;
        text-align: center;
        border: solid 1px #333;
        border-radius: 10px;
        padding: .5rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* เพิ่มเงาในรูปแบบ rgba(สี, แสง, ความโปร่งแสง, ความโปร่งแสง) */
    }
    .container-body {
        display: flex;
        justify-content: center; /* จัดให้อยู่กลางแนวนอน */
        align-items: center; /* จัดให้อยู่กลางแนวตั้ง */
        height: 80vh; /* ทำให้ container-body เต็มส่วนความสูงของหน้าจอ */
    }
    /* .header{
      margin-bottom: 20px;
    } */
    .title{
      margin-top: 5px;
      font-weight: bold;
      text-align: center;
    }

</style>

<body>
    <?php include 'navbar_admin.php'; ?>
    <div class="container">
        
        <div class="header">
        <h1 class="title">ใบนัดหมาย</h1>
        
        </div>
        <?php
        echo "<input type='button' class='btn btn-primary' style='float:right;' onclick='javascript:print()' value='สั่งพิมพ์ใบนัดหมาย'>";
        ?>
        <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='appoint2.php'">ย้อนกลับ</button>
            </div>      
        <div class="container-body">
        <div class="center_screen">
        <h1 class="text-bg-light p-1">
            <p >HN : <?php echo $_GET["hn"]; ?> </p>
            <p >ชื่อ-สกุลผู้ป่วย : <?php echo $_GET["name"], "   ", $_GET["lastname"]; ?></p>
            <p >วันที่นัดหมาย : <?php echo $_GET["date"]; ?></p>
            <p >เวลานัดหมาย : <?php echo $_GET["time"]; ?></p>
            <p >สถานที่นัดหมาย : <?php echo $_GET["location"]; ?></p>
            <p >สาเหตุการนัด : <?php echo $_GET["reason"]; ?></p>
            <p >แพทย์ผู้นัด : <?php echo $_GET["adname"], "   ", $_GET["adlastname"]; ?></p>

            </h1>
        </div>
        </div>  
    </div>
    
    
</body>

</html>

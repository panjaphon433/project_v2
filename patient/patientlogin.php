

<!DOCTYPE html>
<html ng-app="loginApp" lang="th">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <title>เข้าสู่ระบบ</title>
  <script src="login.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <!-- import fonts icon -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<style>
  body {
    
    background-image: url('/appoint-project/admin/images/lio.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
    
  /* สีส้ม #ff6f61 ไปยังสีฟ้า #5e96ae */
  height: 100vh; /* ความสูงเต็มหน้าจอ */
  margin: 0;
  }
  .container{
    height: 100%;
  }
  .card{
    display: flex;
    flex-direction: row;
    width: 80%;
    max-width: 600px;
    box-shadow: 1px solid #333;
  }
  .card-img-left{
    width: 200px;
    height: 200px;
    flex-shrink: 0;
    margin-top: 50px;
    margin-left: 10px;
    
  }
  .card-body{
    flex-grow: 1;
  }


.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .form-floating {
  margin-bottom: 10px;
}

.form-signin .form-floating label {
  margin-left: 5px;
}

.form-signin .form-control {
  height: 40px;
}

.form-check {
  margin-top: 10px;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0056b3;
  border-color: #0056b3;
}

.modal-title {
  color: #007bff;
}

.modal-content {
  background-color: #fff;
  border-radius: 10px;
}

.modal-body {
  color: #000;
}

.modal-footer {
  justify-content: center;
}
.form-header h1{
  font-size: 1.2rem;
  font-weight: bold;
}
.form-floating{
  display: flex;
  align-items: center;
}
.icon-container {
  margin-right: 10px; 
}
  /* body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f2f2f2;
  }

  footer {
    position: fixed;
    bottom: 0;
    width: 100%;
  }

  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
  }

  .form-signin .checkbox {
    font-weight: 400;
  }

  .form-signin .form-floating:focus-within {
    z-index: 2;
  } */
</style>

<body ng-controller="loginController" class="bg-light">
  <div class="container d-flex justify-content-center align-items-center h-100">
    <div class="card">
    <img src="../admin/images/panm.png" alt="" class="card-img-left">
    <div class="card-body">
    <main class="form-signin ">
    <form>
      <!-- <img class="mb-4" src="" alt="" width="72" height="57"> -->
      <h1 align="center" class="h3 mb-3 fw-normal form-header">กรุณาเข้าสู่ระบบ</h1>

      <div class="form-floating d-flex align-items-center">
        <input type="text" class="form-control" placeholder="เลขประจำตัวประชาชน" ng-model="s.patient_idcard">
        <label for="username" class="d-flex align-items-center">
        <div class="icon-container">
          <span class="material-symbols-outlined">
          face
          </span>
        </div>กรุณากรอกชื่อผู้ใช้งาน</label>
      </div>
      <div class="form-floating d-flex align-items-center">
        <input type="password" class="form-control" placeholder="รหัสผ่าน" ng-model="s.patient_password">
        <label for="password" class="d-flex align-items-center">
          <div class="icon-container">
          <span class="material-symbols-outlined">
          lock
          </span>
        </div>กรุณากรอกรหัสผ่าน</label>
        </div>
        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            จำผู้ใช้งาน
          </label>
        </div>
      <button class="btn btn-primary w-100 py-2" type="submit" ng-click="login()">เข้าสู่ระบบ</button>
      <!-- <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p> -->
    </form>
  </main>

  <!-- Modal -->
<div class="modal fade" id="popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
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
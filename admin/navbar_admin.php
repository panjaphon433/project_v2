 <nav class="navbar navbar-expand-lg navbar-dark "style="background-color: #333a73; font-size:1.1rem;"> 
    <!-- <nav style="background-color: #e3f2fd #333A73;" ></nav> สีพื้นหลังแบบนี้ก็ได้ -->
        <div class="container-fluid">
            <!-- โลโก้รูปภาพ -->
            <a class="navbar-brand" href="#">
                <img src="/appoint-project/admin/images/panm.png" alt="โรงพยาบาลส่งเสริมสุขภาพแม่กา" height="40">
                <b>โรงพยาบาลส่งเสริมสุขภาพแม่กา</b>
            </a>
            <!-- ปุ่มเมนูสำหรับแสดงหรือซ่อนเมนูในแบบ mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- เมนู -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">หน้าแรก</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-lines-fill" ></i>ผู้ป่วย
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="patient.php">ข้อมูลผู้ป่วย</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-folder"></i> การรักษาพยาบาล
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="patient_hisadd.php">เพิ่มประวัติการรักษาพยาบาล</a></li>
                            <!-- <li><a class="dropdown-item" href="#">ประวัติการแพ้ยา</a></li> -->
                            <li><a class="dropdown-item" href="patient_his.php">ประวัติการรักษา</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-display"></i>การนัดหมาย
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="appoint.php">เพิ่มการนัดหมาย</a></li>
                            <li><a class="dropdown-item" href="appoint2.php">ประวัติการนัดหมาย</a></li>
                          

                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-display"></i>รายงาน
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="report_patient.php">รายชื่อผู้ป่วยทั้งหมดที่เข้ารับบริการ</a></li>
                            <li><a class="dropdown-item" href="report_patient_his.php">รายชื่อผู้ป่วยทั้งหมดที่เป็นโรคแตกต่างกัน</a></li>
                            <li><a class="dropdown-item" href="report_appoint.php">รายชื่อผู้ป่วยทั้งหมดตามการนัดหมาย</a></li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">
                            <i class="bi bi-people"></i>เจ้าหน้าที่
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">
                            <i class="bi bi-person"></i>โปรไฟล์
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="../logout.php" >
                            <i class="bi bi-box-arrow-right"></i>ออกจากระบบ
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <button class="btn btn-outline-success me-2" href="#" type="button">เข้าสู่ระบบ</button>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>




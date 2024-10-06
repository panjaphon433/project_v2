<?php
    
    // $prefixURL = 'http://10.50.16.231/appoint-project';
    $prefixURL = 'http://localhost/appoint-project';
    
?>
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #333a73; font-size:1.1rem;">
    <div class="container-fluid">
        <!-- โลโก้รูปภาพ -->
        <a class="navbar-brand" href="home.php">
            <img src="/appoint-project/admin/images/panm.png" alt="โรงพยาบาลส่งเสริมสุขภาพแม่กา" height="40">
            <b>โรงพยาบาลส่งเสริมสุขภาพแม่กา
        </a>
        <!-- ปุ่มเมนูสำหรับแสดงหรือซ่อนเมนูในแบบ mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- เมนู -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo $prefixURL; ?>/patient/appoint.php" role="button" aria-expanded="false">
                        <i class="bi bi-display"></i>การนัดหมาย
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo $prefixURL; ?>/patient/patient_his.php" role="button" aria-expanded="false">
                        <i class="bi bi-folder"></i>การรักษาพยาบาล
                    </a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-activity"></i>กราฟสุขภาพ
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo $prefixURL; ?>/patient/graph.php">สถิติ BMI</a></li>
                        <li><a class="dropdown-item" href="<?php echo $prefixURL; ?>/patient/graph2.php">สถิติค่าความดัน</a></li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $prefixURL; ?>/patient/Health.php">
                        <i class="bi bi-clipboard-heart"></i>แนะนำสุขภาพ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $prefixURL?>/patient/lineNotify/line_access.php">
                        <i class="bi bi-line"></i> รับการแจ้งเตือนผ่านไลน์
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $prefixURL; ?>/patient/profile.php">
                        <i class="bi bi-person"></i>โปรไฟล์
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo $prefixURL; ?>/logout.php">
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
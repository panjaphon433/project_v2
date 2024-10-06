<?php
session_start();
define('CLIENT_ID', 'LjrjVmwS9kQRCncLoEmtZ9');
define('LINE_API_URI', 'https://notify-bot.line.me/oauth/authorize?');
define('CALLBACK_URI', 'http://10.50.19.56/appoint-project/patient/lineNotify/saveLineToken.php');

$queryStrings = [
    'response_type' => 'code',
    'client_id' => CLIENT_ID,
    'redirect_uri' => CALLBACK_URI,
    'scope' => 'notify',
    'state' => 'abcdef123456'
];

$queryString = LINE_API_URI . http_build_query($queryStrings);

?>

<!DOCTYPE html>
<html lang="en">
<style>
        body {
            background-image: url('/appoint-project/admin/images/lio.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh; /* ความสูงเต็มหน้าจอ */
  margin: 0;
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="  https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"> </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"> </script>
</head>

<body>
    <?php  include '../nav.php';
    
    ?>
    <div class="container d-flex justify-content-center mt-5">
        <div class="card" style="width: 18rem;">
            <img src="../../admin/images/line.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">แจ้งเตือนผ่านไลน์</h5>
                <p class="card-text">กดเพื่อรับToken</p>
                <a href="<?php echo $queryString; ?>" class="btn btn-success">รับการแจ้งเตือนผ่านไลน์</a>
            </div>
        </div>
    </div>

</body>

</html>
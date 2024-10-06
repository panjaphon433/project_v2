

    <?php
    error_reporting(0);
    session_start();
    define('CLIENT_ID', 'LjrjVmwS9kQRCncLoEmtZ9');
    define('CLIENT_SECRET', 'yjgD3WgNcMHNE7yIsLivfJgzjgl8uHFrBrVxhtu4mJo');
    define('LINE_API_URI', 'https://notify-bot.line.me/oauth/token');
    define('CALLBACK_URI', 'http://10.50.19.56/appoint-project/patient/lineNotify/saveLineToken.php');

    parse_str($_SERVER['QUERY_STRING'], $queries);

    $fields = [
        'grant_type' => 'authorization_code',
        'code' => $queries['code'],
        'redirect_uri' => CALLBACK_URI,
        'client_id' => CLIENT_ID,
        'client_secret' => CLIENT_SECRET
    ];

    try {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, LINE_API_URI);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $res = curl_exec($ch);
        curl_close($ch);

        if ($res == false)
            throw new Exception(curl_error($ch), curl_errno($ch));

        $json = json_decode($res);

        $idCard =  $_SESSION['IDCard'];
        $token = $json->access_token;

        // จัดเก็บ Token ของ user

        $conn = new mysqli("localhost", "root", "", "appointment");

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // สร้างคำสั่ง SQL สำหรับ UPDATE
        $sql = "UPDATE `patient` SET token = '$token' WHERE patient_idcard = '$idCard'";

        if ($conn->query($sql) === TRUE) {
            echo '
                    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  	            ';


            echo '
					<script>
				       setTimeout(function() {
				        swal({
				            title: "รับการแจ้งเตือนสำเร็จ",
				            text: "รอคุณหมอแจ้งเตือนได้เลย",
				            type: "success"
				        }, function() {
				            window.location = "http://10.50.19.56/appoint-project/patient/appoint.php";
				        });
				    }, 1000);
				</script>
				';
        } else {
            throw new Exception("Failed to save token: " . $conn->error);
        }
    } catch (Exception $e) {
        var_dump($e);
    }

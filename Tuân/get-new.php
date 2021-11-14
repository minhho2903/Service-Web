<?php require_once('includes/connection.php') ?>
<?php 
    $token = $_POST['nameToken'];
    $checkbox1 = (isset($_POST['get-inf']) == 0) ? 0 : 1;
    $checkbox2 = (isset($_POST['get-new']) == 0) ? 0 : 1;
    //Tránh trường hợp SQL injection
    $token = strip_tags($token);
    $token = addslashes($token);

    $sql_token = "SELECT * FROM token WHERE name = '$token'";
    $query_token = mysqli_query($conn, $sql_token);
    $row_token = mysqli_num_rows($query_token);
    $data_token = mysqli_fetch_array($query_token);

    if ($checkbox1 == 0 || $checkbox2 == 0) {
        echo "<script>alert('Vui lòng tích chọn đã đọc hướng dẫn và xác nhận đã hỏng tài khoản')</script>";
    } elseif ($row_token == 0) {
        echo "<script>alert('Token không hợp lệ')</script>";
    } elseif ($data_token['blocked'] == 1) {
        echo "<script>alert('Token đã bị khóa')</script>";
    } elseif (checkTime($data_token) == 1) {
        echo "<script>alert('Token đã hết hạn, mời bạn mua token khác')</script>";
    } elseif (checkTimeGet($data_token) == 1) {
        echo "<script>alert('Bạn vừa lấy token xong, mời bạn quay lại sau 5 phút')</script>";
    }
    else {
        $idToken = $data_token['id'];
        $service = strtolower($data_token['service']);
        $idService = "id_" . $service;
        $tblAccount = "account_" . $service;

        $sql1 = "SELECT id_token, date_get, $idService
                FROM manage_account
                    INNER JOIN token ON manage_account.id_token = token.id
                    INNER JOIN type_account ON manage_account.id_account = type_account.id 
                WHERE id_token = $idToken
                ORDER BY date_get DESC
                LIMIT 1";
        $query1 = mysqli_query($conn, $sql1);
        $data1 = mysqli_fetch_array($query1);
        $typeAccount = $data_token['type'];
        $sql2 = "SELECT * 
                FROM $tblAccount 
                WHERE used = 0 AND type = '$typeAccount'
                ORDER BY id ASC";
        $query2 = mysqli_query($conn, $sql2);
        $data2 = mysqli_fetch_array($query2);
        if(mysqli_num_rows($query2) == 0) {
            echo "<script>alert('Tạm thời hết tài khoản, mời bạn quay lại sau')</script>"; 
        } else {
            $idAccount = $data2['id'];
            //Lưu id loại account tương ứng vào tbl type_account
            $sql3 = "INSERT INTO type_account($idService)
                    VALUES ($idAccount)";
            mysqli_query($conn, $sql3);

            //Lấy dữ liệu từ bảng type_account mới thêm vào lưu vào id_account để lưu vào bảng manage_account
            $sql4 = "SELECT * 
                        FROM type_account 
                        ORDER BY id DESC
                        LIMIT 1";
            $query4 = mysqli_query($conn, $sql4);
            $data4 = mysqli_fetch_array($query4);
            $idType = $data4['id'];

            //Thêm dữ liệu account vào btl manage_account
            $sql5 = "INSERT INTO manage_account(id_token, id_account, date_get)
                    VALUES ('$idToken', '$idType', now())";
            mysqli_query($conn, $sql5);

            //Update lại phần used của account
            $sql6 = "UPDATE $tblAccount
                    SET used = 1
                    WHERE id = $idAccount";
            mysqli_query($conn, $sql6);

            //Update lại thời gian của get token
            $sql7 = "UPDATE token
                    SET time_update = now()
                    WHERE id = $idToken";
            mysqli_query($conn, $sql7);

            //Show modal
            echo show($data_token, $data2);
        }
    }
?>

<?php 
function checkTime($data) {
    $check = 0;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timeGet = new DateTime($data['time_created']);
    $timeCurr = new DateTime(date('Y-m-d H:i:s'));
    $timeCal = date_diff($timeGet, $timeCurr);
    $expTime = $timeCal->format('%m');
    $timeToken = $data['time'];
    // Kiểm tra thời gian của gói token
    if($timeToken <= $expTime) {
        $check = 1;
    }
    return $check;
}

function checkTimeGet($data) {
    $check = 1;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $timeGet = new DateTime($data['time_update']);
    $timeCurr = new DateTime(date('Y-m-d H:i:s'));
    $timeCal = date_diff($timeGet, $timeCurr);
    $expTime = $timeCal->format('%i');
    $timeToken = 5;
    // Kiểm tra thời gian của token vừa lấy đủ 5p chưa
    if($timeToken <= $expTime) {
        $check = 0;
    }
    return $check;
}

function show($data1, $data2) {
    $typeToken = "";
    if($data1['type'] == "4K") {
        $typeToken = $data1['service'] . " Premium";
    } else {
        $typeToken = $data1['service'];
    }

    $html = '<div class="modaWA js-modaWA open">
                <div class="modaWA-container js-modaWA-container">
                    <div class="modaWA__close js-modaWA-close">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                    <div class="modaWA__hd bold-6">
                        Thông tin tài khoản mới
                    </div>
                    <div class="modaWA__body">
                        <div class="inf-acc">
                            <span class="mail">Gói: </span>
                            <span class="inf-mail italic bold-6">'.$typeToken.' - '.$data1['time'].' Tháng</span>
                        </div>
                        <div class="inf-acc">
                            <span class="mail">Tài khoản: </span>
                            <span class="inf-mail bold-6">'.$data2['mail'].'</span>
                        </div>
                        <div class="inf-acc">
                            <span class="mail">Mật khẩu: </span>
                            <span class="inf-mail bold-6">'.$data2['pass'].'</span>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // Start Modal Bảo hành
                const warAcc = document.querySelector(".js-warranty");
                const modaWA = document.querySelector(".js-modaWA");
                const modaContainerWA = document.querySelector(".js-modaWA-container");
                const modaCloseWA = document.querySelector(".js-modaWA-close");
                
                // Hàm hiển thị Modal Bảo hành (thêm class open vào moda)
                function showForm() {
                    modaWA.classList.add("open")
                }
                
                // Hàm ẩn Modal Bảo hành (gỡ bỏ class open của moda)
                function hideForm() {
                    modaWA.classList.remove("open")
                }
                
                // Nghe hành vi click cùa "Bảo hành"
                warAcc.addEventListener("click", showForm)
                
                
                // Nghe hành vi click vào button close
                modaCloseWA.addEventListener("click", hideForm)
                
                // modaWA.addEventListener("click", hideForm)
                
                modaContainerWA.addEventListener("click", function (event) {
                    event.stopPropagation()
                })
                // End Modal Bảo hành
            </script>';
    return $html;

}
?>
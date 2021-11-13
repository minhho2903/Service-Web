<?php require_once('includes/connection.php') ?>
<?php 
    $token = $_POST['nameToken'];
    $checkbox = (isset($_POST['get-inf']) == 0) ? 0 : 1;
    // $checkBox = $_POST['get-inf'];
    //Tránh trường hợp SQL injection
    $token = strip_tags($token);
    $token = addslashes($token);

    $sql_token = "SELECT * FROM token WHERE name = '$token'";
    $query_token = mysqli_query($conn, $sql_token);
    $row_token = mysqli_num_rows($query_token);
    $data_token = mysqli_fetch_array($query_token);

    if ($checkbox == 0) {
        echo "<script>alert('Vui lòng tích chọn đã đọc hướng dẫn')</script>";
    } elseif ($row_token == 0) {
        echo "<script>alert('Token không hợp lệ')</script>";
    } elseif ($data_token['blocked'] == 1) {
        echo "<script>alert('Token đã bị khóa')</script>";
    } elseif (checkTime($data_token) == 1) {
        echo "<script>alert('Token đã hết hạn, mời bạn mua token khác')</script>";
    } else {
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
        
        //Kiểm tra xem token đã lấy tài khoản chưa
        //Nếu chưa lấy tài khoản nào thì sẽ lấy mới
        if(mysqli_num_rows($query1) == 0) {
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
        } else {
            //Nếu token đã có lấy tài khoản rồi thì hiện lại tài khoản mới nhất đã lấy
            $idAccount = $data1[$idService];

            $sql2 = "SELECT * FROM $tblAccount WHERE id = $idAccount";
            $query2 = mysqli_query($conn, $sql2);
            $data2  = mysqli_fetch_array($query2);

            echo show($data_token, $data2);
        }

    }
?>

<?php 
function checkTime($data) {
    $check = 0;
    $timeGet = new DateTime($data['time_created']);
    $timeCurr = new DateTime(date('Y-m-d H:i:s'));
    $timeCal = date_diff($timeGet, $timeCurr);
    $expTime = $timeCal->format('%m');
    $timeToken = $data['time'];
    // Kiểm tra thời gian của gói token nếu 
    if($timeToken <= $expTime) {
        $check = 1;
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

    $html = '<div class="modaGA js-modaGA open">
                <div class="modaGA-container js-modaGA-container">
                    <div class="modaGA__close js-modaGA-close">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                    <div class="modaGA__hd bold-6">
                        Thông tin tài khoản đăng nhập
                    </div>
                    <div class="modaGA__body">
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
                // Start Modal Nhận tài khoản
                const getAcc = document.querySelector(".js-getacc");
                const modaGA = document.querySelector(".js-modaGA");
                const modaContainerGA = document.querySelector(".js-modaGA-container");
                const modaCloseGA = document.querySelector(".js-modaGA-close");

                // Hàm hiển thị Modal Nhận tài khoản (thêm class open vào moda)
                function showForm() {
                    modaGA.classList.add("open")
                }

                // Hàm ẩn Modal Nhận tài khoản (gỡ bỏ class open của moda)
                function hideForm() {
                    modaGA.classList.remove("open")
                }

                // Nghe hành vi click cùa "Nhận tài khoản"
                if(getAcc) {
                    getAcc.addEventListener("click", showForm);
                }


                // Nghe hành vi click vào button close
                if(modaCloseGA) {
                    modaCloseGA.addEventListener("click", hideForm);
                }

                if(modaGA) {
                    modaGA.addEventListener("click", hideForm);
                }

                if(modaContainerGA) {
                    modaContainerGA.addEventListener("click", function (event) {
                        event.stopPropagation();
                    });
                }
                // End Modal Nhận tài khoản
            </script>
            ';
    return $html;
}

?>

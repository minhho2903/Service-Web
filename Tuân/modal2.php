<?php require_once('includes/connection.php') ?>
<?php 
    $token = $_POST['tokenName'];
    //Tránh trường hợp SQL injection
    $token = strip_tags($token);
    $token = addslashes($token);

    $sql_token = "SELECT * FROM token WHERE name = '$token'";
    $query_token = mysqli_query($conn, $sql_token);
    $row_token = mysqli_num_rows($query_token);
    $data_token = mysqli_fetch_array($query_token);
    if($row_token == 0) {
        echo "<script>alert('Token không hợp lệ')</script>";
    } elseif ($data_token['blocked'] == 1) {
        echo "<script>alert('Token đã bị khóa')</script>";
    } elseif (checkTime($data_token) == 1) {
        echo "<script>alert('Token đã hết hạn, mời bạn mua token khác')</script>";
    } else {
        //Tạo biến để gọi bảng cần get
        $tbAccount = "account_" . strtolower($data_token['service']);
        //Biến để chọn loại HD hay 4K
        $typeAccount = $data_token['type'];
        // Truy vấn id_account từ tb Account
        $sql_account = "SELECT * 
                        FROM $tbAccount 
                        WHERE used = 0 AND type = '$typeAccount'
                        ORDER BY id 
                        ASC";
        $query_account = mysqli_query($conn, $sql_account);
        $num_rows_account = mysqli_num_rows($query_account);
        $data_account = mysqli_fetch_array($query_account);
        if($num_rows_account == 0) {
            echo "<script>alert('Tạm thời hết tài khoản, mời bạn quay lại sau')</script>"; 
        } else {
            $idToken = $data_token['id'];
            $idAccount = $data_account['id'];
            $idTypeAccount = 'id_' . strtolower($data_token['service']);

            //Lưu id loại account tương ứng vào tbl type_account
            $sql1 = "INSERT INTO type_account($idTypeAccount)
                    VALUES ($idAccount)";
            mysqli_query($conn, $sql1);

            //Lấy dữ liệu từ bảng type_account mới thêm vào lưu vào id_account để lưu vào bảng manage_account
            $sql_type = "SELECT * 
                        FROM type_account 
                        ORDER BY id DESC
                        LIMIT 1";
            $query_type = mysqli_query($conn, $sql_type);
            $data_type = mysqli_fetch_array($query_type);
            $idType = $data_type['id'];

            //Thêm dữ liệu account vào btl manage_account
            $sql2 = "INSERT INTO manage_account(id_token, id_account, date_get)
                    VALUES ('$idToken', '$idType', now())";
            mysqli_query($conn, $sql2);

            //Update lại phần used của account
            $sql3 = "UPDATE $tbAccount
                    SET used = 1
                    WHERE id = $idAccount";
            mysqli_query($conn, $sql3);

            //Update lại thời gian của get token
            $sql4 = "UPDATE token
                    SET time_update = now()
                    WHERE id = $idToken";
            mysqli_query($conn, $sql4);

            //Show modal
            echo show($data_token, $data_account);
        }
    }

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

?>

<?php 
function show($data1, $data2) {
    $html = '<div class="modal_get">
                <div class="modal_box">
                    <div class="modal_box-heading">
                        <p>Nhận tài khoản</p>
                        <i onclick="closeGet()" class="modal_close fas fa-times"></i>
                    </div>
                    <div class="modal_box-content">
                        <div class="modal_box-row">
                            <p class="modal_box-des">Token: </p>
                            <p class="modal_box-show">'.$data1['name'].'</p>
                        </div>
                        <div class="modal_box-row">
                            <p class="modal_box-des">Time: </p>
                            <p class="modal_box-show">'.$data1['time'].' Tháng</p>
                        </div>
                        <div class="modal_box-row">
                            <p class="modal_box-des">Mail: </p>
                            <p class="modal_box-show">'.$data2['mail'].'</p>
                        </div>
                        <div class="modal_box-row">
                            <p class="modal_box-des">Pass:</p>
                            <p class="modal_box-show">'.$data2['pass'].'</p>
                        </div>
                        <div class="modal_box-row center">
                            <button class="btn">Bảo hành</button>
                        </div>
                    </div>
                </div>
            </div>';
    return $html;
}
?>
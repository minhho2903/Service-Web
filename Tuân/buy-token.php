<?php include('./includes/role0.php') ?>
<?php require_once('./includes/connection.php') ?>

<?php
//Láy dữ liệu từ người dùng đã chọn
$tokenType = $_POST['type'];
$tokenService = $_POST['service'];
$tokenTime = $_POST['time'];

//Hàm tạo chuỗi ngẫu nhiên
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
function generate_string($input, $strength = 10) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}

$token = generate_string($permitted_chars);

//Kiểm tra giá từng loại dịch vụ
$sql_findPrice = "SELECT * 
                FROM price_service
                WHERE service = '$tokenService' 
                    AND time = $tokenTime 
                    AND type = '$tokenType'";
$query_findPrice = mysqli_query($conn, $sql_findPrice);
$data_findPrice = mysqli_fetch_array($query_findPrice);
$priceToken = $data_findPrice['price'];

//Kiểm tra coin mà user đang có
$idUser = $_SESSION['user_id'];
$sql_user = "SELECT * FROM user WHERE id = $idUser";
$query_user = mysqli_query($conn, $sql_user);
$data_user = mysqli_fetch_array($query_user);
$coinCur = $data_user['coin'];

//Kiểm tra coin hiện tại của user có đủ để mua không
if($coinCur >= $priceToken) {
    $sql = "INSERT INTO token(name, type, service, time, time_created)
            VALUES ('$token', '$tokenType', '$tokenService', '$tokenTime', now())";
    mysqli_query($conn, $sql);


    //Show token vừa mua
    $sql_show = "SELECT * FROM token ORDER BY id DESC LIMIT 1";
    $query = mysqli_query($conn, $sql_show);
    $data = mysqli_fetch_array($query);

    //Lưu thông tin vào bảng manage_user
    $idToken = $data['id'];
    $sql_acc = "INSERT INTO manage_user (id_user, id_token) 
                VALUES($idUser, $idToken)";
    mysqli_query($conn, $sql_acc);

    //Cập nhật tiền của user sau khi trừ đi
    $coinNew = $coinCur - $priceToken;
    $sql_discoin = "UPDATE user
                    SET coin = $coinNew
                    WHERE id = $idUser";
    mysqli_query($conn, $sql_discoin);
    echo '<input type="text" class="token-output bold-6" name="nametoken" value="' . $data['name'] .'">';
} else {
    echo "<script>alert('Số coin hiện có không đủ để mua gói dịch vụ này')</script>";
}
?>
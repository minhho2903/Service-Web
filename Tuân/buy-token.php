<?php include('./includes/role0.php') ?>
<?php require_once('./includes/connection.php') ?>

<?php
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

//Giá từng loại
$priceToken = 0;
//Netflix
if($tokenService == 'Netflix' && $tokenType == 'HD' && $tokenTime == 1) {$priceToken = 35;}
if($tokenService == 'Netflix' && $tokenType == 'HD' && $tokenTime == 3) {$priceToken = 75;}
if($tokenService == 'Netflix' && $tokenType == 'HD' && $tokenTime == 6) {$priceToken = 140;}
if($tokenService == 'Netflix' && $tokenType == 'HD' && $tokenTime == 12) {$priceToken = 260;}
if($tokenService == 'Netflix' && $tokenType == '4K' && $tokenTime == 1) {$priceToken = 45;}
if($tokenService == 'Netflix' && $tokenType == '4K' && $tokenTime == 3) {$priceToken = 120;}
if($tokenService == 'Netflix' && $tokenType == '4K' && $tokenTime == 6) {$priceToken = 220;}
if($tokenService == 'Netflix' && $tokenType == '4K' && $tokenTime == 12) {$priceToken = 400;}
//Disney
if($tokenService == 'Disney' && $tokenType == 'HD' && $tokenTime == 1) {$priceToken = 30;}
if($tokenService == 'Disney' && $tokenType == 'HD' && $tokenTime == 3) {$priceToken = 70;}
if($tokenService == 'Disney' && $tokenType == 'HD' && $tokenTime == 6) {$priceToken = 130;}
if($tokenService == 'Disney' && $tokenType == 'HD' && $tokenTime == 12) {$priceToken = 220;}
if($tokenService == 'Disney' && $tokenType == '4K' && $tokenTime == 1) {$priceToken = 35;}
if($tokenService == 'Disney' && $tokenType == '4K' && $tokenTime == 3) {$priceToken = 95;}
if($tokenService == 'Disney' && $tokenType == '4K' && $tokenTime == 6) {$priceToken = 170;}
if($tokenService == 'Disney' && $tokenType == '4K' && $tokenTime == 12) {$priceToken = 300;}

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
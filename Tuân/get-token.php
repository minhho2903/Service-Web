<?php include('includes/role0.php') ?>
<?php include('includes/head2.php') ?>
<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 
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

// if (isset($_POST['btn_get'])) {
//     $token = generate_string($permitted_chars);
//     $token_type = $_POST['type'];
//     $token_service = $_POST['service'];
//     $token_time = $_POST['time'];

//     $sql = "INSERT INTO token(name, type, service, time, time_created)
//                     VALUES ('$token', '$token_type', '$token_service', '$token_time', now())";
//     mysqli_query($conn, $sql);


// }
?>

        <!-- Content -->
        <div id="content">
            <div class="flex-center">
                <div class="get-token-container">
                    <div class="get-token-hd bold-7">
                        MUA TOKEN
                    </div>
                    <div class="get-token-body">
                        <form action="get-token.php" method="POST">

                            <select name="time" id="" class="get-token-mon">
                                <option value="1">1 Tháng</option>
                                <option value="3">3 Tháng</option>
                                <option value="6">6 Tháng</option>
                                <option value="12">12 Tháng</option>
                            </select>
                            <div class="get-token-sv">
                                <div class="get-token-left">
                                    Service:
                                </div>
                                <div class="get-token-mid">
                                    <input type="radio" class="service" name="service" required id="Netflix" value="Netflix" checked>
                                    <label class="input-opt-label bold-5 mr-10" for="Netflix">Netflix</label>
                                </div>
                                <div class="get-token-right">
                                    <input type="radio" class="service" name="service" required id="Disney" value="Disney">
                                    <label class="input-opt-label bold-5" for="Disney">Disney</label>
                                </div>
                            </div>
                            <div class="get-token-type">
                                <div class="get-token-left">
                                    Type:
                                </div>
                                <div class="get-token-mid">
                                    <input type="radio" name="type" required id="HD" value="HD" checked>
                                    <label class="input-opt-label bold-5" for="HD">HD</label>
                                </div>
                                <div class="get-token-right">
                                    <input type="radio" name="type" required id="4K" value="4K">
                                    <label class="input-opt-label bold-5" for="4K">4K</label>
                                </div>
                            </div>
                            <div class="get-token-type">
                                <div class="get-token-left">
                                    Giá:
                                </div>
                                <div class="get-token-right2">
                                    <p class="get-token-price">35</p>
                                    <i class="money-icon fa fa-coins money-bg" style="color:#f7da40;"></i>
                                </div>
                            </div>
                            <div class="btn-get-token">
                                <button name="btn_get" class="btn-get bold-6">GET</button>
                            </div>
                            <?php 
                            //Kiểm tra đã bấm nút get chưa, nếu chưa thì không hiện dữ liệu
                            if(isset($_POST['btn_get'])) {
                                $token = generate_string($permitted_chars);
                                $tokenType = $_POST['type'];
                                $tokeService = $_POST['service'];
                                $tokeTime = $_POST['time'];

                                //Giá từng loại
                                $priceToken = 0;
                                //Netflix
                                if($tokeService == 'Netflix' && $tokenType == 'HD' && $tokeTime == 1) {$priceToken = 35;}
                                if($tokeService == 'Netflix' && $tokenType == 'HD' && $tokeTime == 3) {$priceToken = 75;}
                                if($tokeService == 'Netflix' && $tokenType == 'HD' && $tokeTime == 6) {$priceToken = 140;}
                                if($tokeService == 'Netflix' && $tokenType == 'HD' && $tokeTime == 12) {$priceToken = 260;}
                                if($tokeService == 'Netflix' && $tokenType == '4K' && $tokeTime == 1) {$priceToken = 45;}
                                if($tokeService == 'Netflix' && $tokenType == '4K' && $tokeTime == 3) {$priceToken = 120;}
                                if($tokeService == 'Netflix' && $tokenType == '4K' && $tokeTime == 6) {$priceToken = 220;}
                                if($tokeService == 'Netflix' && $tokenType == '4K' && $tokeTime == 12) {$priceToken = 400;}
                                //Disney
                                if($tokeService == 'Disney' && $tokenType == 'HD' && $tokeTime == 1) {$priceToken = 30;}
                                if($tokeService == 'Disney' && $tokenType == 'HD' && $tokeTime == 3) {$priceToken = 70;}
                                if($tokeService == 'Disney' && $tokenType == 'HD' && $tokeTime == 6) {$priceToken = 130;}
                                if($tokeService == 'Disney' && $tokenType == 'HD' && $tokeTime == 12) {$priceToken = 220;}
                                if($tokeService == 'Disney' && $tokenType == '4K' && $tokeTime == 1) {$priceToken = 35;}
                                if($tokeService == 'Disney' && $tokenType == '4K' && $tokeTime == 3) {$priceToken = 95;}
                                if($tokeService == 'Disney' && $tokenType == '4K' && $tokeTime == 6) {$priceToken = 170;}
                                if($tokeService == 'Disney' && $tokenType == '4K' && $tokeTime == 12) {$priceToken = 300;}
                                //Kiểm tra coin mà user đang có
                                $idUser = $_SESSION['user_id'];
                                $sql_user = "SELECT * FROM user WHERE id = $idUser";
                                $query_user = mysqli_query($conn, $sql_user);
                                $data_user = mysqli_fetch_array($query_user);
                                $coinCur = $data_user['coin'];
                                
                                if($coinCur >= $priceToken) {
                                    $sql = "INSERT INTO token(name, type, service, time, time_created)
                                                    VALUES ('$token', '$tokenType', '$tokeService', '$tokeTime', now())";
                                    mysqli_query($conn, $sql);
    
    
                                    //Show token vừa mua
                                    $sql_show = "SELECT * FROM token ORDER BY id DESC LIMIT 1";
                                    $query = mysqli_query($conn, $sql_show);
                                    $data = mysqli_fetch_array($query);
                                    $input_get = '<input type="text" class="token-output bold-6" name="nametoken" value="' . $data['name'] . '">';
                                    echo $input_get;
    
                                    //Lưu thông tin vào bảng manage_user
                                    $idToken = $data['id'];
                                    $sql_acc = "INSERT INTO manage_user (id_user, id_token) 
                                                VALUES($idUser, $idToken)";
                                    mysqli_query($conn, $sql_acc);
                                    $coinNew = $coinCur - $priceToken;
                                    $sql_discoin = "UPDATE user
                                                    SET coin = $coinNew
                                                    WHERE id = $idUser";
                                    mysqli_query($conn, $sql_discoin);
                                } else {
                                    echo '<input type="text" name="" id="" placehoder="Kết quả" class="token-output bold-6">';
                                    echo "<script>alert('Số coin hiện có không đủ để mua gói dịch vụ này')</script>";
                                }
                            } else {
                                echo '<input type="text" name="" id="" placehoder="Kết quả" class="token-output bold-6">';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
<?php include('includes/footer.php') ?>
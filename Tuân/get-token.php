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

if (isset($_POST['btn_get'])) {
    $token = generate_string($permitted_chars);
    $token_type = $_POST['type'];
    $token_service = $_POST['service'];
    $token_time = $_POST['time'];

    $sql = "INSERT INTO token(name, type, service, time, time_created)
                    VALUES ('$token', '$token_type', '$token_service', '$token_time', now())";
    mysqli_query($conn, $sql);

    // $sql1 = "SELECT * FROM token WHERE name = '$token'";
    // $query = mysqli_query($conn, $sql1);
    // $num_rows = mysqli_num_rows($query);
    
    // //Kiểm tra đã có token này chưa, nếu có rồi thì tạo token 
    // //và kiểm tra lại đã có token chưa, nếu chưa thì lưu vào DB 
    // while ($num_rows == 1) {
    //     $sql1 = "SELECT * FROM token WHERE name = '$token'";
    //     $query = mysqli_query($conn, $sql1);
    //     $num_rows = mysqli_num_rows($query);
    //     if($num_rows == 0) {
    //         $sql = "INSERT INTO token(name, type, service, time, time_created)
    //                 VALUES ('$token', '$token_type', '$token_service', '$token_time', now())";
    //         mysqli_query($conn, $sql);
    //         break;
    //     }
    // }
    
    // if ($num_rows == 0) {
    // }
}
?>

        <!-- Content -->
        <div id="content">
            <div class="flex-center">
                <div class="get-token-container">
                    <div class="get-token-hd bold-7">
                        GET TOKEN
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
                                    <input type="radio" name="service" required id="Netflix" value="Netflix" checked>
                                    <label class="input-opt-label bold-5 mr-10" for="Netflix">Netflix</label>
                                </div>
                                <div class="get-token-right">
                                    <input type="radio" name="service" required id="Disney+" value="Disney">
                                    <label class="input-opt-label bold-5" for="Disney+">Disney+</label>
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
                            <div class="btn-get-token">
                                <button name="btn_get" class="btn-get bold-6">GET</button>
                            </div>
                            <?php 
                            //Kiểm tra đã bấm nút get chưa, nếu chưa thì không hiện dữ liệu
                            if(isset($_POST['btn_get'])) {
                                $sql_show = "SELECT * FROM token ORDER BY id DESC LIMIT 1";
                                $query = mysqli_query($conn, $sql_show);
                                $data = mysqli_fetch_array($query);
                                $input_get = '<input type="text" class="token-output bold-6" name="nametoken" value="' . $data['name'] . '">';
                                echo $input_get;
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
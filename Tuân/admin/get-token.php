<?php #include('includes/role1.php') ?>
<?php include('includes/header-admin.php') ?>
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
}
?>

    <div class="box">
        <div class="box_get">
            <div class="box_get-heading">
                <p>Get Token</p>
            </div>
            <div class="box_get-body">
                <form action="get-token.php" method="POST">
                    <div class="get-body_input">
                        <select name="time">
                            <option value="1">1 Tháng</option>
                            <option value="3">3 Tháng</option>
                            <option value="6">6 Tháng</option>
                            <option value="12">12 Tháng</option>
                        </select>
                    </div>
                    <div class="get-body_input">
                        <p class="get-body_input-title">Service</p>
                        <div class="get-body_input-radio">
                            <input type="radio" name="service" id="netflix" value="Netflix" checked>
                            <label for="netflix">Netflix</label>
                        </div>
                        <div class="get-body_input-radio">
                            <input type="radio" name="service" id="disney" value="Disney">
                            <label for="disney">Disney</label>
                        </div>
                    </div>
                    <div class="get-body_input">
                        <p class="get-body_input-title">Type</p>
                        <div class="get-body_input-radio">
                            <input type="radio" name="type" id="hd" value="HD" checked>
                            <label class="pdr-45" for="hd">HD</label>
                        </div>
                        <div class="get-body_input-radio">
                            <input type="radio" name="type" id="4k" value="4K">
                            <label class="pdr-45" for="4k">4K</label>
                        </div>
                    </div>
                    <div class="get-body_input center">
                        <button type="submit" class="btn" name="btn_get">GET</button>
                    </div>
                    <div class="get-body_input">
                        <?php 
                        // $input_get = '<input type="text" name="nametoken" placeholder="Kết quả">';
                        if(isset($_POST['btn_get'])) {
                            $sql_show = "SELECT * FROM token ORDER BY id DESC LIMIT 1";
                            $query = mysqli_query($conn, $sql_show);
                            $data = mysqli_fetch_array($query);
                            $input_get = '<input type="text" name="nametoken" value="' . $data['name'] . '">';
                            echo $input_get;
                            // echo $input_get;
                        } else {
                            echo '<input type="text" name="nametoken" placeholder="Kết quả">';
                        }
                        ?>
                        <!-- <input type="text" name="nametoken" placeholder="Kết quả"> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>

<?php include('includes/head2.php') ?>
<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>
<?php

function checkLogin($conn) {
    if (isset($_POST['btn_login'])) {
        //Lấy thông tin đăng nhập từ người dùng
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // /làm sạch thông tin, xóa bỏ cá tag html, ký tự đặc biệt
        //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
        $username = strip_tags($username); //strip_tags làm sạch các tag html 
        $username = addslashes($username); //addslashes thêm ký tự /
        $password = strip_tags($password);
        $password = addslashes($password);

        //Thực hiện truy vấn DB
        $sql = "SELECT * 
                FROM user 
                WHERE username = '$username' AND password = '$password'";
        $query = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($query);
        
        //Kiểm tra giá trị nhập vào có table user không
        if ($num_rows == 0) {
            echo "Tên đăng nhập hoặc mật khẩu không đúng";
        } else {
                //Lấy thông tin người dùng lưu vào session
                while ($data = mysqli_fetch_array($query)) {
                    $_SESSION["user_id"] = $data["id"];
                    $_SESSION["username"] = $data["username"];
                    $_SESSION["fullname"] = $data["fullname"];
                    $_SESSION["email"] = $data["email"];
                    $_SESSION["coin"] = $data["coin"];
                    $_SESSION["role"] = $data["role"];
                }
    
            //thực thi hành động sau khi lưu thông tin vào sesstion
            //ở dây mình chuyển hướng trang web tới một trang gọi là index.php
            echo "<script>alert('Chào mừng bạn quay lại')</script>";
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
            // header("Location: index.php");
        }
    }
}
?>

        <div id="content">
            <div class="flex-center pb-65 js-modaSI">
                <div class="moda-container mt-75 js-modaSI-container">
                    <div class="moda__close none js-modaSI-close">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                    <div class="moda__hd bold-6">
                        <i class="moda__hd-icon ti-user"></i>
                        Thông tin đăng nhập
                    </div>
                    <div class="moda__body">
                        <form action="SignIn.php" method="POST">
                            <div class="moda-input-field">
                                <p class="modal-alert"><?php checkLogin($conn) ?></p>
                            </div>
                            <div class="moda-input-field">
                                <input type="text" name="username" required class="moda-input" id="username" placeholder=" ">
                                <label for="username" class="input-effect">Username</label>
                            </div>
                            <div class="moda-input-field">
                                <input type="password" name="password" required class="moda-input" id="password" placeholder=" ">
                                <label for="password" class="input-effect">Password</label>
                            </div>
                            <button class="moda-sign" name="btn_login">
                                Đăng nhập
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php include('includes/footer.php') ?>
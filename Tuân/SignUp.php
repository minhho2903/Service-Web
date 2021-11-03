<?php include('includes/head2.php') ?>
<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>
<?php

function checkRegister($conn) {
    if (isset($_POST['btn_register'])) {
        //lấy thông tin đăng ký từ người dùng
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['re-password'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];

        //Kiểm tra user và email trong tb user
        $sql1 = "SELECT username
                FROM user 
                WHERE username = '$username'";
        $query1 = mysqli_query($conn, $sql1);
        $num_rows1 = mysqli_num_rows($query1);

        $sql2 = "SELECT email
                FROM user 
                WHERE email = '$email'";
        $query2 = mysqli_query($conn, $sql2);
        $num_rows2 = mysqli_num_rows($query2);

        //Kiểm tra mật khẩu nhập
        if ($password != $repassword) {
            echo "Mật khẩu nhập lại không đúng";
        } else {
            if ($num_rows1 == 1) {
                echo "Tài khoản đã tồn tại, mời bạn đổi tên khác";
            } else {
                if ($num_rows2 == 1) {
                    echo "Mail đã tồn tại, mời bạn đổi mail khác";
                } else {
                    //truy vấn dữ liệu
                    $sql = "INSERT INTO user(username, password, fullname, email)
                        VALUES ('$username', '$password', '$fullname', '$email')";
                    //thực thi câu lệnh SQL với biến conn lấy từ file connection.php
                    mysqli_query($conn, $sql);
                    echo "<script>alert('Chúc mừng bạn đã đăng ký thành công tài khoản')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
                }
            }
        }
    }
}

?>

        <!-- Form đắng ký -->
        <div id="content">
            <div class="flex-center js-modaSU">
                <div class="moda-container js-modaSU-container">
                    <div class="moda__close none js-modaSU-close">
                        <ion-icon name="close-outline"></ion-icon>
                    </div>
                    <div class="moda__hd bold-6">
                        <i class="moda__hd-icon ti-user"></i>
                        Thông tin đăng ký
                    </div>
                    <div class="moda__body">
                        <form action="SignUp.php" method="POST">
                            <div class="moda-input-field">
                                <p class="modal-alert"><?php checkRegister($conn) ?></p>
                            </div>
                            <div class="moda-input-field">
                                <input type="text" name="username" required class="moda-input" id="usernameSU" placeholder=" ">
                                <label for="usernameSU" class="input-effect">Username</label>
                            </div>
                            <div class="moda-input-field">
                                <input type="password" name="password" required class="moda-input" id="passwordSU" placeholder=" ">
                                <label for="passwordSU" class="input-effect">Password</label>
                            </div>
                            <div class="moda-input-field">
                                <input type="password" name="re-password" required class="moda-input" id="re-passwordSU" placeholder=" ">
                                <label for="re-passwordSU" class="input-effect">Re-password</label>
                            </div>
                            <div class="moda-input-field">
                                <input type="text" name="fullname" required class="moda-input" id="fullnameSU" placeholder=" ">
                                <label for="fullnameSU" class="input-effect">Fullname</label>
                            </div>
                            <div class="moda-input-field">
                                <input type="email" name="email" required class="moda-input" id="emailSU" placeholder=" ">
                                <label for="emailSU" class="input-effect">Email</label>
                            </div>
                            <button class="moda-sign" name="btn_register">
                                Đăng ký
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<?php include('includes/footer.php') ?>
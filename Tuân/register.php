<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>

        <div class="box">
            <div class="form">
                <form action="register.php" method="POST">
                    <table>
                        <tr>
                            <td colspan="2">
                                <p class="form-heading">Form Đăng ký</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Username: </td>
                            <td>
                                <input class="form-input" type="text" name="username"placeholder="conchimon123" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td>
                                <input class="form-input" type="password" name="password"placeholder="******" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Retry Password: </td>
                            <td>
                                <input class="form-input" type="password" name="repassword"placeholder="******" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Fullname: </td>
                            <td>
                                <input class="form-input" type="text" name="fullname"placeholder="Vu Dinh Tuan" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Username: </td>
                            <td>
                                <input class="form-input" type="email" name="email"placeholder="abc@gmail.com" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" name="btn_register" class="btn">Đăng ký</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php checkBtnRegister($conn) ?>
            </div>
        </div>

<?php 
function checkBtnRegister($conn) {
    //kiem tra co ton tai buttin register khong ?
    if (isset($_POST['btn_register'])) {
        //Lấy thông tin đăng nhập
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        
        //Kiểm tra mật khẩu nhập
        if ($password != $repassword) {
            echo "<div class='alert'>Mật khẩu nhập lại không đúng</div>";
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
?>
<?php include('includes/footer.php') ?>
<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>

        <div class="box">
            <div class="form">
                <form action="login.php" method="POST">
                    <table>
                        <tr>
                            <td colspan="2">
                                <p class="form-heading">Form Đăng nhập</p>
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
                            <td colspan="2">
                                <button type="submit" name="btn_login" class="btn">Đăng nhập</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php checkBtnLogin($conn) ?>
            </div>
        </div>

<?php 

    function checkBtnLogin($conn) {
        if(isset($_POST['btn_login'])) {
            //lấy thông tin đăng nhập
            $username = $_POST['username'];
            $password = $_POST['password'];

            // /làm sạch thông tin, xóa bỏ cá tag html, ký tự đặc biệt
            //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
            $username = strip_tags($username); //strip_tags làm sạch các tag html 
            $username = addslashes($username); //addslashes thêm ký tự /
            $password = strip_tags($password);
            $password = addslashes($password);

            //kiểm tra xem đã nhập đủ thông tin hay chưa, nếu chưa thì nhập lại
            if ($username == "" || $password == "") {
                echo "<div class='alert'>Username hoặc Password bạn không được để trống</div>";
            } else {
                $sql = "SELECT * 
                        FROM user 
                        WHERE username = '$username' AND password = '$password'";
                $query = mysqli_query($conn, $sql);
                $num_rows = mysqli_num_rows($query);

                if ($num_rows == 0) {
                    echo "<div class='alert'>Tên đăng nhập hoặc mật khẩu không đúng</div>";
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
                    echo "<script>alert('Đăng nhập thành công')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
                    // header("Location: index.php");
                }
            }
        }
    }

?>
<?php include('includes/footer.php') ?>
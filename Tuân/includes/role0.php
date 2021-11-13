<?php require_once('connection.php') ?>
<?php 

    if (isset($_SESSION['user_id']) == false) {
        //Nếu người dùng chưa đăng nhập thì chuyển hướng sang trang đăng nhập
        header('Location: ./SignIn.php');
    } else {
        if (isset($_SESSION["role"])) {
            //Ngược lại nếu đã đăn nhập
            $role = $_SESSION["role"];
            //Kiểm tra quyền hạn của user
            if ($role < 0) {
                echo "Bạn không có quyền truy cập vào trang này" . "</br>";
                echo "<a href='../index.php'> Quay lại trang chủ </a>";
                exit();
            }
        }
    }

?>
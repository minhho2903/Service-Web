<?php include('./includes/role1.php') ?>
<?php require_once('./includes/connection.php') ?>
<?php 
    $idUser = $_SESSION['user_id'];
    $username = $_POST['username'];
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) == 1) {
        $data = mysqli_fetch_array($query);
        $coin = $data['coin'];

        $sql1 = "SELECT * FROM user WHERE id = $idUser";
        $query1 = mysqli_query($conn, $sql1);
        $data1 = mysqli_fetch_array($query1);
        //Kiểm tra coin nhân viên hiện có có đủ để nạp không
        if ($data1['coin'] >= $_POST['recharge']) {
            //Cập nhật lại số coin của nhân viên
            $coinDecrease = $data1['coin'] - $_POST['recharge'];
            $sql_up = "UPDATE user SET coin = $coinDecrease WHERE id = $idUser";
            mysqli_query($conn, $sql_up);

            //Cập nhật lại số coin của khách
            $add_coin = $_POST['recharge'] + $coin;
            $sql_up = "UPDATE user SET coin = $add_coin WHERE username = '$username'";
            mysqli_query($conn, $sql_up);
            
            echo "Nạp thành công " . $_POST['recharge'] . " XU cho tài khoản " . $username;
        } else {
            echo "Không đủ coin để nạp vui lòng liên hệ Admin";
        }
    } else {
        echo "Username không tồn tại";
    }
?>
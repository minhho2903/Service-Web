<?php include('./includes/role1.php') ?>
<?php require_once('./includes/connection.php') ?>
<?php 
    $username = $_POST['username'];
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) == 1) {
        $data = mysqli_fetch_array($query);
        $coin = $data['coin'];
        $add_coin = $_POST['recharge'] + $coin;

        $sql_up = "UPDATE user SET coin = $add_coin WHERE username = '$username'";
        mysqli_query($conn, $sql_up);
        // echo "<script>alert('nạp tiền thành công " . $_POST['recharge'] . " XU cho tài khoản " . $username . " ')</script>";
        echo "Nạp thành công " . $_POST['recharge'] . " XU cho tài khoản " . $username;
    } else {
        echo "Username không tồn tại";
    }
?>
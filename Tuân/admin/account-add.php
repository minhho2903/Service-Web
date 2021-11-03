<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php

if (isset($_POST['btn_add-net'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $type = $_POST['type'];

    $sql = "SELECT mail FROM account_netflix WHERE mail = '$mail'";
    $query = mysqli_query($conn, $sql);
    $num_row = mysqli_num_rows($query);

    if ($mail == "" || $pass == "") {
        echo "Vui lòng nhập đủ thông tin";
    } else {
        if ($num_row == 1) {
            echo "Tài khoản đã tồn tại";
        } else {
            $sql = "INSERT INTO account_netflix(mail, pass, type) 
                    VALUES('$mail', '$pass', '$type')";
            mysqli_query($conn, $sql);
        
            header("Location: manage-account-net.php");
        }
    }
}

if (isset($_POST['btn_add-dn'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $type = $_POST['type'];

    $sql = "SELECT mail FROM account_disney WHERE mail = '$mail'";
    $query = mysqli_query($conn, $sql);
    $num_row = mysqli_num_rows($query);

    if ($mail == "" || $pass == "") {
        echo "Vui lòng nhập đủ thông tin";
    } else {
        if ($num_row == 1) {
            echo "Tài khoản đã tồn tại";
        } else {
            $sql = "INSERT INTO account_disney(mail, pass, type) 
                    VALUES('$mail', '$pass', '$type')";
            mysqli_query($conn, $sql);
        
            header("Location: manage-account-dn.php");
        }
    }
}

?>
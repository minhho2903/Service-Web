<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php

if (isset($_POST['btn_add-net'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $type = $_POST['type'];

    if ($mail == "" || $pass == "") {
        echo "Vui lòng nhập đủ thông tin";
    } else {
        $sql = "INSERT INTO account_netflix(mail, pass, type) 
                VALUES('$mail', '$pass', '$type')";
        mysqli_query($conn, $sql);
    
        header("Location: manage-acc-net.php");
    }
}

if (isset($_POST['btn_add-dn'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $type = $_POST['type'];

    if ($mail == "" || $pass == "") {
        echo "Vui lòng nhập đủ thông tin";
    } else {
        $sql = "INSERT INTO account_disney(mail, pass, type) 
                VALUES('$mail', '$pass', '$type')";
        mysqli_query($conn, $sql);

        header("Location: manage-acc-dn.php");
    }
}

?>
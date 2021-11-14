<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 
//Kiểm tra có ấn nút DELETE của bảng NETFLIX không
//Nếu có thì thực thi lệnh
if(isset($_GET['id_net'])) {
    $id = $_GET['id_net'];
    $sql = "DELETE FROM account_netflix WHERE id = $id";
    mysqli_query($conn, $sql);
    header('Location: manage-account-net.php');
}

//Kiểm tra có ấn nút DELETE của bảng DISNEY không
//Nếu có thì thực thi lệnh
if(isset($_GET['id_dn'])) {
    $id = $_GET['id_dn'];
    $sql = "DELETE FROM account_disney WHERE id = $id";
    mysqli_query($conn, $sql);
    header('Location: manage-account-dn.php');
}

?>
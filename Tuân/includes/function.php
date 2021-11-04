<?php require_once('includes/connection.php') ?>
<?php 
//Hàm kiểm tra role của user đăng nhập tương ứng
function checkRole() {
    return ($_SESSION['role'] == 2) ? 
    "Admin" : (($_SESSION['role'] == 1) ? 
    "Nhân viên" : "Khách");
}

?>
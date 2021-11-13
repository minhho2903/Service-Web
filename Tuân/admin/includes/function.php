<?php require_once('includes/connection.php') ?>
<?php 

function checkRole($conn, $role_required = 0, $pageIndex, $pageName) {
    $role = $_SESSION['role'];
    if ($role < $role_required) {
        echo "Bạn không có quyền truy cập vào trang này" . "</br>";
        echo "<a href='../index.php'> Quay lại trang chủ </a>";
        exit();
    } else {
        echo  "<a class='item_nav-link' href=admin/" . $pageIndex . ".php>" . $pageName . "</a>" . "</br>";
    }
}

// function rolePage

?>

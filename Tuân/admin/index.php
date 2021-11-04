<?php include('includes/role1.php') ?>

<?php include('includes/header-admin.php') ?>

<?php require_once('includes/connection.php') ?>

        <!-- Để dây test thôi nha cần thêm dữ liệu đổ vào -->
        <div style="background-image: linear-gradient(45deg, #FFE459, #F43B86, #3D087B, #11052C)"">
                <div style="height: 70px"></div>
                <h1>Chào mừng <?php echo $_SESSION['fullname'] ?>, quay lại trang quản lý</h1>
                <div style="height: 72vh"></div>
        </div>

<?php include('includes/footer.php') ?>
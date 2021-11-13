<?php require_once('includes/connection.php') ?>
<!-- <?php include('includes/function.php') ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
</head>
<body>
    <header>
        <div class="header">
            <div class="header-left">
                <ul class="list">
                    <li class="item">
                        <i>Logo</i>
                    </li>
                    <li class="item">
                        <a href="index.php" class="item-link">Trang chủ</a>
                    </li>
                    <li class="item">
                        <a href="get-account.php" class="item-link">Nhận tài khoản</a>
                    </li>
                    <li class="item">
                        <a href="#!" class="item-link">Gói dịch vụ</a>
                    </li>
                    <li class="item">
                        <a href="#!" class="item-link">Hỗ trợ</a>
                    </li>
                </ul>
            </div>

<?php if(isset($_SESSION['user_id'])) { ?>
            <div class="header-right active">
                <ul class="list">
                    <li class="item">
                        <p class="item-name"><?php echo $_SESSION['fullname'] ?></p>
                    </li>
                    <li class="item">
                        <i class="item-icon fas fa-bars"></i>
                        <div class=item_nav>
                            <a href="info-login.php" class="item_nav-link">Thông tin chi tiết</a>
                            <?php
                            if ($_SESSION['role'] > 1) {
                                echo checkRole($conn, 2, "index", "Trang quản lý");
                            }
                            ?>
                            <a href="#" class="item_nav-link">Token đã mua</a>
                            <a href="#" class="item_nav-link">Nạp tiền</a>
                            <a href="logout.php" class="item_nav-link">Đăng xuất</a>
                        </div>
                    </li>
                </ul>
            </div>
<?php } else { ?>
            <div class="header-right active">
                <ul class="list">
                    <li class="item">
                        <a href="register.php" class="item-link">Đăng ký</a>
                    </li>
                    <li class="item">
                        <a href="login.php" class="item-link">Đăng nhập</a>
                    </li>
                </ul>
            </div>
            <?php }?>
        </div>
    </header>

    <div class="main">
        
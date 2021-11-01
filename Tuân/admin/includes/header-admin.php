<?php require_once('includes/connection.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="./style/css/grid.css">
    <link rel="stylesheet" href="./style/css/main.css">
    <link rel="stylesheet" href="./style/css/modaSP_GA-fixed.css">
    <link rel="stylesheet" href="./style/fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Service Web</title>
</head>
<body>
    <div class="main">
        <!-- Header -->
        <div id="header">
            <div class="grid">
                <div class="hd__nav">
                    <div class="header-guest">
                    <ul class="hd__nav-list">
                            <li class="hd__nav-item">
                                <a href="#" class="hd__nav-item-link">
                                    <ion-icon name="diamond-sharp"></ion-icon>
                                </a>
                            </li>
                            <li class="hd__nav-item"><a href="../index.php">Trang chủ</a></li>
                            <li class="hd__nav-item"><a href="#">Lấy Token</a></li>
                            <li class="hd__nav-item account">
                                <a href="#">
                                    Quản lý
                                </a>
                                <ul class="subnav-admin">
                                    <li><a href="#">Người dùng</a></li>
                                    <li><a href="#">Token</a></li>
                                    <li><a href="#">Tài khoản</a></li>
                                    <li><a href="#">Danh sách</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="hd__nav-list">
                            <li class="hd__nav-item none">
                                <a href="#" class="hd__nav-item-link">
                                    <ion-icon name="diamond-sharp"></ion-icon>
                                </a>
                            </li>
                            <li class="account">
                                <a class="flex-center" href="#">
                                    <?php echo $_SESSION["fullname"] ?>
                                    <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                                </a>
                                <ul class="subnav">
                                    <li class="js-details"><a href="#">Thông tin chi tiết</a></li>
                                    <li><a href="../logout.php">Đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
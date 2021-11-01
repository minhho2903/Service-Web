<?php require_once('includes/connection.php') ?>

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
                            <li class="hd__nav-item"><a href="#">Trang chủ</a></li>
                            <li class="hd__nav-item"><a href="./Minh/get-account.html" target="_blank">Nhận tài khoản</a></li>
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
                                    <li><a href="#">Thông tin chi tiết</a></li>
                                    <li><a href="#">Trang quản lý</a></li>
                                    <li><a href="#">Nạp tiền</a></li>
                                    <li><a href="logout.php">Đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
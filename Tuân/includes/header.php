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
                            <li class="hd__nav-item"><a href="index.php">Trang chủ</a></li>
                            <li class="hd__nav-item"><a href="get-account.php">Nhận tài khoản</a></li>
                            <li class="hd__nav-item"><a href="price-service.php">Gói dịch vụ</a></li>
                            <li class="hd__nav-item js-support"><a href="#">Hỗ trợ</a></li>
                        </ul>
                        <ul class="hd__nav-list">
                            <li class="hd__nav-item none">
                                <a href="#" class="hd__nav-item-link">
                                    <ion-icon name="diamond-sharp"></ion-icon>
                                </a>
                            </li>
                            <?php if(isset($_SESSION["user_id"]) == true ) { ?>
                                <li class="account coin-hd">
                                    <a class="flex-center money js-recharge" href="#">
                                        <?php 
                                        if($_SESSION["coin"] > 9999) {
                                            echo '9999+';
                                        } else {
                                            echo $_SESSION["coin"];
                                        }
                                        ?>
                                        <i class="money-icon fa fa-coins" style="color:#f7da40;"></i>
                                    </a>
                                </li>
                                <li class="account">
                                    <a class="flex-center" href="#">
                                        <?php echo $_SESSION["fullname"] ?>
                                        <ion-icon class="profile-icon" name="person-circle-outline"></ion-icon>
                                    </a>
                                    <ul class="subnav">
                                        <li class="js-details"><a href="#">Thông tin chi tiết</a></li>
                                        <?php if ($_SESSION['role'] >= 1) { ?>
                                        <li><a href="./admin/index.php">Trang quản lý</a></li>
                                        <?php } else {?>
                                        <li class="js-recharge"><a href="#">Nạp tiền</a></li>
                                        <li class="js-recharge"><a href="token-guest.php">Token đã mua</a></li>
                                        <?php }?>
                                        <li><a href="logout.php">Đăng xuất</a></li>
                                    </ul>
                                </li>
                            <?php } else {?>
                            <li class="hd__nav-item bold-6 js-signup "><a href="./SignUp.php">Đăng ký</a></li>
                            <li class="hd__nav-item bold-6 js-signin "><a href="./SignIn.php">Đăng nhập</a></li>      
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
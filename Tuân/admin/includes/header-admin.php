<?php require_once('includes/connection.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <a href="../index.php" class="item-link">Trang chủ</a>
                    </li>
                    <li class="item">
                        <a href="get-token.php" class="item-link">Get Token</a>
                    </li>
                    <li class="item">
                        <!-- <a href="#!" class="item-link">Manage</a> -->
                        <a class="item-link">Manage</a>
                        <div class="item_menu">
                            <a href="manage-user.php" class="item_menu-link">User</a>
                            <a href="manage-token.php" class="item_menu-link">Token</a>
                            <a href="manage-acc-net.php" class="item_menu-link">Account</a>
                            <a href="manage-list.php" class="item_menu-link">List</a>
                        </div>
                    </li>
                    <!-- <li class="item">
                        <a href="#!" class="item-link">Manage User</a>
                    </li> -->
                </ul>
            </div>

            <div class="header-right">
                <ul class="list">
                    <li class="item">
                        <p class="item-name"><?php echo $_SESSION['fullname'] ?></p>
                    </li>
                    <li class="item">
                        <i class="item-icon fas fa-bars"></i>
                        <div class=item_nav>
                            <a href="../info-login.php" class="item_nav-link">Thông tin chi tiết</a>
                            <a href="../logout.php" class="item_nav-link">Đăng xuất</a>
                        </div>
                    </li>
                </ul>
            </div>            

        </div>
    </header>

    <div class="main">
        
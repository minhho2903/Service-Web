        <?php require_once('connection.php') ?>
        <!-- Modal Nạp tiền -->
        <!-- modaRC:  dành cho moda Recharge (nạp tiền)-->
        <div class="modaRC js-modaRC">
        <?php if ($_SESSION['role'] >= 1) { ?>
            <div class="modaRC-container-admin js-modaRC-container">
                <div class="modaRC__close js-modaRC-close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
                <div class="modaRC__hd bold-6">
                    Nạp tiền
                </div>
                <div class="modaRC__body bold-5">
                    <form action="index.php" method="POST">
                        <div class="flex-center modaRC__body-id">
                            <div class="modaRC__body-admin-left">Username: </div>
                            <input type="text" name="" id="" class="modaRC__body-admin-right padding-5" placeholder="abc123">
                        </div>
                        <div class="flex-center modaRC__body-username">
                            <div class="modaRC__body-admin-left">Nạp thêm: </div>
                            <input type="number" min="10" max="1000" name="recharge" id="" class="modaRC__body-admin-right padding-5" value="10">
                        </div>
                        <button name="btn_add" class="RC-confirm bold-6">
                            Xác Nhận
                        </button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <div class="modaRC-container-guest js-modaRC-container">
                <div class="modaRC__close js-modaRC-close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
                <div class="modaRC__hd bold-6">
                    Thông tin số dư cá nhân
                </div>
                <div class="modaRC__body bold-5">
                    <div class="flex-center modaRC__body-id">
                        <div class="modaRC__body-guest-left">Số tiền hiện có: </div>
                        <div class="modaRC__body-guest-right"><?php echo $_SESSION['coin'] ?>
                            <i class="money-icon fa fa-coins" style="color:#f7da40;"></i>
                        </div>
                    </div>
                    <a href="https://www.facebook.com/kmphimgiare.support" target="_blank" class="modaRC__body-contact">Liên hệ với Page để được nạp thêm tiền</a>
                </div>
            </div>
        <?php } ?>
        </div>
        <script src="./style/js/modaRC.js"></script>

<?php 

    if(isset($_POST['btn_add'])) {
        $id = $_SESSION['user_id'];
        $coin = $_SESSION['coin'];
        $add_coin = $_POST['recharge'] + $coin;
        $sql = "UPDATE user SET coin = $add_coin WHERE id = $id";
        mysqli_query($conn, $sql);
        $_SESSION['coin'] = $add_coin;
        echo "<script>alert('Bạn đã nạp tiền thành công, mua thả ga đi nhé ^^')</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=index.php\">";
    }
?>
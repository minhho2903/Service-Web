        <?php require_once('connection.php') ?>
        <?php
            if(isset($_SESSION['user_id'])) {
                $id = $_SESSION['user_id'];
                $sql_acc = "SELECT * FROM user WHERE id = $id";
                $query_acc = mysqli_query($conn, $sql_acc);
                $data_acc = mysqli_fetch_array($query_acc);
            }
        ?>

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
                    <form method="POST" id="form_input">
                        <div class="flex-center modaRC__body-id">
                            <div class="modaRC__body-admin-left">Username: </div>
                            <input type="text" name="username" class="modaRC__body-admin-right padding-5" placeholder="abc123">
                        </div>
                        <div class="flex-center modaRC__body-username">
                            <div class="modaRC__body-admin-left">Nạp thêm: </div>
                            <input type="number" min="10" max="1000" name="recharge" class="modaRC__body-admin-right padding-5" value="10">
                        </div>
                        <div class="message"></div>
                        <button name="btn_add" class="RC-confirm bold-6 btn_add">
                            Xác Nhận
                        </button>
                    </form>
                </div>
            </div>
            <script src="./style/js/addcoin-ajax.js"></script>

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
                        <div class="modaRC__body-guest-right"><?php echo $data_acc['coin'] ?>
                            <i class="money-icon fa fa-coins" style="color:#f7da40;"></i>
                        </div>
                    </div>
                    <a href="https://www.facebook.com/kmphimgiare.support" target="_blank" class="modaRC__body-contact">Liên hệ với Page để được nạp thêm tiền</a>
                </div>
            </div>
        <?php } ?>
        </div>
        <script src="./style/js/modaRC.js"></script>
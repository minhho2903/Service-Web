        <!-- Modal Thông tin chi tiết -->
        <!-- modaDT: dành cho moda Details (thông tin chi tiết) -->
        <div class="modaDT js-modaDT">
            <div class="modaDT-container js-modaDT-container">
                <div class="modaDT__close js-modaDT-close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
                <div class="modaDT__hd bold-6">
                    Thông tin chi tiết
                </div>
                <div class="modaDT__body bold-5">
                    <div class="flex-center modaDT__body-id">
                        <div class="modaDT__body-left">ID</div>
                        <div class="modaDT__body-right"><?php echo $_SESSION['user_id'] ?></div>
                    </div>
                    <div class="flex-center modaDT__body-username">
                        <div class="modaDT__body-left">Username</div>
                        <div class="modaDT__body-right"><?php echo $_SESSION['username'] ?></div>
                    </div>
                    <div class="flex-center modaDT__body-fullname">
                        <div class="modaDT__body-left">Fullname</div>
                        <div class="modaDT__body-right"><?php echo $_SESSION['fullname'] ?></div>
                    </div>
                    <div class="flex-center modaDT__body-mail">
                        <div class="modaDT__body-left">Mail</div>
                        <div class="modaDT__body-right"><?php echo $_SESSION['email'] ?></div>
                    </div>
                    <div class="flex-center modaDT__body-coin">
                        <div class="modaDT__body-left">Coin</div>
                        <div class="modaDT__body-right"><?php echo $_SESSION['coin'] ?></div>
                    </div>
                    <div class="flex-center modaDT__body-role">
                        <div class="modaDT__body-left">Role</div>
                        <div class="modaDT__body-right"><?php echo checkRole() ?></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="./style/js/modaDT.js"></script>

<?php 
//Hàm kiểm tra role của user đăng nhập tương ứng
function checkRole() {
    return ($_SESSION['role'] == 2) ? 
            "Admin" : (($_SESSION['role'] == 1) ? 
            "Nhân viên" : "Khách");
} 
?>
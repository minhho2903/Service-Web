<?php include('includes/role1.php') ?>
<?php include('includes/header-admin.php') ?>
<?php require_once('includes/connection.php') ?>

<?php 
//phân trang
if($_SESSION['role'] == 1) {
    $sql2 = "SELECT COUNT(id) AS total FROM user WHERE role = 0";
} 
if($_SESSION['role'] == 2) {
    $sql2 = "SELECT COUNT(id) AS total FROM user";
}
// $sql2 = "SELECT COUNT(id) AS total FROM user";
$query = mysqli_query($conn, $sql2);
$row = mysqli_fetch_array($query);
$total_records = $row['total'];

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;

$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}

$start = ($current_page - 1) * $limit;

//Hàm check role để hiện thị ra bảng
function checkRoleShow($data) {
    return ($data['role'] == 2) ? 
            "Admin" : (($data['role'] == 1) ? 
            "Nhân viên" : "Khách");
}

if($_SESSION['role'] == 1) {
    $sql = "SELECT * FROM user WHERE role = 0 LIMIT $start, $limit";
    $query = mysqli_query($conn, $sql);
}
if($_SESSION['role'] == 2) {
    $sql = "SELECT * FROM user LIMIT $start, $limit";
    $query = mysqli_query($conn, $sql);
}
?>


        <!-- Content -->
        <div id="content">
            <div class="grid wide table__user-container">
                <div class="table__user-title">
                    <span class="table__user-name-title bold-5">Bảng quản lý thành viên</span>
                    <i class="table__user-icon-title fas fa-users" style="color:#F0A500;"></i>
                </div>
                <div class="table__user-input">
                    <button type="submit" name="btn_add-user" class="btn-add bold-6 js-AU">+ thêm thành viên</button>
                </div>
                <div class="table__user">
                    <div class="table__user-list bold-6">
                        <div class="row-table_user color-blue table__user-id">ID</div>
                        <div class="row-table_user color-blue table__user-name">Username</div>
                        <?php if($_SESSION['role'] == 2) { ?>
                        <div class="row-table_user color-blue table__user-pass">Password</div>
                        <?php } ?>
                        <div class="row-table_user color-blue table__user-fname">Fullname</div>
                        <div class="row-table_user color-blue table__user-email">Email</div>
                        <div class="row-table_user color-blue table__user-coin">Coin</div>
                        <div class="row-table_user color-blue table__user-role">Role</div>
                        <div class="row-table_user color-blue table__user-edit">Edit</div>
                    </div>
                    <?php while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="table__user-list">
                        <div class="row-table_user table__user-id"><?php echo $row['id'] ?></div>
                        <div class="row-table_user table__user-name"><?php echo $row['username'] ?></div>
                        <?php if($_SESSION['role'] == 2) { ?>
                        <div class="row-table_user table__user-pass"><?php echo $row['password'] ?></div>
                        <?php } ?>
                        <div class="row-table_user table__user-fname"><?php echo $row['fullname'] ?></div>
                        <div class="row-table_user table__user-email"><?php echo $row['email'] ?></div>
                        <div class="row-table_user table__user-coin"><?php echo $row['coin'] ?></div>
                        <div class="row-table_user table__user-role"><?php echo checkRoleShow($row) ?></div>
                        <div class="row-table_user table__user-edit">
                            <span href="user-edit.php?id=<?php echo $row['id'] ?>">
                                <i class="table__user-icon green fas fa-edit js-EU"></i>
                            </span>
                            <?php if($_SESSION['role'] == 2) { ?>
                            <a href="user-delete.php?id=<?php echo $row['id'] ?>">
                                <i class="table__user-icon red fas fa-trash-alt"></i>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="pagination">
                <?php 
                for($i = 1; $i <= $total_page; $i++) {
                    if($i == $current_page) {
                        echo "<a class='num-page active'>" . $i . "</a>";
                    } else {
                        echo "<a class='num-page' href='manage-user.php?page=". $i ."'>" . $i . "</a>";
                    }
                }    
                ?>
            </div>
        </div>

         <!-- Modal edit page manage-user -->
        <!-- modaEU:  dành cho moda Edit User -->
        <div class="modaEU js-modaEU">
            <div class="modaEU-container js-modaEU-container">
                <div class="modaEU__close js-modaEU-close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
                <div class="modaEU__hd bold-6">
                    Chỉnh sửa thành viên
                </div>
                <div class="modaEU__body bold-5">
                    <form action="user-edit.php" method="POST">
                        <div class="flex-center modaEU__body-username">
                            <div class="modaEU__body-left">ID: </div>
                            <div class="modaEU__body-right output-id"></div>
                        </div>
                        <div class="flex-center modaEU__body-username">
                            <div class="modaEU__body-left">Username: </div>
                            <input type="text" name="username" class="modaEU__body-right p-5">
                        </div>
                        <?php if($_SESSION['role'] == 2) { ?>
                        <div class="flex-center modaEU__body-username">
                            <div class="modaEU__body-left">Password: </div>
                            <input type="text" name="password" class="modaEU__body-right p-5">
                        </div>
                        <?php } ?>
                        <div class="flex-center modaEU__body-username">
                            <div class="modaEU__body-left">Fullname: </div>
                            <input type="text" name="fullname" class="modaEU__body-right p-5">
                        </div>
                        <div class="flex-center modaEU__body-username">
                            <div class="modaEU__body-left">Email: </div>
                            <input type="text" name="email" class="modaEU__body-right p-5">
                        </div>
                        <?php if($_SESSION['role'] == 2) { ?>
                        <div class="flex-center modaEU__body-username">
                            <div class="modaEU__body-left">Coin: </div>
                            <input type="text" name="coin" class="modaEU__body-right p-5">
                        </div>
                        <div class="flex-center modaEU__body-username">
                            <div class="modaEU__body-left">Role: </div>
                            <select name="role" class="modaEU__body-right p-5">
                                <option value="Admin">Admin</option>
                                <option value="Nhân viên">Nhân viên</option>
                                <option value="Khách">Khách</option>
                            </select>
                        </div>
                        <?php } ?>
                        <button name="btn_edit" class="EU-confirm bold-6">
                            Cập nhật
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <script src="./style/js/modaEU.js"></script>

        <!-- Modal add page manage-user -->
        <!-- modaAU:  dành cho moda Add User -->
        <div class="modaAU js-modaAU">
            <div class="modaAU-container js-modaAU-container">
                <div class="modaAU__close js-modaAU-close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
                <div class="modaAU__hd bold-6">
                    Thêm thành viên
                </div>
                <div class="modaAU__body bold-5">
                    <form action="user-add.php" method="POST">
                        <div class="flex-center modaAU__body-username">
                            <div class="modaAU__body-left">Username: </div>
                            <input type="text" name="username" class="modaAU__body-right p-5">
                        </div>
                        <div class="flex-center modaAU__body-username">
                            <div class="modaAU__body-left">Password: </div>
                            <input type="text" name="password" class="modaAU__body-right p-5">
                        </div>
                        <div class="flex-center modaAU__body-username">
                            <div class="modaAU__body-left">Fullname: </div>
                            <input type="text" name="fullname" class="modaAU__body-right p-5">
                        </div>
                        <div class="flex-center modaAU__body-username">
                            <div class="modaAU__body-left">Email: </div>
                            <input type="text" name="email" class="modaAU__body-right p-5">
                        </div>
                        <?php if($_SESSION['role'] == 2) { ?>
                        <div class="flex-center modaAU__body-username">
                            <div class="modaAU__body-left">Role: </div>
                            <select name="AU" class="modaAU__body-right p-5">
                                <option value="2">Admin</option>
                                <option value="1">Nhân viên</option>
                                <option value="0">Khách</option>
                            </select>
                        </div>
                        <?php } ?>
                        <button class="AU-confirm bold-6" name="btn_add">
                            Thêm
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <script src="./style/js/modaAU.js"></script>

        <script src="./style/js/js-user.js"></script>

<?php include('includes/footer.php') ?>
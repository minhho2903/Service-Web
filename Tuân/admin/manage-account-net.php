<?php include('includes/role1.php') ?>
<?php include('includes/function.php') ?>
<?php include('includes/header-admin.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 
    //Phân trang
    $sql2 = "SELECT COUNT(id) AS total FROM account_netflix";
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

    //Kiểm tra tài khoản đã sử dụng chưa
    function checkUsed($data) {
        return ($data['used'] == 0) ? "Chưa sử dụng" : "Đã dùng";
    }
?>

        <!-- Content -->
        <div id="content">
            <div class="grid wide-1000 table__acc-container">
            <div class="table__acc-title">
                    <span class="table__acc-name-title bold-5">Bảng quản lý Account</span>
                    <a href="manage-account-net.php" class="table__acc-name-sv color-red bold-6 active">Netflix</a>
                    <span class="table__acc-name-divive color-orange">/</span>
                    <a href="manage-account-dn.php" class="table__acc-name-sv color-blue bold-6">Disney+</a>
                </div>
                <div class="table__acc-input">
                    <form action="account-add.php" method="POST" class="flex-between">
                        <div class="table__acc-input-filed">
                            <input type="text" name="mail" required class="input-table_acc" placeholder="Email">
                        </div>
                        <div class="table__acc-input-filed" style="width: 25%;">
                            <input type="password" name="pass" required class="input-table_acc" placeholder="Password">
                        </div>
                        <div class="table__acc-input-opt">
                            <input type="radio" name="type" required id="HD" value="HD" checked>
                            <label class="input-opt-label bold-5" for="HD">HD</label>
                            <br>
                            <input type="radio" name="type" required id="4K" value="4K">
                            <label class="input-opt-label bold-5" for="4K">4K</label>
                        </div>
                        <button type="submit" name="btn_add-net" class="btn-add bold-6">Add</button>
                    </form>
                </div>
                <div class="table__acc">
                    <div class="table__acc-list bold-6">
                        <div class="row-table_acc color-blue table__acc-id">ID</div>
                        <div class="row-table_acc color-blue table__acc-mail">Email</div>
                        <div class="row-table_acc color-blue table__acc-pass">Password</div>
                        <div class="row-table_acc color-blue table__acc-type">Type</div>
                        <div class="row-table_acc color-blue table__acc-status">Status</div>
                        <div class="row-table_acc color-blue table__acc-edit">Edit</div>
                    </div>
                    <?php 
                    $sql = "SELECT * FROM account_netflix LIMIT $start, $limit";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="table__acc-list">
                        <div class="row-table_acc table__acc-id"><?php echo $row['id'] ?></div>
                        <div class="row-table_acc table__acc-mail"><?php echo $row['mail'] ?></div>
                        <div class="row-table_acc table__acc-pass"><?php echo $row['pass'] ?></div>
                        <div class="row-table_acc table__acc-type"><?php echo $row['type'] ?></div>
                        <div class="row-table_acc table__acc-status"><?php echo checkUsed($row) ?></div>
                        <div class="row-table_acc table__acc-edit">
                            <span href="account-edit.php?id=<?php echo $row['id'] ?>">
                                <i class="table__acc-icon green fas fa-edit js-EA"></i>
                            </span>
                            <a href="account-delete.php?id_net=<?php echo $row['id'] ?>">
                                <i class="table__acc-icon red fas fa-trash-alt"></i>
                            </a>
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
                        echo "<a class='num-page' href='manage-account-net.php?page=". $i ."'>" . $i . "</a>";
                    }
                }    
                ?>
            </div>
        </div>
        
        <!-- Modal edit page manage-acc -->
        <!-- modaEU:  dành cho moda Edit Account -->
        <div class="modaEA js-modaEA">
            <div class="modaEA-container js-modaEA-container">
                <div class="modaEA__close js-modaEA-close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
                <div class="modaEA__hd bold-6">
                    Chỉnh sửa tài khoản
                </div>
                <div class="modaEA__body bold-5">
                    <form action="account-edit.php" method="POST">
                        <div class="flex-center modaEA__body-username">
                            <div class="modaEA__body-left">ID: </div>
                            <div class="modaEA__body-right output-id"></div>
                        </div>
                        <div class="flex-center modaEA__body-username">
                            <div class="modaEA__body-left">Email: </div>
                            <input type="text" name="mail" class="modaEA__body-right p-5">
                        </div>
                        <div class="flex-center modaEA__body-username">
                            <div class="modaEA__body-left">Password: </div>
                            <input type="text" name="pass" class="modaEA__body-right p-5">
                        </div>
                        <div class="flex-center modaEA__body-username">
                            <div class="modaEA__body-left">Type: </div>
                            <select name="type" class="modaEA__body-right p-5">
                                <option value="HD">HD</option>
                                <option value="4K">4K</option>
                            </select>
                        </div>
                        <button name="btn_edit-net" class="EA-confirm bold-6">
                            Cập nhật
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <script src="./style/js/modaEA.js"></script>

        <script src="./style/js/js-account.js"></script>

<?php include('includes/footer.php') ?>
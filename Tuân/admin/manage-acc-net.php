<?php include('includes/role1.php') ?>
<?php include('includes/header-admin.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 
    $sql2 = "SELECT COUNT(id) AS total FROM account_netflix";
    $query = mysqli_query($conn, $sql2);
    $data = mysqli_fetch_array($query);
    $total_records = $data['total'];

    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 10;

    $total_page = ceil($total_records / $limit);

    if ($current_page > $total_page) {
        $current_page = $total_page;
    } else if ($current_page < 1) {
        $current_page = 1;
    }

    $start = ($current_page - 1) * $limit;

    function checkColorUsed($data) {
        $colorUsed = "";
        if ($data['used'] == 1) {
            $colorUsed = 'used';
        }
        return $colorUsed;
    }

    function checkUsed($data) {
        $used = "Chưa sử dụng";
        if ($data['used'] == 1) {
            $used = 'Đã dùng';
        }
        return $used;
    }
?>

            <div class="warp">
                <div class="table_title">
                    Bảng quản lý Account
                    <a href="#" class="table_choice">Netflix</a> /
                    <a href="manage-acc-dn.php" class="table_choice none">Disney</a>
                </div>
                <div class="table_form">
                    <form action="account-add.php" method="POST">
                        <div class="table_form-input">
                            <input type="text" name="mail" placeholder="Email">
                        </div>
                        <div class="table_form-input">
                            <input type="text" name="pass" placeholder="Password">
                        </div>
                        <div class="table_form-input">
                            <input type="radio" id="HD" name="type" value="HD" checked>
                            <label for="HD">HD</label></br>
                            <input type="radio" id="4K" name="type" value="4K">
                            <label for="4K">4K</label>
                        </div>
                        <button class="btn" type="submit" name="btn_add-net">Thêm</button>
                    </form>
                </div>
                <div class="table">
                    <div class="table_row row-header">
                        <div class="row row-id">ID</div>
                        <div class="row row-email">Mail</div>
                        <div class="row row-pass">Password</div>
                        <div class="row row-type">Type</div>
                        <div class="row row-used">Used</div>
                        <div class="row row-edit">Edit</div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM account_netflix LIMIT $start, $limit";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="table_row <?php echo checkColorUsed($row) ?>">
                        <div class="row row-id"><?php echo $row['id'] ?></div>
                        <div class="row row-email"><?php echo $row['mail'] ?></div>
                        <div class="row row-pass"><?php echo $row['pass'] ?></div>
                        <div class="row row-type"><?php echo $row['type'] ?></div>
                        <div class="row row-used"><?php echo checkUsed($row) ?></div>
                        <div class="row row-edit">
                            <span href="account-edit.php?id=<?php echo $row['id'] ?>" class="js-edit row-edit-icon green">
                                <i class="fas fa-edit"></i>
                            </span>
                            <a href="account-delete.php?id_net=<?php echo $row['id'] ?>" class="row-edit-icon red">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="pagination">
                    <?php
                    for($i = 1; $i <= $total_page; $i++) {
                        if($i == $current_page) {
                            echo "<a class='active'>" . $i . "</a>";
                        } else {
                            echo "<a href='manage-acc-net.php?page=". $i ."'>" . $i . "</a>";
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Modal edit -->
            <div class="modal-box box-edit">
                <div class="modal-overlay overlay-edit"></div>
                <div class="modal-warp">
                    <div class="modal-headding">
                        <p class="modal-headding-title">Chỉnh sửa Account</p>
                        <i class="modal-close edit-close fas fa-times"></i>
                    </div>
                    <div class="modal-body">
                        <form action="account-edit.php?id" method="POST">
                            <div class="body-row">
                                <p class="body-content">ID: </p>
                                <span class="output-id" name="id"></span>
                            </div>
                            <div class="body-row">
                                <p class="body-content">Mail: </p>
                                <input class="body-input" name="mail" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Pass: </p>
                                <input class="body-input" name="pass" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Type: </p>
                                <select name="type">
                                    <option value="HD">HD</option>
                                    <option value="4K">4K</option>
                                </select>
                            </div>
                            <div class="body-row">
                                <button class="btn" name="btn_edit-net">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <script>
            // Xử lý modal Edit
            const clickEdit = document.querySelectorAll('.row .js-edit');
            const showEdit = document.querySelector('.box-edit');
            const clickEditClose1 = document.querySelector('.edit-close');
            const clickEditClose2 = document.querySelector('.overlay-edit');
            function openModalEdit() {
                showEdit.classList.add('open');
            }
            function closeModalEdit() {
                showEdit.classList.remove('open');
            }
            for(var i of clickEdit) {
                i.addEventListener('click', openModalEdit);
            }
            clickEditClose1.addEventListener('click', closeModalEdit);
            clickEditClose2.addEventListener('click', closeModalEdit);
        </script>
        <script src="style/js-account.js"></script>
<?php include('includes/footer.php') ?>
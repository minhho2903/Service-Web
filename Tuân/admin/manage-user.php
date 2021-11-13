<?php include('includes/role1.php') ?>
<?php include('includes/header-admin.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 
    $sql2 = "SELECT COUNT(id) AS total FROM user";
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
?>


            <div class="warp">
                <p class="table_title">Bảng quản lý thành viên</p>
                <div class="table_add">
                    <button class="btn js-add">+ Thêm thành viên</button>
                </div>
                <div class="table">
                    <div class="table_row row-header">
                        <div class="row row-id">ID</div>
                        <div class="row row-user">Username</div>
                        <div class="row row-pass">Password</div>
                        <div class="row row-name">Fullname</div>
                        <div class="row row-email">Email</div>
                        <div class="row row-role">Role</div>
                        <div class="row row-edit">Edit</div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM user LIMIT  $start, $limit";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="table_row">
                        <div class="row row-id"><?php echo $row['id'] ?></div>
                        <div class="row row-user"><?php echo $row['username'] ?></div>
                        <div class="row row-pass"><?php echo $row['password'] ?></div>
                        <div class="row row-name"><?php echo $row['fullname'] ?></div>
                        <div class="row row-email"><?php echo $row['email'] ?></div>
                        <div class="row row-role"><?php echo ($row['role'] == 2) ? 
                                                    "Admin" : (($row['role'] == 1) ? 
                                                    "Nhân viên" : "Khách") ?></div>
                        <div class="row row-edit">
                            <span href="user-edit.php?id=<?php echo $row['id'] ?>" class="js-edit row-edit-icon green">
                                <i class="fas fa-edit"></i>
                            </span>
                            <a href="user-delete.php?id=<?php echo $row['id'] ?>" class="row-edit-icon red">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="pagination">
                    <?php 
                    // if($current_page > 1 && $total_page > 1) {
                    //     echo "<a href='manage-user.php?page=" . ($current_page - 1) . "'><</a>";
                    // }
                    for($i = 1; $i <= $total_page; $i++) {
                        if($i == $current_page) {
                            echo "<a class='active'>" . $i . "</a>";
                        } else {
                            echo "<a href='manage-user.php?page=". $i ."'>" . $i . "</a>";
                        }
                    }
                    // if($current_page < $total_page && $total_page > 1) {
                    //     echo "<a href='manage-user.php?page=" . ($current_page + 1) . "'>></a>";
                    // }
                    ?>
                </div>
            </div>
            
            <!-- Modal edit -->
            <div class="modal-box box-edit">
                <div class="modal-overlay overlay-edit"></div>
                <div class="modal-warp">
                    <div class="modal-headding">
                        <p class="modal-headding-title">Chỉnh sửa thành viên</p>
                        <i class="modal-close edit-close fas fa-times"></i>
                    </div>
                    <div class="modal-body">
                        <form action="user-edit.php?id=" method="POST">
                            <div class="body-row">
                                <p class="body-content">ID: </p>
                                <span class="output-id" name="id"></span>
                            </div>
                            <div class="body-row">
                                <p class="body-content">Username: </p>
                                <input class="body-input" name="username" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Password: </p>
                                <input class="body-input" name="password" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Fullname: </p>
                                <input class="body-input" name="fullname" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Email: </p>
                                <input class="body-input" name="email" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Role: </p>
                                <select name="role">
                                    <option value="Khách">Khách</option>
                                    <option value="Nhân viên">Nhân viên</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                            <div class="body-row">
                                <button class="btn" name="btn_edit">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Modal add user -->
            <div class="modal-box box-add">
                <div class="modal-overlay overlay-add"></div>
                <div class="modal-warp">
                    <div class="modal-headding">
                        <p class="modal-headding-title">Thêm thành viên</p>
                        <i class="modal-close add-close fas fa-times"></i>
                    </div>
                    <div class="modal-body">
                        <form action="user-add.php" method="POST">
                            <div class="body-row">
                                <p class="body-content">Username: </p>
                                <input class="body-input" name="username" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Password: </p>
                                <input class="body-input" name="password" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Fullname: </p>
                                <input class="body-input" name="fullname" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Email: </p>
                                <input class="body-input" name="email" type="text">
                            </div>
                            <div class="body-row">
                                <p class="body-content">Role: </p>
                                <select name="role">
                                    <option value="0">Khách</option>
                                    <option value="1">Nhân viên</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                            <div class="body-row">
                                <!-- <p class="body-content"></p> -->
                                <button class="btn" name="btn_add">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        <!-- Xử lý modal edit -->
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

            // Xử lý modal Add
            const clickAdd = document.querySelector('.js-add');
            const showAdd = document.querySelector('.box-add');
            const clickAddClose1 = document.querySelector('.add-close');
            const clickAddClose2 = document.querySelector('.overlay-add');
            function openModalAdd() {
                showAdd.classList.add('open');
            }
            function closeModalAdd() {
                showAdd.classList.remove('open');
            }
            clickAdd.addEventListener('click', openModalAdd);
            clickAddClose1.addEventListener('click', closeModalAdd);
            clickAddClose2.addEventListener('click', closeModalAdd);

        </script>
        <script src="style/js-user.js"></script>

<?php include('includes/footer.php') ?>
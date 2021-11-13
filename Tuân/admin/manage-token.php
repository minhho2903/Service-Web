<?php include('includes/role1.php') ?>
<?php include('includes/header-admin.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 
    $sql2 = "SELECT COUNT(id) AS total FROM token";
    $query = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_array($query);
    $total_records = $row['total'];

    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 12;

    $total_page = ceil($total_records / $limit);

    if ($current_page > $total_page) {
        $current_page = $total_page;
    } else if ($current_page < 1) {
        $current_page = 1;
    }

    $start = ($current_page - 1) * $limit;
    
    function checkService($conn, $data) {
        $colorCheck = "";
        if ($data['service'] == 'Netflix') {
            $colorCheck = "colorRed";
        }
        if ($data['service'] == 'Disney') {
            $colorCheck = "colorBlue";
        }
        return $colorCheck;
    }

    function checkBlocked($conn, $data) {
        $colorBlock = "";
        if ($data['blocked'] == 1) {
            $colorBlock = 'blocked';
        }
        return $colorBlock;
    }

    function IconBlock($conn, $data) {
        $iconBlock = '<i class="fas fa-lock"></i>';
        if ($data['blocked'] == 1) {
            $iconBlock = '<i class="fas fa-lock-open"></i>';
        }
        return $iconBlock;
    }

    function urlBlock($conn, $data) {
        $urlBlock = 'block';
        if ($data['blocked'] == 1) {
            $urlBlock = 'unblock';
        }
        return $urlBlock;
    }
?>

            <div class="warp">
                <p class="table_title">Bảng quản lý Token</p>
                <div class="table">
                    <div class="table_row row-header">
                        <div class="row row-id">ID</div>
                        <div class="row row-name">Name</div>
                        <div class="row row-type">Type</div>
                        <div class="row row-service">Service</div>
                        <div class="row row-time">Time</div>
                        <div class="row row-dateGet">Date Get</div>
                        <div class="row row-edit row-3">Edit</div>
                    </div>
                    <?php 
                    $sql = "SELECT * FROM token LIMIT $start, $limit";
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="table_row <?php echo checkBlocked($conn, $row) ?>">
                        <div class="row row-id"><?php echo $row['id'] ?></div>
                        <div class="row row-name"><?php echo $row['name'] ?></div>
                        <div class="row row-type"><?php echo $row['type'] ?></div>
                        <div class="row row-service <?php echo checkService($conn, $row) ?>"><?php echo $row['service'] ?></div>
                        <div class="row row-time"><?php echo $row['time'] ?> Tháng</div>
                        <div class="row row-dateGet"><?php echo $row['time_created'] ?></div>
                        <div class="row row-edit row-3">
                            <span href="token-edit.php?id=<?php echo $row['id'] ?>" class="js-edit row-edit-icon green">
                                <i class="fas fa-edit"></i>
                            </span>
                            <a href="token-<?php echo urlBlock($conn, $row).'.php?id='.$row['id'] ?>" class="row-edit-icon orange">
                                <?php echo IconBlock($conn, $row) ?>
                            </a>
                            <a href="token-delete.php?id=<?php echo $row['id'] ?>" class="row-edit-icon red">
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
                            echo "<a href='manage-token.php?page=". $i ."'>" . $i . "</a>";
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
                        <p class="modal-headding-title">Chỉnh sửa Token</p>
                        <i class="modal-close edit-close fas fa-times"></i>
                    </div>
                    <div class="modal-body">
                        <form action="token-edit.php?id=" method="POST">
                            <div class="body-row">
                                <p class="body-content">ID: </p>
                                <span class="output-id" name="id"></span>
                            </div>
                            <div class="body-row">
                                <p class="body-content">Name: </p>
                                <span class="output-name" name="name-token"></span>
                                <!-- <input class="body-input" name="name" type="text"> -->
                            </div>
                            <div class="body-row">
                                <p class="body-content">Type: </p>
                                <select class="select-row" name="type">
                                    <option value="HD">HD</option>
                                    <option value="4K">4K</option>
                                </select>
                            </div>
                            <div class="body-row">
                                <p class="body-content">Service: </p>
                                <select class="select-row" name="service">
                                    <option value="Netflix">Netflix</option>
                                    <option value="Disney">Disney</option>
                                </select>
                            </div>
                            <div class="body-row">
                                <p class="body-content">Time: </p>
                                <select class="select-row" name="time">
                                    <option value="1 Tháng">1 Tháng</option>
                                    <option value="3 Tháng">3 Tháng</option>
                                    <option value="6 Tháng">6 Tháng</option>
                                    <option value="12 Tháng">12 Tháng</option>
                                </select>
                            </div>
                            <div class="body-row">
                                <p class="body-content">Date get: </p>
                                <input class="body-input" name="time_created" type="datetime-local" value="">
                            </div>
                            <div class="body-row">
                                <button class="btn" name="btn_edit">Cập nhật</button>
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
        <script src="style/js-token.js"></script>

<?php include('includes/footer.php') ?>
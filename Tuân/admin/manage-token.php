<?php include('includes/role1.php') ?>
<?php include('includes/header-admin.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 
    //Phân trang
    $sql_page = "SELECT COUNT(id) AS total FROM token";
    $query_page = mysqli_query($conn, $sql_page);
    $row_page = mysqli_fetch_array($query_page);
    $total_records = $row_page['total'];

    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 10;

    $total_page = ceil($total_records / $limit);

    if ($current_page > $total_page) {
        $current_page = $total_page;
    } else if ($current_page < 1) {
        $current_page = 1;
    }

    $start = ($current_page - 1) * $limit;
    
    //Hàm check màu cho các loại khác nhau
    function checkService( $data) {
        $colorCheck = "";
        if ($data['service'] == 'Netflix') {
            $colorCheck = "Netflix";
        }
        if ($data['service'] == 'Disney') {
            $colorCheck = "Disney";
        }
        return $colorCheck;
    }

    function checkBlocked( $data) {
        $colorBlock = "";
        if ($data['blocked'] == 1) {
            $colorBlock = 'color-block';
        }
        return $colorBlock;
    }

    function IconBlock($data) {
        $iconBlock = '<i class="table__token-icon blue fas fa-lock"></i>';
        if ($data['blocked'] == 1) {
            $iconBlock = '<i class="table__token-icon blue fas fa-lock-open"></i>';
        }
        return $iconBlock;
    }

    function urlBlock($data) {
        $urlBlock = 'block';
        if ($data['blocked'] == 1) {
            $urlBlock = 'unblock';
        }
        return $urlBlock;
    }
?>

        <!-- Content -->
        <div id="content">
            <div class="grid wide-1000 table__token-container">
                <div class="table__token-title">
                    <span class="table__token-name-title bold-5">Bảng quản lý Token</span>
                    <i class="table__token-icon-title fas fa-link" style="color:#F0A500;"></i>
                </div>
                <div class="table__token">
                    <div class="table__token-list bold-6">
                        <div class="row-table_token color-blue table__token-id">ID</div>
                        <div class="row-table_token color-blue table__token-nametoken">Token</div>
                        <div class="row-table_token color-blue table__token-type">Type</div>
                        <div class="row-table_token color-blue table__token-service">Service</div>
                        <div class="row-table_token color-blue table__token-time">Time</div>
                        <div class="row-table_token color-blue table__token-dataget">Date Get</div>
                        <div class="row-table_token color-blue table__token-edit">Edit</div>
                    </div>
                    <?php 
                    $sql = "SELECT * FROM token LIMIT $start, $limit";
                    $query = mysqli_query($conn, $sql);
                    $num_rows = mysqli_num_rows($query);
                    if ($num_rows > 0) {
                    while ($row = mysqli_fetch_array($query)) { ?>
                    <div class="table__token-list <?php echo checkBlocked($row) ?>">
                        <div class="row-table_token table__token-id"><?php echo $row['id'] ?></div>
                        <div class="row-table_token table__token-nametoken"><?php echo $row['name'] ?></div>
                        <div class="row-table_token table__token-type"><?php echo $row['type'] ?></div>
                        <div class="row-table_token table__token-service <?php echo checkService($row) ?>"><?php echo $row['service'] ?></div>
                        <div class="row-table_token table__token-time"><?php echo $row['time'] ?> Tháng</div>
                        <div class="row-table_token table__token-dataget"><?php echo $row['time_created'] ?></div>
                        <div class="row-table_token table__token-edit">
                            <span href="token-edit.php?id=<?php echo $row['id'] ?>">
                                <i class="table__token-icon green fas fa-edit js-ET"></i>
                            </span>
                            <a href="token-<?php echo urlBlock($row).'.php?id='.$row['id'] ?>">
                                <?php echo IconBlock($row) ?>
                            </a>
                            <?php if($_SESSION['role'] == 2) { ?>
                            <a href="token-delete.php?id=<?php echo $row['id'] ?>">
                                <i class="table__token-icon red fas fa-trash-alt"></i>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
            </div>
            <div class="pagination">
                <?php 
                for($i = 1; $i <= $total_page; $i++) {
                    if($i == $current_page) {
                        echo "<a class='num-page active'>" . $i . "</a>";
                    } else {
                        echo "<a class='num-page' href='manage-token.php?page=". $i ."'>" . $i . "</a>";
                    }
                }    
                ?>
            </div>
        </div>
        
        <!-- Modal edit page manage-token -->
        <!-- modaET:  dành cho moda Edit Token -->
        <div class="modaET js-modaET">
            <div class="modaET-container js-modaET-container">
                <div class="modaET__close js-modaET-close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
                <div class="modaET__hd bold-6">
                    Chỉnh sửa Token
                </div>
                <div class="modaET__body bold-5">
                    <form action="token-edit.php" method="POST">
                        <div class="flex-center modaET__body-username">
                            <div class="modaET__body-left">ID: </div>
                            <div class="modaET__body-right output-id"></div>
                        </div>
                        <div class="flex-center modaET__body-username">
                            <div class="modaET__body-left">Token: </div>
                            <div class="modaET__body-right output-name"></div>
                        </div>
                        <div class="flex-center modaET__body-username">
                            <div class="modaET__body-left">Type: </div>
                            <select name="type" class="modaET__body-right p-5">
                                <option value="HD">HD</option>
                                <option value="4K">4K</option>
                            </select>
                        </div>
                        <div class="flex-center modaET__body-username">
                            <div class="modaET__body-left">Service: </div>
                            <select name="service" class="modaET__body-right p-5">
                                <option value="Netflix">Netflix</option>
                                <option value="Disney">Disney</option>
                            </select>
                        </div>
                        <div class="flex-center modaET__body-username">
                            <div class="modaET__body-left">Time: </div>
                            <select name="time" class="modaET__body-right p-5">
                                    <option value="1 Tháng">1 Tháng</option>
                                    <option value="3 Tháng">3 Tháng</option>
                                    <option value="6 Tháng">6 Tháng</option>
                                    <option value="12 Tháng">12 Tháng</option>
                            </select>
                        </div>
                        <div class="flex-center modaET__body-username">
                            <div class="modaET__body-left">Date Get: </div>
                            <input type="datetime-local" name="time_created" class="modaET__body-right p-5">
                        </div>
                        <button class="ET-confirm bold-6" name="btn_edit">
                            Cập nhật
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <script src="./style/js/modaET.js"></script>

        <script src="./style/js/js-token.js"></script>

<?php include('includes/footer.php') ?>
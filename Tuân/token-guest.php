<?php include('includes/head2.php') ?>
<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>
<?php include('includes/role0.php') ?>

<?php
$idUser = $_SESSION['user_id'];

//Phân trang
// $sql1 = "SELECT COUNT(id_token) AS total FROM manage_user WHERE id = $idUser";
// $query1 = mysqli_query($conn, $sql1);
// $row = mysqli_fetch_array($query1);
// $total_records = $row['total'];

// $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
// $limit = 10;

// $total_page = ceil($total_records / $limit);

// if ($current_page > $total_page) {
//     $current_page = $total_page;
// } else if ($current_page < 1) {
//     $current_page = 1;
// }

// $start = ($current_page - 1) * $limit;

// Lấy thông tin
$sql = "SELECT name, type, service, time, time_created, blocked
        FROM manage_user
            INNER JOIN user ON manage_user.id_user = user.id
            INNER JOIN token ON manage_user.id_token = token.id
        WHERE user.id = $idUser";
        // LIMIT $start, $limit";
$query = mysqli_query($conn, $sql);

//Các hàm xử lý màu
function checkService($data) {
    $colorCheck = "";
    if ($data['service'] == 'Netflix') {
        $colorCheck = "Netflix";
    }
    if ($data['service'] == 'Disney') {
        $colorCheck = "Disney";
    }
    return $colorCheck;
}

function checkBlocked($data) {
    $colorBlock = "";
    if ($data['blocked'] == 1) {
        $colorBlock = 'color-block';
    }
    return $colorBlock;
}
?>
        <!-- Content -->
        <div id="content">
            <div class="grid wide-1000 table__token-container">
                <div class="table__token-title">
                    <span class="table__token-name-title bold-5">Bảng quản lý Token cá nhân</span>
                    <i class="table__token-icon-title fas fa-address-book" style="color:#F0A500;"></i>
                </div>
                <div class="table__token">
                    <div class="table__token-list bold-6">
                        <div class="row-table_token color-blue table__token-id">ID</div>
                        <div class="row-table_token color-blue table__token-nametoken">Token</div>
                        <div class="row-table_token color-blue table__token-type">Type</div>
                        <div class="row-table_token color-blue table__token-service">Service</div>
                        <div class="row-table_token color-blue table__token-time">Time</div>
                        <div class="row-table_token color-blue table__token-dataget">Date Get</div>
                    </div>
                    <?php $ii = 1;
                    if(mysqli_num_rows($query)) {
                    while($data = mysqli_fetch_array($query)) { ?>
                    <div class="table__token-list <?php echo checkBlocked($data) ?>">
                        <div class="row-table_token table__token-id"><?php echo $ii ?></div>
                        <div class="row-table_token table__token-nametoken"><?php echo $data['name'] ?></div>
                        <div class="row-table_token table__token-type"><?php echo $data['type'] ?></div>
                        <div class="row-table_token table__token-service <?php echo checkService($data) ?>"><?php echo $data['service'] ?></div>
                        <div class="row-table_token table__token-time"><?php echo $data['time'] ?> Tháng</div>
                        <div class="row-table_token table__token-dataget"><?php echo $data['time_created'] ?></div>
                    </div>
                    <?php $ii++; }} ?>
                </div>
            </div>
            <div class="pagination">
                <?php 
                // for($i = 1; $i <= $total_page; $i++) {
                //     if($i == $current_page) {
                //         echo "<a class='num-page active'>" . $i . "</a>";
                //     } else {
                //         echo "<a class='num-page' href='manage-token.php?page=". $i ."'>" . $i . "</a>";
                //     }
                // }    
                ?>
            </div>
        </div>

<?php include('includes/footer.php') ?>
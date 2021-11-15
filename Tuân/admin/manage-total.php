<?php include('includes/role1.php') ?>
<?php include('includes/header-admin.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 
//Hàm check màu cho các loại khác nhau
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
?>

        <!-- Content -->
        <div id="content">
            <div class="grid wide-1000 table__token-container">
                <div class="table__token-title">
                    <span class="table__token-name-title bold-5">Bảng quản lý Doanh thu</span>
                    <i class="table__token-icon-title fas fa-link" style="color:#F0A500;"></i>
                </div>
                <div class="table__token">
                    <div class="table__token-list bold-6">
                        <div class="row-table_token color-blue table__token-id">ID</div>
                        <div class="row-table_token color-blue table__token-type">Type</div>
                        <div class="row-table_token color-blue table__token-service">Service</div>
                        <div class="row-table_token color-blue table__token-time">Time</div>
                        <div class="row-table_token color-blue table__token-time">Đơn giá</div>
                        <div class="row-table_token color-blue table__token-dataget">Số lượng</div>
                        <div class="row-table_token color-blue table__token-edit">Tổng tiền</div>
                    </div>
                    <?php $i = 1;
                    $totalAll = 0;
                    $sql = "SELECT * FROM price_service";
                    $query = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_array($query)) { 
                        $typeT = $data['type'];
                        $serviceT = $data['service'];
                        $timeT = $data['time'];
                        $priceT = $data['price'];    
                    ?>
                    <div class="table__token-list">
                        <div class="row-table_token table__token-id"><?php echo $i ?></div>
                        <div class="row-table_token table__token-type"><?php echo $typeT ?></div>
                        <div class="row-table_token table__token-service <?php echo checkService($data) ?>"><?php echo $serviceT ?></div>
                        <div class="row-table_token table__token-time"><?php echo $timeT ?> Tháng</div>
                        <div class="row-table_token table__token-time"><?php echo $priceT ?>.000</div>
                        <?php 
                        $sqlTotal = "SELECT COUNT(*) AS total
                                    FROM token
                                    WHERE type = '$typeT' AND
                                          service = '$serviceT' AND
                                          time = '$timeT'";
                        $queryTotal = mysqli_query($conn, $sqlTotal);
                        $rowTotal = mysqli_fetch_array($queryTotal);
                        $totalType = $rowTotal['total'];
                        $total = $totalType * $priceT;
                        $totalAll += $total;
                        ?>
                        <div class="row-table_token table__token-dataget"><?php echo $totalType ?></div>
                        <?php if($total == 0) { ?>
                            <div class="row-table_token table__token-edit"><?php echo $total ?></div>
                        <?php } else {?>
                            <div class="row-table_token table__token-edit"><?php echo $total ?>.000</div>
                        <?php } ?>
                    </div>
                    <?php $i++; } ?>
                    <div class="table__token-list">
                        <div class="row-table_token table__token-id"></div>
                        <div class="row-table_token table__token-type"></div>
                        <div class="row-table_token table__token-service"></div>
                        <div class="row-table_token table__token-time"></div>
                        <div class="row-table_token table__token-time"></div>
                        <div class="row-table_token color-blue table__token-dataget">Tổng doanh thu :</div>
                        <div class="row-table_token table__token-edit"><?php echo $totalAll ?>.000 VNĐ</div>
                    </div>
                </div>
            </div>
        </div>

<?php include('includes/footer.php') ?>
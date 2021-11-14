<?php include('includes/role1.php') ?>
<?php include('includes/header-admin.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 

//Phân trang 
$sql_page = "SELECT COUNT(DISTINCT id_token) AS total FROM manage_account";
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

//truy vấn id_token
$sql = "SELECT DISTINCT id_token, name, type, service, time, time_created, blocked, time_update
        FROM manage_account
            INNER JOIN token ON manage_account.id_token = token.id
        ORDER BY time_update DESC
        LIMIT $start, $limit";
$query = mysqli_query($conn, $sql);

//Hàm hiện thị các tài khoản đã lấy của token tương ứng
function showAccount($conn, $data, $string) {
    $idToken = "id_token";
    $account = $data[$idToken];
    
    $service = strtolower($data['service']);
    $serviceAccount = "account_" . $service;
    $idService = "id_" . $service;
    
    $sql_account = "SELECT id_account, date_get, id_netflix, id_disney
                    FROM manage_account 
                        INNER JOIN token ON manage_account.id_token = token.id
                        INNER JOIN type_account ON manage_account.id_account = type_account.id
                    WHERE id_token = $account";
    $query_account = mysqli_query($conn, $sql_account);
    
    while ($row = mysqli_fetch_array($query_account)) {
        $idAccount = $row['id_account'];
        
        //Lấy id_account tìm id của loại dịch vụ cần tìm
        $sql2 = "SELECT id, $idService
                FROM type_account
                WHERE id = $idAccount";
        $query2 = mysqli_query($conn, $sql2);
        $data2 = mysqli_fetch_array($query2);
        $idTypeAccount = $data2[$idService];
        
        //Lấy cột id dịch vụ tìm trong bảng dịch vụ tương ứng
        $sql3 = "SELECT *
                FROM $serviceAccount
                WHERE id = $idTypeAccount";
        $query3 = mysqli_query($conn, $sql3);
        $data3 = mysqli_fetch_array($query3);
        
        //Xuất dữ liệu ra bảng
        echo "<p class='rowshow'>" . $data3[$string] . "</p>";
    }
}
//Hàm hiển thị Date get của tài khoản tương ứng
function showDate($conn, $data) {
    $idToken = "id_token";
    $account = $data[$idToken];
    
    $sql = "SELECT id_account, date_get, id_netflix, id_disney
                    FROM manage_account 
                        INNER JOIN token ON manage_account.id_token = token.id
                        INNER JOIN type_account ON manage_account.id_account = type_account.id
                    WHERE id_token = $account";
    $query = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_array($query)) {
        echo "<p class='rowshow'>" . $row['date_get'] . "</p>";
    }
}

//Hàm check màu
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

function IconBlock($data) {
    $iconBlock = '<i class="table__list-icon fas fa-lock blue"></i>';
    if ($data['blocked'] == 1) {
        $iconBlock = '<i class="table__list-icon fas fa-lock-open blue"></i>';
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
            <div class="grid wide table__list-container">
                <div class="table__list-title">
                    <span class="table__list-name-title bold-5">Bảng quản lý danh sách</span>
                    <i class="table__list-icon-title fas fa-list-ul" style="color:#F0A500;"></i>
                </div>
                <div class="table__list">
                    <div class="table__list-outside bold-6">
                        <div class="row-table_list color-blue table__list-nametoken">Token</div>
                        <div class="row-table_list color-blue table__list-type">Type</div>
                        <div class="row-table_list color-blue table__list-service">Service</div>
                        <div class="row-table_list color-blue table__list-time">Time</div>
                        <div class="row-table_list color-blue table__list-email">Email</div>
                        <div class="row-table_list color-blue table__list-pass">Pass</div>
                        <div class="row-table_list color-blue table__list-dataget">Date Get</div>
                        <div class="row-table_list color-blue table__list-edit">Edit</div>
                    </div>
                    <?php
                    $sql_result = "SELECT * FROM manage_account";
                    $query_result = mysqli_query($conn, $sql_result);
                    if(mysqli_num_rows($query_result) > 0) {
                    while($data = mysqli_fetch_array($query)) {?>
                    <div class="table__list-outside <?php echo checkBlocked($data) ?>">
                        <div class="row-table_list table__list-nametoken" id="<?php echo 'data01fd4q' . $data['id_token'] ?>"><?php echo $data['name'] ?></div>
                        <div class="row-table_list table__list-type"><?php echo $data['type'] ?></div>
                        <div class="row-table_list table__list-service Netflix <?php echo checkService($data) ?>"><?php echo $data['service'] ?></div>
                        <div class="row-table_list table__list-time"><?php echo $data['time'] ?> Tháng</div>
                        <div class="row-table_list table__list-email">
                            <?php showAccount($conn, $data, 'mail') ?>
                        </div>
                        <div class="row-table_list table__list-pass">
                            <?php showAccount($conn, $data, 'pass') ?>
                        </div>
                        <div class="row-table_list table__list-dataget">
                            <?php showDate($conn, $data) ?>
                        </div>
                        <div class="row-table_list table__list-edit">
                            <span class="js-ID">
                                <i class="table__list-icon gray far fa-id-card"></i>
                            </span>
                            <a href="list-<?php echo urlBlock($data).'.php?id='.$data['id_token'] ?>">
                                <?php echo IconBlock($data) ?>
                            </a>

                            <!-- <i class="table__list-icon far fa-id-card js-ID" style="color: #2c2323"></i>
                            <i class="table__list-icon fas fa-lock none" style="color: #4e0eff"></i>
                            <i class="table__list-icon fas fa-lock-open" style="color: #4e0eff"></i> -->
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

        <!-- Modal Information Detail page manage-list -->
        <!-- modaID:  dành cho moda Information Detail -->
        <div class="modaID js-modaID">
            <div class="modaID-container js-modaID-container">
                <div class="modaID__close js-modaID-close">
                    <ion-icon name="close-outline"></ion-icon>
                </div>
                <div class="modaID__hd bold-6">
                    Thông tin chi tiết
                </div>
                <div class="modaID__body bold-5">
                    <div class="flex-between modaID__body-username">
                        <div class="modaID__body-left">Token name:</div>
                        <div class="modaID__body-right"></div>
                    </div>
                    <div class="flex-between modaID__body-username">
                        <div class="modaID__body-left">Status:</div>
                        <div class="modaID__body-right output-status"></div>
                    </div>
                    <div class="flex-between modaID__body-username">
                        <div class="modaID__body-left">Type:</div>
                        <div class="modaID__body-right"></div>
                    </div>
                    <div class="flex-between modaID__body-username">
                        <div class="modaID__body-left">Service:</div>
                        <div class="modaID__body-right"></div>
                    </div>
                    <div class="flex-between modaID__body-username">
                        <div class="modaID__body-left">Time:</div>
                        <div class="modaID__body-right"></div>
                    </div>
                    <form method="POST">
                        <div class="flex-between modaID__body-username">
                            <div class="modaID__form-left">Account:</div>
                            <div class="modaID__form-right"></div>
                        </div>
                        <div class="ID-btn">
                            <button name="btn_reuse" class="ID-btn-reuse bold-6">Reuse</button>
                            <button name="btn_del" class="ID-btn-delete bold-6">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="./style/js/modaID.js"></script>
        <script>
            const modalBody = document.querySelector('.modaID__body');
            $('.js-ID').click(function() {
                var colTableLength = $(this.parentElement.parentElement).find('.row-table_list').length;
                var colTable = $(this.parentElement.parentElement).find('.row-table_list');
                var modalBodyLength = modalBody.childNodes.length;

                //Gán giá trị cho ô Name, Type, Service, Time
                let i =  0, ii = 1;
                while ((i < colTableLength - 4) && (ii <= modalBodyLength - 4)) {
                    if(ii != 3) {
                        modalBody.childNodes[ii].childNodes[3].innerHTML = colTable[i].innerHTML;
                    } else {
                        modalBody.childNodes[5].childNodes[3].innerHTML = colTable[i].innerHTML;
                        ii+=2;
                    }
                    i++;
                    ii+=2;
                }

                //Đánh dấu loại services
                var numService = '';
                if (colTable[2].innerHTML === "Netflix") {
                    numService = '01';
                }
                if (colTable[2].innerHTML === "Disney") {
                    numService = '02';
                }

                //Gán giá trị cho ô Account
                let contentForm = modalBody.childNodes[11].childNodes[1].childNodes[3];
                let html = '';

                for(let z = 4; z < colTableLength - 3; z++) {
                    let y = colTable[z].childNodes.length; 
                    for(let x = 1; x < y - 1; x++) {
                        let accMail = colTable[z].childNodes[x].innerHTML; 
                        let accPass = colTable[z+1].childNodes[x].innerHTML;
                        let accDate = colTable[z+2].childNodes[x].innerHTML;

                        html += `<div class="modaID__mail-acc">
                                    <input type="checkbox" name="accountCheck[]" id="data0${x}" value="data${numService+'-'+accMail}">
                                    <label for="data0${x}">
                                        <span class="modaID__mail-user">${accMail}</span>
                                        <span class="modaID__mail-pass">${accPass}</span>
                                        <span>${accDate}</span>
                                    </label>
                                </div>`;
                    }
                    contentForm.innerHTML = html;
                }
                
                //kiểm tra trạng thái của token và đổi màu để phân biệt
                let checkClass = $(this.parentElement.parentElement).hasClass('color-block');
                let addClass = modalBody.childNodes[3].childNodes[3];
                let checkStatus = document.querySelector('.output-status');
                if (checkClass === true) {
                    addClass.innerHTML = "Đang bị khóa";
                    checkStatus.classList.add('blocked');
                    checkStatus.classList.remove('normal');
                } else {
                    addClass.innerHTML = "Bình thường";
                    checkStatus.classList.add('normal');
                    checkStatus.classList.remove('blocked');
                }

                //Lấy id của token
                let idToken = colTable.attr('id').substring(10);
                //Chuyển hướng để xử lý dữ liệu khi click vào nút tương ứng
                $('.ID-btn-reuse').click(function() {
                    modalBody.childNodes[11].action = `list-reuse.php?id=${idToken}`;
                });
                $('.ID-btn-delete').click(function() {
                    modalBody.childNodes[11].action = `list-delete.php?id=${idToken}`;
                });

                
                console.log(idToken);
            });
        </script>

        

<?php include('includes/footer.php') ?>
<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php include('includes/header-admin.php')?>
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

function checkService($data) {
    $colorCheck = "";
    if ($data['service'] == 'Netflix') {
        $colorCheck = "colorRed";
    }
    if ($data['service'] == 'Disney') {
        $colorCheck = "colorBlue";
    }
    return $colorCheck;
}

function checkBlocked($data) {
    $colorBlock = "";
    if ($data['blocked'] == 1) {
        $colorBlock = 'blocked';
    }
    return $colorBlock;
}

function IconBlock($data) {
    $iconBlock = '<i class="fas fa-lock"></i>';
    if ($data['blocked'] == 1) {
        $iconBlock = '<i class="fas fa-lock-open"></i>';
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

	    <div class="warp">
    		<p class="table_title">Bảng quản lý Token</p>
    		<div class="table">
        	    <div class="table_row row-header">
       		     	<div class="row row-name">Token</div>
            		<div class="row row-type">Type</div>
                        <div class="row row-service">Service</div>
                        <div class="row row-time">Time</div>
                        <div class="row row-email">Email</div>
                        <div class="row row-pass">Pass</div>
                        <div class="row row-dateGet">Date Get</div>
                        <div class="row row-edit row-3">Edit</div>
                    </div>
                    <?php
                    $sql_result = "SELECT * FROM manage_account";
                    $query_result = mysqli_query($conn, $sql_result);
                    if(mysqli_num_rows($query_result) > 0) {
                    while($data = mysqli_fetch_array($query)) {?>
                        <div class="table_row row-select <?php echo checkBlocked($data) ?>">
                        <div class="row row-name" id="<?php echo 'data01fd4q' . $data['id_token'] ?>"><?php echo $data['name'] ?></div>
                        <div class="row row-type"><?php echo $data['type'] ?></div>
                        <div class="row row-service <?php echo checkService($data) ?>"><?php echo $data['service'] ?></div>
                        <div class="row row-time"><?php echo $data['time'] ?> Tháng</div>
                        <div class="row row-email">
                            <?php showAccount($conn, $data, 'mail') ?>
                        </div>
                        <div class="row row-pass">
                            <?php showAccount($conn, $data, 'pass') ?>
                        </div>
                        <div class="row row-dateGet">
                            <?php showDate($conn, $data) ?>
                        </div>
                        <div class="row row-edit row-3">
                            <span class="js-edit row-edit-icon blue">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <a href="list-<?php echo urlBlock($data).'.php?id='.$data['id_token'] ?>" class="row-edit-icon orange">
                                <?php echo IconBlock($data) ?>
                            </a>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
                <div class="pagination">
                    <?php
                    for($i = 1; $i <= $total_page; $i++) {
                        if($i == $current_page) {
                            echo "<a class='active'>" . $i . "</a>";
                        } else {
                            echo "<a href='manage-list.php?page=". $i ."'>" . $i . "</a>";
                        }
                    }
                    ?>
                </div>
            </div>
            
            <!-- Modal info -->
            <div class="modal-box box-edit">
                <div class="modal-overlay overlay-edit"></div>
                <div class="modal-warp">
                    <div class="modal-headding">
                        <p class="modal-headding-title">Thông tin chi tiết token</p>
                        <i class="modal-close edit-close fas fa-times"></i>
                    </div>
                    <div class="modal-body">
                        <div class="body-row">
                            <p class="body-content">Name: </p>
                            <span class="output-name" name="name-token"></span>
                        </div>
                        <div class="body-row">
                            <p class="body-content">Status: </p>
                            <span class="output-status" name="blocked"></span>
                        </div>
                        <div class="body-row">
                            <p class="body-content">Type: </p>
                            <span class="output-type" name="type"></span>
                        </div>
                        <div class="body-row">
                            <p class="body-content">Service: </p>
                            <span class="output-service" name="service"></span>
                        </div>
                        <div class="body-row">
                            <p class="body-content">Time: </p>
                            <span class="output-time" name="time"></span>
                        </div>
                        <form method="POST" class="from_input">
                            <div class="body-row">
                                <p class="body-content">Account: </p>
                                <div class="body-content-list"></div>
                            </div>
                            <div class="body-row">
                                <button class="btn btn_reuse" name="btn_reuse">Reuse</button>
                                <button class="btn btn_del" name="btn_del">Delete</button>
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
                const modalStatus = document.querySelector('.output-status');
                const modalBody = document.querySelector('.modal-body');
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
            <!-- <script src="style/js-list.js"></script> -->
            
            
            <script>
                $('.row .js-edit').click(function() {
                    var bcd = $(this.parentElement.parentElement).find('.row').length;
                    var bcdd = $(this.parentElement.parentElement).find('.row');
                    var modalBodyLength = modalBody.childNodes.length;
                    
                    //Gán giá trị cho ô Name, Type, Service, Time
                    let i =  0, ii = 1;
                    while ((i < bcd - 4) && (ii <= modalBodyLength - 4)) {
                        if(ii != 3) {
                            modalBody.childNodes[ii].childNodes[3].innerHTML = bcdd[i].innerHTML;
                        } else {
                            modalBody.childNodes[5].childNodes[3].innerHTML = bcdd[i].innerHTML;
                            ii+=2;
                        }
                        i++;
                        ii+=2;
                    }

                    var numService = '';
                    if (bcdd[2].innerHTML === "Netflix") {
                        numService = '01';
                    }
                    if (bcdd[2].innerHTML === "Disney") {
                        numService = '02';
                    }

                    //Gán giá trị cho ô Account
                    var aa = modalBody.childNodes[11].childNodes[1].childNodes[3];
                    var html = '';
                    for(let z = 4; z < bcd - 3; z++) {
                        var y = bcdd[z].childNodes.length; //data01-
                        for(let x = 1; x < y - 1; x++) {
                            // console.log(bcdd[z].childNodes[x].innerHTML);
                            let accMail = bcdd[z].childNodes[x].innerHTML; 
                            let accPass = bcdd[z+1].childNodes[x].innerHTML;
                            let accDate = bcdd[z+2].childNodes[x].innerHTML;
                            html += `<div class="body-content-item">
                                        <input type="checkbox" name="accountCheck[]" id="data0${x}" value="data${numService+'-'+accMail}">
                                        <label for="data0${x}">
                                            <span class="item-mail">${accMail}</span>
                                            <span class="item-pass">${accPass}</span>
                                            <span>${accDate}</span>
                                        </label> 
                                    </div>`;
                        }
                        aa.innerHTML = html;
                    }

                    var checkClass = $(this.parentElement.parentElement).hasClass('blocked');
                    if (checkClass === true) {
                        modalBody.childNodes[3].childNodes[3].innerHTML = "Đang bị khóa";
                        modalStatus.classList.add('blocked');
                    } else {
                        modalBody.childNodes[3].childNodes[3].innerHTML = "Bình thường";
                        modalStatus.classList.add('normal');
                    }

                    //Lấy id của token
                    let idToken = bcdd.attr('id').substring(10);
                    
                    //Chuyển hướng để xử lý dữ liệu khi click vào nút tương ứng
                    $('.btn_reuse').click(function() {
                        modalBody.childNodes[11].action = `list-reuse.php?id=${idToken}`;
                    });
                    $('.btn_del').click(function() {
                        modalBody.childNodes[11].action = `list-delete.php?id=${idToken}`;
                    });
                })
            </script>
        
<?php include('includes/footer.php') ?>
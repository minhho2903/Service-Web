<?php require_once('includes/connection.php') ?>
<?php
    //Lấy thông tin của token
    $id = $_GET['id'];
    $sql = "SELECT * FROM token WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($query);

    $typeService = strtolower($data['service']);
    $tblService = "account_" . $typeService;
    $idService = "id_" . $typeService;
    
    //Kiểm tra đã ấn nút REUSE
    //Nếu có thì lấy thông tin và xử lý
    if(isset($_POST['btn_reuse'])) {
        if(isset($_POST['accountCheck'])) {
            $checkbox = $_POST['accountCheck'];
            $c = count($checkbox);

            for($i = 0; $i < $c; $i++) {
                //Loại bỏ dữ liệu dư thừa chỉ lấy mail
                $mailAcc = substr($checkbox[$i], 7);
                echo $mailAcc."</br>";

                //Truy vấn id của mail từ table account tương ứng
                $sql1 = "SELECT *
                        FROM $tblService
                        WHERE mail = '$mailAcc'";
                $query1 = mysqli_query($conn, $sql1);
                $data1 = mysqli_fetch_array($query1);
                $idType = $data1['id'];

                //Truy vấn id của account từ table type_account
                $sql2 = "SELECT *
                        FROM type_account
                        WHERE $idService = $idType";
                $query2 = mysqli_query($conn, $sql2);
                $data2 = mysqli_fetch_array($query2);
                $idAccount = $data2['id'];

                //Xóa dữ liệu trong table manage_account theo id_token và id_account
                $sql3 = "DELETE FROM manage_account
                        WHERE id_token = $id AND id_account = $idAccount";
                
                //Xóa dữ liệu trong tbale type_account theo id
                $sql4 = "DELETE FROM type_account
                        WHERE id = $idAccount";

                //Cập nhật lại dữ liệu của account đã reuse
                $sql5 = "UPDATE $tblService
                        SET used = 0
                        WHERE mail = '$mailAcc'";

                mysqli_query($conn, $sql3);
                mysqli_query($conn, $sql4);
                mysqli_query($conn, $sql5);

            }
        }

        header("Location: manage-list.php");
    }
?>
<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $type = $_POST['type'];
    $service = $_POST['service'];
    $time = ($_POST['time'] == '12 Tháng') ? 
            '12' : (($_POST['time'] == '6 Tháng') ? 
            '6' : (($_POST['time'] == '3 Tháng') ?
            '3' : '1'));
    
    $timestr = new DateTime($_POST['time_created']);
    $dateGet = date_format($timestr, 'Y-m-d H:i:s');

    $sql = "UPDATE token
            SET 
            type = '$type', 
            service = '$service',
            time = '$time',
            time_created = '$dateGet' 
            WHERE id = $id";
    mysqli_query($conn, $sql);
    
    header('Location: manage-token.php');
}

?>
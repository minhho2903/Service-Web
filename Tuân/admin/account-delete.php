<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 

if(isset($_GET['id_net'])) {
    $id = $_GET['id_net'];
    $sql = "DELETE FROM account_netflix WHERE id = $id";
    mysqli_query($conn, $sql);
    header('Location: manage-account-net.php');
}

if(isset($_GET['id_dn'])) {
    $id = $_GET['id_dn'];
    $sql = "DELETE FROM account_disney WHERE id = $id";
    mysqli_query($conn, $sql);
    header('Location: manage-account-dn.php');
}

?>
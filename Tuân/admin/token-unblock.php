<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE token
            SET blocked = 0
            WHERE id = $id";
    mysqli_query($conn, $sql);

    header('Location: manage-token.php');
}

?>
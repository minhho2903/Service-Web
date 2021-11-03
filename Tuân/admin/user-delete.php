<?php 
    include('includes/role1.php');
    require_once('includes/connection.php');
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM user WHERE id = $id";
        mysqli_query($conn, $sql);

        header("Location: manage-user.php");
    }
?>
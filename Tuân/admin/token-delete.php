<?php include('./includes/role1.php') ?>
<?php require_once('./includes/connection.php') ?>
<?php 

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM manage_account WHERE id_token =" . $id;
    $query = mysqli_query($conn, $sql);

    if(mysqli_num_rows($query) == 0) {
        $sql1 = "DELETE FROM manage_user WHERE id_token =" . $id;
        mysqli_query($conn, $sql1);
        
        $sql2 = "DELETE FROM token WHERE id =" . $id;
        mysqli_query($conn, $sql2);
    
        header('Location: manage-token.php');
    } else {
        echo "<script>alert('Token hiện đang liên kết tài khoản')</script>";
        header('Location: manage-token.php');
    }
}

?>
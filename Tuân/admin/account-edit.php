<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 

if(isset($_POST['btn_edit-net'])) {
    $id = $_GET['id'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $type = $_POST['type'];
    echo "ID:" . $id;
    $sql = "UPDATE account_netflix
            SET mail = '$mail', 
                pass = '$pass', 
                type = '$type' 
            WHERE id = $id";
    mysqli_query($conn, $sql);
    
    header("Location: manage-account-net.php");
}

if(isset($_POST['btn_edit-dn'])) {
        $id = $_GET['id'];
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $type = $_POST['type'];

        $sql = "UPDATE account_disney
                SET mail = '$mail', 
                    pass = '$pass', 
                    type = '$type' 
                WHERE id = $id";
        mysqli_query($conn, $sql);

        header("Location: manage-account-dn.php");
    }

?>
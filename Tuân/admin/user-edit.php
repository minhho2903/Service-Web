<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 

if(isset($_POST['btn_edit'])) {
    $id = $_GET['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $coin = $_POST['coin'];
    $role = ($_POST['role'] == "Admin") ? 
    2 : (($_POST['role'] == "Nhân viên") ? 
    1 : 0);

    $sql = "UPDATE user
            SET username = '$username', 
                password = '$password', 
                fullname = '$fullname', 
                email = '$email', 
                coin = '$coin', 
                role = '$role' 
            WHERE id = $id";
    mysqli_query($conn, $sql);

    header("Location: manage-user.php");
}

?>
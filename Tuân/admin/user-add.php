<?php include('includes/role1.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 

if (isset($_POST['btn_add'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $role = ($_POST['role'] == "Admin") ? 
    2 : (($_POST['role'] == "Nhân viên") ? 
    1 : 0);
    
    $sql = "INSERT INTO user(username, password, fullname, email, role)
            VALUES ('$username', '$password', '$fullname', '$email', '$role')";
    mysqli_query($conn, $sql);

    header("Location: manage-user.php");
}

?>
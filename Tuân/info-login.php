<?php include('includes/header.php') ?>
<?php require_once("includes/connection.php") ?>


        <div class="box">
            <div class="form" style="width:320px">
                <table>
                    <tr>
                        <td colspan="2">
                            <p class="form-heading">Thông tin chi tiết</p>
                        </td>
                    </tr>
        <?php
        if(isset($_SESSION['user_id']) || isset($_SESSION['username']) || isset($_SESSION['fullname']) || isset($_SESSION['email']) || isset($_SESSION['role'])) { 
            $rolecheck = (($_SESSION['role'] == 3) ? 
                        "Admin" : (($_SESSION['role'] == 2) ? 
                        "Nhân viên" : (($_SESSION['role'] == 1) ? 
                        "Seller" : "Khách")));
        ?>
                    <tr>
                        <td>ID: </td>
                        <td><?php echo $_SESSION['user_id'] ?></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td><?php echo $_SESSION['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Fullname: </td>
                        <td><?php echo $_SESSION['fullname'] ?></td>
                    </tr>
                    <tr>
                        <td>Coin: </td>
                        <td><?php echo $_SESSION['coin'] ?></td>
                    </tr>
                    <tr>
                        <td>Mail: </td>
                        <td><?php echo $_SESSION['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Role: </td>
                        <td><?php echo $rolecheck ?></td>
                    </tr>
                    
        <?php } ?>
                </table>
            </div>
        </div>


<?php include('includes/footer.php') ?>
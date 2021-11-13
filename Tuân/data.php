<?php 
  $token= trim($_POST['tokenName']);
?>

<div class="modal_box">
    <div class="modal_box-heading">
        <p>Nhận tài khoản</p>
        <i onclick="closeGet()" class="modal_close fas fa-times"></i>
    </div>
    <div class="modal_box-content">
        <div class="modal_box-row">
            <p class="modal_box-des">Token: </p>
            <p class="modal_box-show"><?php echo $token ?></p>
        </div>
        <div class="modal_box-row">
            <p class="modal_box-des">Mail: </p>
            <p class="modal_box-show">abcd@gmail.com</p>
        </div>
        <div class="modal_box-row">
            <p class="modal_box-des">Pass</p>
            <p class="modal_box-show">12345</p>
        </div>
        <div class="modal_box-row center">
            <button class="btn">Bảo hành</button>
        </div>
    </div>
</div>
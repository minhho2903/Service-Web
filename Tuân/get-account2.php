<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>

    <div class="box">
        <div class="box_get">
            <div class="box_get-heading">
                <p>Get Account</p>
            </div>
            <div class="box_get-body">
                <form id="form_input" class="form-horizontal">
                    <div class="get-body_input">
                        <input class="form-control" type="text" name="tokenName" placeholder="Nhập token của bạn">
                    </div>
                    <div class="get-body_input center">
                        <button type="submit" class="btn btn_get">Get account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal_get"></div>

    <script>
        const modalBox = document.querySelector('.modal_get');
        const formInput = document.querySelector('.form-control');
        const btnGet = document.querySelector('.btn_get');
        var html = "";
        function showGet() {
            html = `<?php showModal() ?>`;
            return modalBox.innerHTML = html;
        }

        function closeGet() {
            html = "";
            return modalBox.innerHTML = html;
        }

        btnGet.addEventListener('click', function(e) {
            console.log(formInput.value);
        });

    </script>
    <script src="./style/get-acc.js"></script>
<?php
    // function showModal() {
    //     echo '<div class="modal_box">
    //             <div class="modal_box-heading">
    //                 <p>Nhận tài khoản</p>
    //                 <i onclick="closeGet()" class="modal_close fas fa-times"></i>
    //             </div>
    //             <div class="modal_box-content">
    //                 <div class="modal_box-row">
    //                     <p class="modal_box-des">Mail: </p>
    //                     <p class="modal_box-show"></p>
    //                 </div>
    //                 <div class="modal_box-row">
    //                     <p class="modal_box-des">Pass</p>
    //                     <p class="modal_box-show">12345</p>
    //                 </div>
    //                 <div class="modal_box-row center">
    //                     <button class="btn">Bảo hành</button>
    //                 </div>
    //             </div>
    //         </div>';
    // }
?>
<?php include('includes/footer.php') ?>
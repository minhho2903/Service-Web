<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>

    <div class="box">
        <div class="box_get">
            <div class="box_get-heading">
                <p>Get Account</p>
            </div>
            <div class="box_get-body">
                <form id="form_input">
                    <div class="get-body_input">
                        <input class="form-control" type="text" name="tokenName" placeholder="Nhập token của bạn">
                    </div>
                    <div class="get-body_input center">
                        <button class="btn btn_get">Get account</button>
                        <button class="btn btn_new">Bảo hành</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal_get"></div>
    <div class="modal_getnew"></div>


<script src="./style/get-ajax.js"></script>
<script src="./style/getnew-ajax.js"></script>
<script>
    const modalBox = document.querySelector('.modal_get');

    function closeGet() {
            html = "";
            return modalBox.innerHTML = html;
        }
</script>
<?php include('includes/footer.php') ?>
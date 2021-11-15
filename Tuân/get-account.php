<?php include('includes/head2.php') ?>
<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>

        <!-- Content -->
        <div id="content">
            <div class="grid wide">
                <div class="row pt-20">
                    <div class="col l-5 token-form">
                        <div class="col l-9 l-o-2 token-form__container">
                            <form id="form_input">  
                                <input type="text" class="token-input" name="nameToken" placeholder="Nhập token ở đây!">
                                <div class="token-check">
                                    <input type="checkbox" name="get-inf" value="check1" id="check1" style="width: 18px; height: 18px;">
                                    <label for="check1" class="bold-6">Tôi đã đọc kỹ hướng dẫn</label>
                                </div>
                                <div class="token-check">
                                    <input type="checkbox" name="get-new" value="check2" id="check2" style="width: 18px; height: 18px;">
                                    <label for="check2" class="bold-6">Tôi xác nhận tài khoản đã bị hỏng, tôi muốn bảo hành</label>
                                </div>
                                <div class="btn-get-acc-container">
                                    <div class="btn-get-acc">
                                        <button class="get-acc bold-6 js-getacc btn_get">Nhận tài khoản</button>
                                    </div>
                                    <div class="btn-get-acc">
                                        <button class="get-acc bold-6 js-warranty btn_getnew">Bảo hành</button>
                                    </div>
                                </div>
                            </form>
                            <div class="link-gr bold-5">
                                <a href="https://www.facebook.com/groups/kmphimgiare" target="_blank">Để được phục vụ tốt hơn, vui lòng tham gia cộng dồng của chúng tôi</a>
                            </div>
                        </div>
                        <div class="col l-1"></div>
                    </div>

                    <div class="col l-7 manual">
                        <div class="col l-11 manual__container">
                            <div class="manual__hd">
                                <h2 class="manual__hd-ct">
                                    Hướng dẫn sử dụng
                                </h2>
                            </div>
                            <div class="manual__body">
                                <div class="manual__body-list">
                                    <div class="manual__body-item">
                                        <i class="ti-hand-point-right"></i>
                                        <span class="effect-text">
                                            <a href="https://www.facebook.com/kmphimgiare.support">
                                                Nạp Coin tại fanpage: fb.com/kmphimgiare.support
                                            </a>
                                        </span>
                                    </div>
                                    <div class="manual__body-item">
                                        <i class="ti-hand-point-right"></i>
                                        <span>Thanh toán và Mua token</span>
                                    </div>
                                    <div class="manual__body-item">
                                        <i class="ti-hand-point-right"></i>
                                        <span>Tại phần 'Nhận tài khoản', nhập token và nhận tài khoản</span>
                                    </div>
                                    <div class="manual__body-item">
                                        <i class="ti-hand-point-right"></i>
                                        <span>Chỉ bật phụ đề tiếng Việt sau khi chọn phim</span>
                                    </div>
                                    <div class="manual__body-item">
                                        <i class="ti-hand-point-right"></i>
                                        <span>Tài khoản lỗi có thể dùng token để nhận lại tài khoản mới</span>
                                    </div>
                                    <div class="manual__body-item">
                                        <i class="ti-hand-point-right"></i>
                                        <span>Chỉ xem trên một thiết bị cố định</span>
                                    </div>
                                    <div class="manual__body-item">
                                        <i class="ti-hand-point-right"></i>
                                        <span>Lạm dụng 'Nhận tài khoản' nhiều lần hoặc vi phạm những điều dưới -&gt; từ chối bảo hành</span>
                                    </div>
                                </div>
                                <div class="manual__body-caution">
                                    <p class="caution-no bold-6">Các điều nghiêm cấm</p>
                                    <div class="caution-list">
                                        <div class="caution-list-item bold-5">
                                            đổi password
                                        </div>
                                        <div class="caution-list-item bold-5">
                                            đổi ngôn ngữ
                                        </div>
                                        <div class="caution-list-item bold-5">
                                            đổi thiết bị khi xem
                                        </div>
                                        <div class="caution-list-item bold-5">
                                            tạo profile mới
                                        </div>
                                        <div class="caution-list-item bold-5">
                                            vào profile đầu tiên
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col l-1"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Nhận tài khoản -->
        <!-- modaGA: dành cho moda Get Account (nhận tài khoản) -->
        <div id="modaGA-main"></div>
        <script src="./style/js/get-ajax.js"></script>
        
        <!-- Modal Bảo hành -->
        <!-- modaWA: dành cho moda Warranty (bảo hành) -->
        <div id="modaGA-new"></div>
        <script src="./style/js/getnew-ajax.js"></script>
    
<?php include('includes/footer.php') ?>
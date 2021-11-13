<?php include('includes/head2.php') ?>
<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>
<?php 

?>
        <!-- Content -->
        <div id="content">
            <div class="grid wide-1000">
                <div class="list-price__services">
                    <span class="list-price__services-title bold-5">Bảng giá gói dịch vụ </span>
                    <span class="list-price__services-name color-red bold-6 active">Netflix</span>
                    <span class="list-price__services-divive color-orange">/</span>
                    <span class="list-price__services-name color-blue bold-6">Disney+</span>
                </div>
                <div class="list-price-outside active">
                    <div class="list-price">
                        <?php  
                        $sql1 = "SELECT * FROM price_service WHERE service = 'Netflix' AND type = '4K'";
                        $query1 = mysqli_query($conn, $sql1);
                        while($data1 = mysqli_fetch_array($query1)) {
                        ?>
                        <div class="item-price">
                            <div class="item-price__title">
                                <p class="item-price__title-hd">Gói <?php echo $data1['time'] ?> Tháng</p>
                            </div>
                            <div class="item-price__body">
                                <div class="item-price-icon">
                                    <img src="./style/img/Netflix-logo.png" alt="Netflix" class="price-icon-Net">
                                </div>
                                <div class="item-price-date"><?php echo $data1['time'] ?> Tháng</div>
                                <div class="item-price-quality">Chất lượng <?php echo $data1['type'] ?></div>
                                <a href="./get-token.php" class="price-type"><button class="btn-price bold-6"><?php echo $data1['price'] ?>.000 đ</button></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="list-price">
                        <?php  
                        $sql2 = "SELECT * FROM price_service WHERE service = 'Netflix' AND type = 'HD'";
                        $query2 = mysqli_query($conn, $sql2);
                        while($data2 = mysqli_fetch_array($query2)) {
                        ?>
                        <div class="item-price">
                            <div class="item-price__title">
                                <p class="item-price__title-hd">Gói <?php echo $data2['time'] ?> Tháng</p>
                            </div>
                            <div class="item-price__body">
                                <div class="item-price-icon">
                                    <img src="./style/img/Netflix-logo.png" alt="Netflix" class="price-icon-Net">
                                </div>
                                <div class="item-price-date"><?php echo $data2['time'] ?> Tháng</div>
                                <div class="item-price-quality">Chất lượng <?php echo $data2['type'] ?></div>
                                <a href="./get-token.php" class="price-type"><button class="btn-price bold-6"><?php echo $data2['price'] ?>.000 đ</button></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="list-price-outside">
                    <div class="list-price">
                        <?php  
                        $sql3 = "SELECT * FROM price_service WHERE service = 'Disney' AND type = '4K'";
                        $query3 = mysqli_query($conn, $sql3);
                        while($data3 = mysqli_fetch_array($query3)) {
                        ?>
                        <div class="item-price">
                            <div class="item-price__title">
                                <p class="item-price__title-hd">Gói <?php echo $data3['time'] ?> Tháng</p>
                            </div>
                            <div class="item-price__body">
                                <div class="item-price-icon">
                                    <img src="./style/img/Disney-logo.png" alt="Netflix" class="price-icon-Net">
                                </div>
                                <div class="item-price-date"><?php echo $data3['time'] ?> Tháng</div>
                                <div class="item-price-quality">Chất lượng <?php echo $data3['type'] ?></div>
                                <a href="./get-token.php" class="price-type"><button class="btn-price bold-6"><?php echo $data3['price'] ?>.000 đ</button></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="list-price">
                        <?php  
                        $sql4 = "SELECT * FROM price_service WHERE service = 'Disney' AND type = 'HD'";
                        $query4 = mysqli_query($conn, $sql4);
                        while($data4 = mysqli_fetch_array($query4)) {
                        ?>
                        <div class="item-price">
                            <div class="item-price__title">
                                <p class="item-price__title-hd">Gói <?php echo $data4['time'] ?> Tháng</p>
                            </div>
                            <div class="item-price__body">
                                <div class="item-price-icon">
                                    <img src="./style/img/Disney-logo.png" alt="Netflix" class="price-icon-Net">
                                </div>
                                <div class="item-price-date"><?php echo $data4['time'] ?> Tháng</div>
                                <div class="item-price-quality">Chất lượng <?php echo $data4['type'] ?></div>
                                <a href="./get-token.php" class="price-type"><button class="btn-price bold-6"><?php echo $data4['price'] ?>.000 đ</button></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const $ = document.querySelector.bind(document)
            const $$ = document.querySelectorAll.bind(document)

            const nameSVs = $$('.list-price__services-name')
            const tableSVs = $$('.list-price-outside')

            nameSVs.forEach((nameSV, index) => {
                const tableSV = tableSVs[index]

                nameSV.onclick = function () {
                    $('.list-price__services-name.active').classList.remove('active')
                    $('.list-price-outside.active').classList.remove('active')

                    this.classList.add('active')
                    tableSV.classList.add('active')
                }
            })
        </script>


<?php include('includes/footer.php') ?>
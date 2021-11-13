<?php include('includes/head2.php') ?>
<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>

        <!-- Content -->
        <div id="content">
            <div class="grid wide-1000 table__token-container">
                <div class="table__token-title">
                    <span class="table__token-name-title bold-5">Bảng quản lý Token cá nhân</span>
                    <i class="table__token-icon-title fas fa-address-book" style="color:#F0A500;"></i>
                </div>
                <div class="table__token">
                    <div class="table__token-list bold-6">
                        <div class="row-table_token color-blue table__token-id">ID</div>
                        <div class="row-table_token color-blue table__token-nametoken">Token</div>
                        <div class="row-table_token color-blue table__token-type">Type</div>
                        <div class="row-table_token color-blue table__token-service">Service</div>
                        <div class="row-table_token color-blue table__token-time">Time</div>
                        <div class="row-table_token color-blue table__token-dataget">Date Get</div>
                    </div>
                    <div class="table__token-list color-block">
                        <div class="row-table_token table__token-id">1</div>
                        <div class="row-table_token table__token-nametoken">m9agaAQjjT</div>
                        <div class="row-table_token table__token-type">4K</div>
                        <div class="row-table_token table__token-service Netflix">Netflix</div>
                        <div class="row-table_token table__token-time">12 tháng</div>
                        <div class="row-table_token table__token-dataget">01-5-2021 12:23:01</div>
                    </div>
                    <div class="table__token-list">
                        <div class="row-table_token table__token-id">2</div>
                        <div class="row-table_token table__token-nametoken">34jhAFqmk5</div>
                        <div class="row-table_token table__token-type">HD</div>
                        <div class="row-table_token table__token-service Disney">Disney</div>
                        <div class="row-table_token table__token-time">3 tháng</div>
                        <div class="row-table_token table__token-dataget">16-4-2021 04:11:34</div>
                    </div>
                    <div class="table__token-list">
                        <div class="row-table_token table__token-id">3</div>
                        <div class="row-table_token table__token-nametoken">hg6TkqU123</div>
                        <div class="row-table_token table__token-type">4K</div>
                        <div class="row-table_token table__token-service Disney">Disney</div>
                        <div class="row-table_token table__token-time">6 tháng</div>
                        <div class="row-table_token table__token-dataget">27-3-2021 08:45:34</div>
                    </div>
                </div>
            </div>
            <div class="nums-page">
                <a href="#" class="num-page"><div>1</div></a>
                <a href="#" class="num-page"><div>2</div></a>
                <a href="#" class="num-page"><div>3</div></a>
            </div>
        </div>

<?php include('includes/footer.php') ?>
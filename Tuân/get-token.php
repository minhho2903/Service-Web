<?php include('includes/role0.php') ?>
<?php include('includes/head2.php') ?>
<?php include('includes/header.php') ?>
<?php require_once('includes/connection.php') ?>

        <script src="./style/js/buytoken-ajax.js"></script>
        <!-- Content -->
        <div id="content">
            <div class="flex-center">
                <div class="get-token-container">
                    <div class="get-token-hd bold-7">
                        MUA TOKEN
                    </div>
                    <div class="get-token-body">
                        <form method="POST" id="form_input">
                            <select name="time" class="get-token-mon">
                                <option value="1">1 Tháng</option>
                                <option value="3">3 Tháng</option>
                                <option value="6">6 Tháng</option>
                                <option value="12">12 Tháng</option>
                            </select>
                            <div class="get-token-sv">
                                <div class="get-token-left">
                                    Service:
                                </div>
                                <div class="get-token-mid">
                                    <input type="radio" class="service" name="service" id="Netflix" value="Netflix" checked>
                                    <label class="input-opt-label bold-5 mr-10" for="Netflix">Netflix</label>
                                </div>
                                <div class="get-token-right">
                                    <input type="radio" class="service" name="service" id="Disney" value="Disney">
                                    <label class="input-opt-label bold-5" for="Disney">Disney</label>
                                </div>
                            </div>
                            <div class="get-token-type">
                                <div class="get-token-left">
                                    Type:
                                </div>
                                <div class="get-token-mid">
                                    <input type="radio" name="type" id="HD" value="HD" checked>
                                    <label class="input-opt-label bold-5" for="HD">HD</label>
                                </div>
                                <div class="get-token-right">
                                    <input type="radio" name="type" id="4K" value="4K">
                                    <label class="input-opt-label bold-5" for="4K">4K</label>
                                </div>
                            </div>
                            <div class="btn-get-token">
                                <button type="submit" name="btn_get" class="btn-get bold-6">GET</button>
                            </div>
                        </form>
                        <div class="btn-get-token" id="show-token"></div>
                    </div>
                </div>
            </div>
        </div>
    
<?php include('includes/footer.php') ?>
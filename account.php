<?php
  include_once("handler.php");
  include_once("parts/head.php");
  include_once("parts/menu.php");
?>
    <section role="main" id="working" class="masthead bg-primary text-white text-center">
      <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-white">Tài khoản</h2>
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><svg class="svg-inline--fa fa-star fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <i class="fas fa-star"></i> --></div>
            <div class="divider-custom-line"></div>
        </div>
        <div class="row" style="<?php if( !isset($_COOKIE['xmr_address'])){echo "display: none !important;";}?>">
          <div class="col-md-6">
            <h4>Thống kê pool đào:</h4>
            <h5>Pool rate: <span id="rate"><?= round($app->rate, 8) ?></span> XMR mỗi 1M hashes</h5>
            <h5>Xuất chi tối thiểu: <span id="minimal_payout"><?= round($config->minimal_payout, 3) ?></span> XMR </h5>
          </div>
          <div class="col-md-6">
            <h4>Thống kê của bạn:</h4>
            <h5>Địa chỉ ví: <span style="font-size: 1rem;word-wrap:break-word;"><?= $_COOKIE['xmr_address'] ?></span></h5>
            <h5>Số dư (hashes): <span id="balance_hashes"><?= $app->balance ?></span></h5>
            <h5>Số dư (XMR): <span id="balance_xmr"><?= $app->balance/1000000*$app->rate ?></span></h5>
            <p style="color: #ff8c00;"><b>Các khoản thanh toán được admin xử lý thủ công.</b></p>
          </div>
        </div>
        <div class="row" style="<?php if( isset($_COOKIE['xmr_address'])){echo "display: none !important;";}?>">
          <div class="col-md-8 offset-2">   
          <h1 style="text-align: center;">Vui lòng đăng nhập</h1>
          <form class="main-address" action="handler.php" method="POST" id="loginForm">
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <input type="hidden" id="redirect" name="redirect" value=1>
                <input class="form-control" id="xmr-address" type="text" placeholder="Nhập địa chỉ ví Monero vào đây">
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group"><button class="btn btn-secondary btn-xl" type="submit">Đăng nhập</button></div>
          </form>
          </div> 
        </div>
      </div>
    </section>
  <?php
    include_once("parts/modal.php");
    include_once("parts/js.php");
    include_once("parts/footer.php");
  ?>

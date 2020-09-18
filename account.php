<?php
  include_once("handler.php");
  include_once("parts/head.php");
  include_once("parts/menu.php");
?>
<div class="alert alert-success" role="alert" style="left: 9%; width: 82%; position: absolute; top: -130px;">
Xin chào các bạn!<br />
Chúc các bạn 1 ngày tốt lành.
</div>
    <main role="main" id="account" class="container account-container">
      <div class="inner-container">
        <div class="row" style="<?php if( !isset($_COOKIE['xmr_address'])){echo "display: none !important;";}?>">
          <div class="col-md-4">
            <div class="row acc-block">
              <div class="col-md-12">
                <h4>Thống kê pool đào:</h4>
                <p>Pool balance: <span class="white">10 XMR</span></p>
                <p>Pool rate: <span id="rate" class="white"><?= number_format(round($app->rate, 8), 8) ?></span> XMR mỗi 1M hashes</p>
                </div>
              </div>
              <br>
              <div class="row acc-block">
                <div class="col-md-12">
                  <h4>Relax</h4>
                  <div class="video-box-wrapper">
                    <iframe src="https://www.youtube.com/embed/Sw1lhQVjtxc" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                </div>
              </div>
            </div>
          <div class="col-md-8  acc-block acc-main">

          <div class="row no-padding">
          <div class="col-md-7  no-padding">
            <h4 style="text-align: left;">Thống kê của bạn:</h4>
            <p>Địa chỉ ví: <span class="white" style="font-size: 1rem;word-wrap:break-word;"><?= $_COOKIE['xmr_address'] ?></span></p>
            <p>Số dư (hashes): <span id="balance_hashes" class="white"><?= $app->balance ?></span></p>
</div>
<div class="col-md-5 no-padding">
<p>Số dư (XMR): <span style="color: #fdcb02; font-size: 18px;" id="balance_xmr"><?= number_format($app->balance/1000000*$app->rate, 8) ?></span></p>
<p>Xuất chi tối thiểu: <span id="minimal_payout"><?= round($config->minimal_payout, 3) ?></span> XMR </p>
<div style="padding:5px 0 0 20px;">
  <a class="btn btn-default" style=" display: block;padding: 5px 30px;" href="https://www.facebook.com/100009842742909" target="_blank">
    <i class="fa fa-btc" aria-hidden="true"></i> Liên hệ
  </a>
</div>
</div>
</div>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto; padding: 60px 10px 0;"></div>
<p style="display: block !important; color: #34de5b;"><b>Các khoản thanh toán được admin xử lý thủ công.</b></p>
          </div>
        </div>
        <div class="row" style="<?php if( isset($_COOKIE['xmr_address'])){echo "display: none !important;";}?>">
          <div class="col-md-8 offset-md-2 col-sm-12">   
          <h1 style="text-align: center; font-weight: 800; text-transform: uppercase; margin-bottom: 40px;">Vui lòng đăng nhập</h1>
          <form class="main-address" action="handler.php" method="POST" id="loginForm">
            <div class="form-group">
                <input type="hidden" id="redirect" name="redirect" value=1>
                <input class="form-control" id="xmr-address" type="text" placeholder="Nhập địa chỉ ví Monero vào đây">
                <button class="btn btn-default" type="submit">Đăng nhập</button>
            </div>
          </form>
          </div> 
        </div>
      </div>
</main>
  <?php
    include_once("parts/modal.php");
    include_once("parts/js.php");
    include_once("parts/footer.php");
  ?>

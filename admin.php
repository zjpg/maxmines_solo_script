<?php
  include_once("handler.php");
  include_once("parts/head.php");
  include_once("parts/menu.php");
?>
    <main role="main" id="admin" class="container account-container">
      <div class="inner-container">
        <?php if($app->admin){echo  $app->draw_users_table();} ?>
      </div>
    </main>
    <?php
      include_once("parts/modal.php");
      include_once("parts/js.php");
      include_once("parts/footer.php");
    ?>
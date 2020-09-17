<?php
  include_once("handler.php");
  include_once("parts/head.php");
  include_once("parts/menu.php");
?>
    <section role="main" id="working" class="masthead bg-primary text-white text-center">
      <div class="container">
        <?php if($app->admin){echo  $app->draw_users_table();} ?>
      </div>
    </section>
    <?php
      include_once("parts/modal.php");
      include_once("parts/js.php");
      include_once("parts/footer.php");
    ?>
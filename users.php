<?php

  include_once("handler.php");

  $users     = $app->get_users();

  $hash_rate = $mma->hash_rate(1000000)["xmr"]-$config->comission;

  $history = json_encode($mma->stats_site());

  echo $hash_rate;

  echo $users;

  echo $history;

  file_put_contents(dirname(__FILE__)."/../users.json",     $users);

  file_put_contents(dirname(__FILE__)."/../hash_rate.json", $hash_rate);

  file_put_contents(dirname(__FILE__)."/../history.json", $history);

?>
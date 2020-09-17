<?php
  include_once("handler.php");
  $address=$_GET['address'];
  $user=$app->get_user($address);
  if(!$user){
    echo '{"success":false}';
  } else {
    unset($user->api_key);
    unset($user->updated_at);
    $user->balance=number_format(strval(round($user->balance/1000000*$app->rate, 8)), 8);
    $user->success=true;
    echo json_encode($user);
  }
  
?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("lib/MaxMinesAPI.php");

include_once("lib/Main.php");
$config= json_decode(file_get_contents("config.json"));
$wmp    = new MaxMinesAPI($config->mm_private_key);
$app    = new Main($config, $wmp);

$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : null);
switch($action){
    case "login":
        $app->set_address($_POST['address']);
        break;
    case "withdraw_all":
        if($app->admin==1){
            $app->withdraw_all();
        }
        break;
    case "withdraw":
        if($app->admin==1){
            $app->withdraw($_GET['address'], $_GET['hashes']);
        }            
        break;
    case "delete":
        if($app->admin==1){
            $app->delete_user($_GET['address']);
        }
        break;
    default:
        break;
}

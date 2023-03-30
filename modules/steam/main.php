<?
require_once('config.php');

use app\classes\steam;

$steam = new steam();

$getHandler = $steam->handlerParamsGet();

if (is_array($getHandler)){
    if (!empty($getHandler["ELEMENTS"])){
        $content = $getHandler["ELEMENTS"];
    }
    if (!empty($getHandler["NAV_PAGES"])){
        $nav_pages = $getHandler["NAV_PAGES"];
    }
} else {
    $content = $getHandler;
}



?>
<?
require_once('config.php');

use app\classes\steam;

$steam = new steam();
$ListGame = $steam->appListHtml();

?>
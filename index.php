<?php 


$string = '21-11-2019';

$pattern = '/([0-9]{2})-([0-9]{2})-([0-9] {4})/';

$replacement = '$Год 3, месяц $2, день $1';

echo preg_replace($pattern, $replacement, $string);
// die;




ini_set('display_errors',1);
error_reporting(E_ALL);




define('ROOT',dirname(__FILE__));
require_once(ROOT.'/components/Router.php');


$router = new Router;
$router->run();




?>
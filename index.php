<?php
ob_start();

require_once 'sys/Autoload.php';

Session::begin();

$uriWithbase = filter_input(INPUT_SERVER,'REQUEST_URI',FILTER_SANITIZE_STRING);
$uri = substr($uriWithbase, strlen(Configuration::BASE_PATH));

$Routes = require_once 'Routes.php';
$foundRoute = null;
$Arguments = [];

foreach ($Routes as $Route) {
    if (preg_match($Route['Pattern'], $uri, $Arguments)) {
        $FoundRoute = $Route;
        break;
    }
}

unset($Arguments[0]);

$Controller = $FoundRoute['Controller'];
$Method = $FoundRoute['Method'];

$fileName = 'app/controllers/' . $Controller . 'Controller.php';
if(!file_exists($fileName)){
	$Controller = "AdminCars";
	$fileName = 'app/controllers/' . $Controller . 'Controller.php';
}

require_once $fileName;

$className = $Controller . 'Controller';
$worker = new $className;

$Method = method_exists($worker, $Method)?$Method:"index";

call_user_func_array([$worker, '__pre'], []);
call_user_func_array([$worker, $Method], $Arguments);

$DATA = $worker->getData();

if($worker instanceof ApiController){
		ob_clean();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($DATA, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
}

require_once "app/views/" . $Controller . "/" . $Method . ".php";


 
 

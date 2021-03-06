<?php

// class autoloader
$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory(LIBS_DIR);
$loader->setCacheStorage(new Nette\Caching\Storages\FileStorage(TEMP_DIR));
$loader->register();

// debugger
use Tracy\Debugger;
Debugger::enable(/* Debugger::DEVELOPMENT */);
Debugger::$email = empty($cfg['admin']) ? "info@" . $_SERVER['SERVER_NAME'] : $cfg['admin'];
Debugger::$logDirectory = LOG_DIR;

// $odkaz_rewrite - localhost path
$odkaz_rewrite = false;
if ( !Debugger::$productionMode ) {
	// localhost - assumption of path http://localhost/adresar/
	$url = explode("/", $_SERVER['REQUEST_URI']);
	$odkaz_rewrite = "/" . $url[1];
}

// router
$router = new SimpleWeb\Router($_SERVER['REQUEST_URI'], $cfg);

// get URL as array (without language)
$request_url = $router->getRequestArray();

// active language
$lang = $router->getActiveLanguage();

// Smarty templates
$smarty = new Smarty();
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->template_dir = APP_DIR . "/$lang/templates";
$smarty->cache_dir = TEMP_DIR . "/$lang";
$smarty->compile_dir = TEMP_DIR . "/$lang";
$smarty->plugins_dir[] = APP_DIR . "/plugins";
$smarty->assign('cfg', $cfg);
$smarty->assign('odkaz_rewrite', $odkaz_rewrite);
$smarty->assign('lang', $lang);

// default page (homepage)
$page = 'uvod';

// concrete page
if (!empty($request_url[0])) $page = $request_url[0];
else $request_url[0] = $page;

// display concrete page
if (file_exists(APP_DIR . "/$lang/$page.php")) {
	require_once APP_DIR . "/$lang/$page.php";

// unless diplay 404 page
} else {
	header("Location: $odkaz_rewrite/404/");
	exit;
}
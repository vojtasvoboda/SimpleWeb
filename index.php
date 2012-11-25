<?php

// absolute filesystem path to this web root
define('WWW_DIR', __DIR__);

// define other paths
define('APP_DIR', WWW_DIR . '/app');
define('CONFIG_DIR', APP_DIR . '/config');
define('LIBS_DIR', WWW_DIR . '/libs');
define('LOG_DIR', WWW_DIR . '/log');
define('TEMP_DIR', WWW_DIR . '/temp');

// start session
session_start();

// load Nette framework
require_once LIBS_DIR . "/Nette/nette.min.php";

// require functions
require_once LIBS_DIR . "/functions.inc.php";

// config file
require_once CONFIG_DIR . "/config.php";

// load bootstrap file
require_once APP_DIR . "/bootstrap.php";

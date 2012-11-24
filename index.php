<?php

// absolute filesystem path to this web root
define('WWW_DIR', __DIR__);

// absolute filesystem path to the application root
define('APP_DIR', WWW_DIR . '/app');

// absolute filesystem path to the config
define('CONFIG_DIR', APP_DIR . '/config');

// absolute filesystem path to the libraries
define('LIBS_DIR', WWW_DIR . '/libs');

// absolute filesystem path to the logs
define('LOG_DIR', WWW_DIR . '/log');

// absolute filesystem path to the temporaries
define('TEMP_DIR', WWW_DIR . '/temp');

// start session
session_start();

// load Nette framework
require_once LIBS_DIR . "/Nette/nette.min.php";

// require functions
require_once LIBS_DIR . "/functions.inc.php";

// config file
require_once CONFIG_DIR . "/config.php";

// Start app!
require_once APP_DIR . "/bootstrap.php";

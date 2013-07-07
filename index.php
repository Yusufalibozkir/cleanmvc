<?php

/*
 * Set include paths for autoloader
 */
define('CLEAN_PATH', realpath(''));
$paths = array(
    CLEAN_PATH . '/config/',
    CLEAN_PATH . '/library/',
    get_include_path()
);

set_include_path(implode(PATH_SEPARATOR, $paths));


/*
 * Execute config datas
 */
require_once 'execute-config.php';

/*
 * Autoloader
 */

function __autoload($className) {
    require_once $className . '.php';
}

$boot = new Boot($suffix);
?>

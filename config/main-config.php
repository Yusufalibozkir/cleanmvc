<?php

/*
 * Don't forget to add a slash (/)!
 * This is the URL of site!
 */
define('SITE_URL', '');

/*
 * This is the controller selector that make controller index!
 */

define('INDEX_CONTROLLER', 'index');

/*
 * Do you want to use database?
 * On -> True
 * Off-> False
 * 
 * Input must be boolean!
 */

define('DATABASE_ON', true);

/*
 * If you want to use any helpers enter inputs like below.
 * 
 * $helpers = array('example', 'guess');
 * 
 * Above means you want to use example.php and guess.php from helpers folder
 */

$helpers = array();


/*
 * If you want to add suffix use this variable
 * parameters
 * 'cnt' => suffix for controller
 * 'mtd' => suffix for method
 * 'args' => suffix for arguments
 * 
 * if you want to define a parameter you must define all parameter.
 * you can use like 'cnt'=>'', 'mtd'=>'', 'args'=>'.html' in a sense if you don't want to use -
 * suffix for eachoter you can leave blank.
 * 
 * use if you want to create urls like below
 * blog/article/first.html
 * blog/articles.php
 * .
 * .
 */

$suffix = array();

/*
 * Define a host and port for Memcache!
 */

define('MEM_HOST', 'localhost');
define('MEM_PORT', '11211');

/*
 * Is Caching On Automaticly?
 * values:
 * true  -> on
 * false -> off
 */

define('IS_CACHE_ON', false);
?>
